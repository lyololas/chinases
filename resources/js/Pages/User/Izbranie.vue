<template>
    <UserLayouts />
    <div class="mt-6">
        <div v-if="favorites.length === 0" class="flex flex-col items-center justify-center m-56 text-center"> 
            <img 
                loading="lazy" 
                src="https://cdn.builder.io/api/v1/image/assets/TEMP/29d15603710de31e48a5621e89dd2b8f34ec698e674184cce35a4c69abde7058?placeholderIfAbsent=true&apiKey=98ba9341efc54db7927e9c7da116db59" 
                class="mb-4"
            />
            <h1 class="text-xl font-bold">Вы ничего не добавили в избранное</h1>
        </div>
        <div v-else class="grid grid-cols-2 gap-x-4 gap-y-6 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 xl:gap-x-8">
            <div v-for="favorite in favorites" :key="favorite.id" class="bg-white rounded-lg shadow-md p-4 hover:shadow-lg transition-shadow">
                <div class="aspect-h-1 aspect-w-1 w-full h-64 overflow-hidden rounded-md bg-gray-200 mb-4">
                    <img v-if="favorite.product_images.length > 0" :src="`/${favorite.product_images[0].image}`" 
                         :alt="favorite.imageAlt"
                         class="h-full w-full object-cover object-center" />
                    <img v-else
                         src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/65/No-Image-Placeholder.svg/330px-No-Image-Placeholder.svg.png"
                         :alt="favorite.imageAlt"
                         class="h-full w-full object-cover object-center" />
                </div>
                <div class="mt-4 flex justify-between">
                    <div>
                        <h3 class="text-sm text-black font-bold">
                            {{ favorite.title }}
                        </h3>
                        <p class="text-sm font-medium text-black">${{ favorite.price }}</p> 
                        <p class="mt-1 text-sm text-gray-500">{{ favorite.brand?.name }}</p>
                    </div>
                    <!-- Heart Icon Button -->
                    <button @click.prevent="toggleFavorite(favorite)" class="p-1 focus:outline-none">
                        <svg :class="isFavorited(favorite) ? 'text-red-500' : 'text-gray-700'" class="w-6 h-6 transition-colors duration-200" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                        </svg>
                    </button>
                    <!-- End Heart Icon Button -->
                </div>
                <button @click="addToCart(favorite)"
                        class="border font-medium rounded-full px-3 py-1 hover:bg-black hover:text-white mt-4 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 transition">
                    в Корзину
                </button>
            </div>
        </div>
    </div>
</template>

<script setup>
import { computed } from 'vue';
import { useStore } from 'vuex';
import UserLayouts from './Layouts/UserLayouts.vue';

const store = useStore();
const favorites = computed(() => store.getters.favorites);

const addToCart = (product) => {
    // Call your method to add the product to the cart
    console.log(product);
}

const isFavorited = (product) => {
    return store.getters.favorites.some(fav => fav.id === product.id);
}

// Function to handle favorite toggling
const toggleFavorite = (product) => {
    store.dispatch('toggleFavorite', product);
    console.log('Favorite toggled for', product);
}
</script>

<style scoped>
/* Optional: Add more custom styles here if needed */
</style>
