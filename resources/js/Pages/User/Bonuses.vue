<script setup>
import { Link, router } from '@inertiajs/vue3';
import UserLayouts from './Layouts/UserLayouts.vue';
import Hero from './Layouts/Hero.vue';
import Products from '../User/Components/Products.vue';
//products list 
defineProps({
    products: Array
});


</script>
<template>
    <UserLayouts>
        



    </UserLayouts>
    <div class="flex flex-col items-center justify-center m-56 text-center"> 

<img 

    loading="lazy" 

    src="https://cdn.builder.io/api/v1/image/assets/TEMP/29d15603710de31e48a5621e89dd2b8f34ec698e674184cce35a4c69abde7058?placeholderIfAbsent=true&apiKey=98ba9341efc54db7927e9c7da116db59" 

    class="mb-4"

/>

<h1 class="text-xl font-bold">Упс здесь ничего нет :(</h1>

</div>
</template>


