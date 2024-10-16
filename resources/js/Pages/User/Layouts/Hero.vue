<template>
    <div class="flex flex-col items-center px-8 py-6 bg-white rounded-3xl max-w-[95%] lg:max-w-[600px] lg:py-8 mx-auto my-auto mt-12 mb-5 shadow-md">
        <div class="flex gap-8 w-full">
            <div class="flex flex-col flex-1 justify-between min-h-[220px]">
                <h2 class="text-2xl md:text-3xl font-bold leading-8 text-black text-center">
                    Закажите ваши любимые блюда!
                </h2>
                <h1>Удонусси легендарный</h1>
                <div class="flex items-center self-start mt-8 md:mt-16">
                    <button class="flex gap-2.5 justify-center items-center self-stretch px-3 py-2 text-sm md:text-base font-bold leading-6 text-center text-black bg-white rounded-xl border border-solid border-zinc-100 min-h-[40px]">
                        В корзину
                    </button>
                    <button class="flex overflow-hidden gap-1 justify-center items-center self-stretch px-2 my-auto bg-white rounded-xl border border-solid border-zinc-100 h-[40px] min-h-[40px] w-[40px]" aria-label="Дополнительные действия">
                        <img loading="lazy" src="https://cdn.builder.io/api/v1/image/assets/TEMP/441c35886486b8271eab2328eb73f762ba72004ff02fd58fe145493449bc2a7f?placeholderIfAbsent=true&apiKey=98ba9341efc54db7927e9c7da116db59" alt="" class="object-contain self-stretch my-auto aspect-square" />
                    </button>
                </div>
            </div>
            <img loading="lazy" src="https://cdn.builder.io/api/v1/image/assets/TEMP/dec603fd6017dd1f2c535b37ccf3fcd9fc6ee500c647bffe30cc655f14478a9e?placeholderIfAbsent=true&apiKey=98ba9341efc54db7927e9c7da116db59" alt="Изображение любимых блюд" class=" ml-2 mb-12 object-contain shrink-0 self-start max-w-full rounded-none w-[200px] md:w-[200px]" />
        </div>
    </div>
</template>

<style scoped>
.builder-component {
    max-width: none !important;
}

section {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh; /* Center vertically */
    margin: 0 auto; /* Center horizontally */
}
</style>
