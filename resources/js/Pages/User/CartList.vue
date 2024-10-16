<script setup>
import { computed, reactive, onMounted } from 'vue';
import UserLayouts from './Layouts/UserLayouts.vue';
import { router, usePage } from '@inertiajs/vue3';
defineProps({
    userAddress: Object
})
const carts = computed(() => usePage().props.cart.data.items);
const products = computed(() => usePage().props.cart.data.products);
const deliveryTimes = ['9:00 AM', '11:00 AM', '1:00 PM', '3:00 PM', '5:00 PM'];
const total = computed(() => usePage().props.cart.data.total);
const itemId = (id) => carts.value.findIndex((item) => item.product_id === id);
const form = reactive({
    address1: null,
    state: null,
    city: null,
    zipcode: null,
    country_code: null,
    type: null,
    orderDate: null
});
const formFilled = computed(() => {
    return (form.address1 !== null &&
        form.state !== null &&
        form.city !== null &&
        form.zipcode !== null &&
        form.country_code !== null &&
        form.type !== null &&
        form.orderDate !== null);
});


const headerText = reactive({ text: 'Your Order Details' });


const update = (product, quantity) => router.patch(route('cart.update', product), {
    quantity,
});


const remove = (product) => router.delete(route('cart.delete', product));



function submit() {
    router.visit(route('checkout.store'), {
        method: 'post',
        data: {
            carts: usePage().props.cart.data.items,
            products: usePage().props.cart.data.products,
            total: usePage().props.cart.data.total,
            address: form,
            orderDate: form.orderDate
        }
    });
}

onMounted(() => {
    const today = new Date().toISOString().split('T')[0];
    form.orderDate = today;
});
</script>

