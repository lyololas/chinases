<script setup>
import { Link, router } from '@inertiajs/vue3';
import { useStore } from 'vuex';
import { computed } from 'vue';
const store = useStore();
defineProps({
    products: Array
})

const addToCart = (product) => {
    console.log(product)
    router.post(route('cart.store', product), {
        onSuccess: (page) => {
            if (page.props.flash.success) {
                Swal.fire({
                    toast: true,
                    icon: "success",
                    position: "top-end",
                    showConfirmButton: false,
                    title: page.props.flash.success
                });
            }
        },
    })
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

<template>
    <div class="mt-6 grid grid-cols-2 gap-x-4 gap-y-6 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 xl:gap-x-8">
        <div v-for="product in products" :key="product.id" class="group relative border border-gray-300 rounded-lg p-4 hover:shadow-lg transition-shadow duration-300">
            <div class="aspect-h-1 aspect-w-1 w-full h-64 overflow-hidden rounded-md bg-gray-200">
                <img v-if="product.product_images.length > 0" :src="`/${product.product_images[0].image}`" 
                     :alt="product.imageAlt"
                     class="h-full w-full object-cover object-center" />
                <img v-else
                     src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/65/No-Image-Placeholder.svg/330px-No-Image-Placeholder.svg.png"
                     :alt="product.imageAlt"
                     class="h-full w-full object-cover object-center" />
            </div>
            
            <div class="mt-4 flex justify-between ">
                <div>
                    <h3 class="text-sm text-black font-bold">
                        {{ product.title }}
                    </h3>
                    <p class="text-sm font-medium text-black">${{ product.price }}</p> 
                    <p class="mt-1 text-sm text-gray-500">{{ product.brand.name }}</p>
                    
                </div>
                
                <!-- Heart Icon Button -->
                <button @click.prevent="toggleFavorite(product)" class="p-1 focus:outline-none">
                    <svg :class="isFavorited(product) ? 'text-red-500' : 'text-gray-700'" class="w-6 h-6 transition-colors duration-200" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                    </svg>
                </button>
                <!-- End Heart Icon Button -->
            </div>

            <div class="flex items-center mt-1">
                <svg class="w-4 h-4 text-yellow-300 me-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                    <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                </svg>
                <p class="ms-2 text-sm font-bold text-gray-900 dark:text-white">4.95</p>
                <span class="w-1 h-1 mx-1.5 bg-gray-500 rounded-full dark:bg-gray-400"></span>
                <a href="#" class="text-sm font-medium text-gray-900 underline hover:no-underline dark:text-white">73 reviews</a>
            </div>

            <button @click="addToCart(product)"
                    class="border font-medium rounded-full px-3 py-1 hover:bg-black hover:text-white mt-5 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 transition">
                в Корзину
            </button>
        </div>
    </div>
</template>

<style scoped>
    /* Optional: Add more custom styles here if needed */
</style>
