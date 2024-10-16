<script setup>
import { Link, usePage } from '@inertiajs/vue3';

const { url } = usePage();
const { component } = usePage();
</script>

<template>
    <div class="fixed bottom-0 left-0 z-50 w-full h-16 bg-white border-t border-gray-200 dark:bg-gray-700 dark:border-gray-600">
        <div class="grid h-full max-w-lg grid-cols-5 mx-auto font-medium">
            <Link 
                :href="route('home')" 
                :class="{'text-red-500': component === 'User/Index'}"
                class="flex flex-col items-center justify-center group"
                as="button"
            >
                <svg 
                    :class="{'text-red-500': component === 'User/Index'}" 
                    class="w-6 h-6 mb-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32"
                >
                <path fill="currentColor" d="M13.67 2c-.53 0-.95.42-.95.94v3.7a.49.49 0 0 1-.98 0V2.98c0-.52-.4-.97-.91-.98a.94.94 0 0 0-.97.94v3.7a.49.49 0 0 1-.98 0V2.98c0-.52-.4-.97-.91-.98a.94.94 0 0 0-.97.94v6.32a3.8 3.8 0 0 0 1.503 3.034c.847.62.847 2.617.847 2.617v13.8c0 .71.58 1.29 1.29 1.29h.32c.71 0 1.29-.58 1.29-1.29V14.9s0-2.037.834-2.607A3.8 3.8 0 0 0 14.6 9.251V2.94a.924.924 0 0 0-.93-.94m9.39 0c1.24 0 2.24 1 2.24 2.24v13.65l-.01-.003v10.814c0 .71-.58 1.29-1.29 1.29h-.32c-.71 0-1.29-.58-1.29-1.29V16.837a4.35 4.35 0 0 1-2.55-3.966V5.22C19.83 3.44 21.28 2 23.06 2" />
                </svg>
                <span 
                    :class="{'text-red-500': component === 'User/Index'}"
                    class="text-sm dark:text-gray-400"
                >
                    Меню
                </span>
            </Link>

            <Link 
                :href="route('bonuses')" 
                class="flex flex-col items-center justify-center dark:hover:bg-gray-800 group" 
                :class="{ 'bg-gray-100': url === route('bonuses') }"
                as="button"
            >
                <svg 
                :class="{'text-red-500': component === 'User/Bonuses'}" 
                class="w-6 h-6 mb-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <path fill="currentColor" d="M467 45.2A44.45 44.45 0 0 0 435.29 32H312.36a30.63 30.63 0 0 0-21.52 8.89L45.09 286.59a44.82 44.82 0 0 0 0 63.32l117 117a44.83 44.83 0 0 0 63.34 0l245.65-245.6A30.6 30.6 0 0 0 480 199.8v-123a44.24 44.24 0 0 0-13-31.6M384 160a32 32 0 1 1 32-32a32 32 0 0 1-32 32" />
                </svg>
                <span class="text-sm text-gray-500 dark:text-gray-400"
                :class="{'text-red-500': component === 'User/Bonuses'}">Бонусы</span>
            </Link>

            <Link 
                :href="route('products.index')" 
                :class="{'text-red-500': component === 'User/ProductList'}"
                class="flex flex-col items-center justify-center hover:bg-gray-50 dark:hover:bg-gray-800 group"
                as="button"
            >
                <svg 
                    :class="{'text-red-500': component === 'User/ProductList'}" 
                    class="w-6 h-6 mb-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32"
                >
                <path fill="currentColor" d="M22 3L10 4.41V6h12v1H10v5h12c0 1.81-.57 3.46-1.68 4.95s-2.55 2.58-4.32 3.3V22H8v-1.75c-1.76-.72-3.21-1.82-4.32-3.3S2 13.81 2 12h3V4l17-2zM6 4.88V6h1V4.78zM6 7v5h1V7zm3 5V7H8v5zm0-6V4.55l-1 .09V6z" />
                </svg>
                <span 
                    :class="{'text-red-500': component === 'User/ProductList'}"
                    class="text-sm dark:text-gray-400"
                >
                    Меню
                </span>
            </Link>

            <Link 
                :href="route('izbrannoe')" 
                class="flex flex-col items-center justify-center hover:bg-gray-50 dark:hover:bg-gray-800 group" 
                :class="{ 'bg-gray-100': url === route('izbrannoe') }"
                as="button"
            >
                <svg :class="{'text-red-500': component === 'User/Izbranie'}"
                class="w-6 h-6 mb-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 2048 2048">
                    <path fill="currentColor" d="M1889 287q53 53 88 116t53 131t18 138t-17 138t-53 131t-89 116l-865 864l-865-864q-53-53-88-116T18 811T0 673t17-139t53-131t89-116q78-77 177-118t208-41t208 41t177 118l95 96l95-96q78-77 177-118t208-41t208 41t177 118" />
                </svg>
                <span class="text-sm text-gray-500 dark:text-gray-400"
                :class="{'text-red-500': component === 'User/Izbranie'}">Избранное</span>
            </Link>

            <Link 
                :href="route('profile.edit')" 
                class="flex flex-col items-center justify-center hover:bg-gray-50 dark:hover:bg-gray-800 group" 
                :class="{ 'bg-gray-100': url === route('profile.edit') }"
                as="button"
            >  
                <svg :class="{'text-red-500': component === 'Profile/Edit'}" class="w-6 h-6 mb-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path fill="currentColor" fill-rule="evenodd" d="M8 7a4 4 0 1 1 8 0a4 4 0 0 1-8 0m0 6a5 5 0 0 0-5 5a3 3 0 0 0 3 3h12a3 3 0 0 0 3-3a5 5 0 0 0-5-5z" clip-rule="evenodd" />
                </svg>
                <span class="text-sm text-gray-500 dark:text-gray-400"
                :class="{'text-red-500': component === 'Profile/Edit'}">Профиль</span>
            </Link>
        </div>
    </div>
</template>