<template>
    <UserLayouts>
        <section class="text-gray-600 body-font relative">
            <div class="container px-5 py-24 mx-auto flex flex-wrap">

                <div class="lg:w-2/3 md:w-1/2 rounded-lg sm:mr-10 p-10">
                    <!-- Product List Table for Desktop -->
                    <table class="hidden lg:w-full text-sm text-left text-gray-500 dark:text-gray-400 lg:block">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3"><span class="sr-only">Image</span></th>
                                <th scope="col" class="px-6 py-3">Product</th>
                                <th scope="col" class="px-6 py-3">Qty</th>
                                <th scope="col" class="px-6 py-3">Price</th>
                                <th scope="col" class="px-6 py-3">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="product in products" :key="product.id"
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="w-24 p-4">
                                    <img v-if="product.product_images.length > 0"
                                        :src="`/${product.product_images[0].image}`" alt="Product Image" class="w-16 h-16">
                                    <img v-else
                                        src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/65/No-Image-Placeholder.svg/330px-No-Image-Placeholder.svg.png"
                                        alt="No Image" class="w-16 h-16">
                                </td>
                                <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">{{ product.title }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center space-x-3">
                                        <button @click.prevent="update(product, carts[itemId(product.id)].quantity - 1)"
                                            :disabled="carts[itemId(product.id)].quantity <= 1"
                                            class="h-8 w-8 bg-gray-200 rounded-full flex items-center justify-center" type="button">
                                            <span class="sr-only">Decrease Quantity</span>
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 18 2">
                                                <path stroke="currentColor" stroke-width="2" d="M1 1h16" />
                                            </svg>
                                        </button>
                                        <input type="number" v-model="carts[itemId(product.id)].quantity"
                                            class="w-14 border border-gray-300 text-gray-900 text-sm rounded text-center"
                                            required>
                                        <button @click.prevent="update(product, carts[itemId(product.id)].quantity + 1)"
                                            class="h-8 w-8 bg-gray-200 rounded-full flex items-center justify-center" type="button">
                                            <span class="sr-only">Increase Quantity</span>
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 18 18">
                                                <path stroke="currentColor" stroke-width="2" d="M9 1v16M1 9h16" />
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                                <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">${{ product.price }}</td>
                                <td class="px-6 py-4">
                                    <a @click="remove(product)"
                                        class="font-medium text-red-600 hover:underline">Remove</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <!-- Mobile Product List -->
                    <div class="block lg:hidden mt-6">
                        <div v-for="product in products" :key="product.id" class="flex flex-col mb-4 border border-gray-200 p-4 rounded-lg bg-white">
                            <div class="flex items-center justify-between">
                                <img v-if="product.product_images.length > 0" :src="`/${product.product_images[0].image}`" alt="Product Image" class="mr-4 w-16 h-16">
                                <h2 class="font-semibold text-gray-900 dark:text-white flex-1 truncate">{{ product.title }}</h2>
                                <a @click="remove(product)" class="text-red-600 hover:underline">Remove</a>
                            </div>
                            <div class="flex justify-between items-center mt-2">
                                <span class="text-gray-600">${{ product.price }}</span>
                                <div class="flex items-center">
                                    <button @click.prevent="update(product, carts[itemId(product.id)].quantity - 1)"
                                        :disabled="carts[itemId(product.id)].quantity <= 1"
                                        class="h-8 w-8 bg-gray-200 rounded-full" type="button">
                                        <span class="sr-only">Decrease</span>
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 18 2"><path stroke="currentColor" stroke-width="2" d="M1 1h16" /></svg>
                                    </button>
                                    <input type="number" v-model="carts[itemId(product.id)].quantity"
                                        class="w-14 border border-gray-300 text-gray-900 text-sm rounded text-center mx-2" required>
                                    <button @click.prevent="update(product, carts[itemId(product.id)].quantity + 1)"
                                        class="h-8 w-8 bg-gray-200 rounded-full" type="button">
                                        <span class="sr-only">Increase</span>
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 18 18"><path stroke="currentColor" stroke-width="2" d="M9 1v16M1 9h16" /></svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="lg:w-1/3 md:w-1/2 bg-white flex flex-col md:ml-auto w-full md:py-8 mt-8 md:mt-0">
                    <h2 class="text-gray-900 text-lg mb-1 font-medium title-font">Total</h2>
                    <p class="leading-relaxed mb-5 text-gray-600">Total: ₽ {{ total }}</p>

                    <div v-if="userAddress">
                        <h2 class="text-gray-900 text-lg mb-1 font-medium title-font">Shipping Address</h2>
                        <p class="leading-relaxed mb-5 text-gray-600">{{ userAddress.address1 }}, {{ userAddress.city }}, {{ userAddress.zipcode }}</p>
                        <p class="leading-relaxed mb-5 text-gray-600">or you can add new below</p>
                    </div>

                    <div v-else>
                        <p class="leading-relaxed mb-5 text-gray-600">Add a shipping address to continue!</p>
                    </div>

                    <form @submit.prevent="submit">
                        <div class="relative mb-4">
                            <label for="name" class="leading-7 text-sm text-gray-600">Address</label>
                            <input type="text" id="name" name="address1" v-model="form.address1"
                                class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                        </div>
                        <div class="relative mb-4">
                            <label for="city" class="leading-7 text-sm text-gray-600">City</label>
                            <input type="text" id="city" name="city" v-model="form.city"
                                class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                        </div>
                        <div class="relative mb-4">
                            <label for="state" class="leading-7 text-sm text-gray-600">State</label>
                            <input type="text" id="state" name="state" v-model="form.state"
                                class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                        </div>
                        <div class="relative mb-4">
                            <label for="zipcode" class="leading-7 text-sm text-gray-600">Zipcode</label>
                            <input type="text" id="zipcode" name="zipcode" v-model="form.zipcode"
                                class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                        </div>
                        <div class="relative mb-4">
                            <label for="countrycode" class="leading-7 text-sm text-gray-600">Floor</label>
                            <input type="text" id="countrycode" name="countrycode" v-model="form.country_code"
                                class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                        </div>
                        <div class="relative mb-4">
                            <label for="type" class="leading-7 text-sm text-gray-600">Comments</label>
                            <input type="text" id="type" name="type" v-model="form.type"
                                class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                        </div>
                        <div class="relative mb-4">
                        <label for="order-date" class="leading-7 text-sm text-gray-600">Select Order Date</label>
                        <input type="date" id="order-date" name="orderDate" v-model="form.orderDate"
                            min="" 
                            class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                        </div>
                        <div class="mt-4">

                        <label for="delivery-time" class="block text-sm font-medium text-gray-700">Выберите время доставки:</label>
                        <select id="delivery-time" v-model="selectedDeliveryTime" class="mt-1 block w-full bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                            <option disabled value="">-- Указать время --</option>
                            <option v-for="time in deliveryTimes" :key="time" :value="time">{{ time }}</option>
                        </select>
                        </div>

                        <h2 class="text-gray-900 text-lg mt-6 mb-2 font-medium title-font">Payment Method</h2>
                        <div class="flex space-x-4 mb-6">
                            <div class="flex items-center">
                                <input type="radio" id="payment-card" name="payment" value="card" class="hidden peer" required>
                                <label for="payment-card" class="flex items-center justify-between cursor-pointer w-full p-4 border rounded-lg border-gray-300 hover:border-indigo-500 peer-checked:bg-indigo-500 peer-checked:text-white transition">
                                    <span>Card</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M3.5 4a1 1 0 00-1 1v2h15V5a1 1 0 00-1-1h-13zM3 9v10a1 1 0 001 1h12a1 1 0 001-1V9h-14z" clip-rule="evenodd" />
                                    </svg>
                                </label>
                            </div>
                            <div class="flex items-center">
                                <input type="radio" id="payment-cash" name="payment" value="cash" class="hidden peer">
                                <label for="payment-cash" class="flex items-center justify-between cursor-pointer w-full p-4 border rounded-lg border-gray-300 hover:border-indigo-500 peer-checked:bg-indigo-500 peer-checked:text-white transition">
                                    <span>Cash</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M4 2a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2V4a2 2 0 00-2-2H4zm0 2h12v12H4V4zm3 4a1 1 0 110 2 1 1 0 010-2zm2 0a1 1 0 110 2 1 1 0 010-2zm2 0a1 1 0 110 2 1 1 0 010-2z" clip-rule="evenodd" />
                                    </svg>
                                </label>
                            </div>
                        </div>

                        <button v-if="formFilled || userAddress" type="submit"
                            class="text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg">Checkout</button>
                        
                            

                        <button v-else type="submit"
                            class="text-white bg-gray-500 border-0 py-2 px-6 focus:outline-none hover:bg-gray-600 rounded text-lg">Add Address to continue</button>
                    </form>
                    
                    <p class="text-xs text-gray-500 mt-3">Continue Shopping</p>
                </div>
            </div>
        </section>
    </UserLayouts>
</template>
