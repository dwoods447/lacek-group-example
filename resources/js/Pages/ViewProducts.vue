<template>
    <div>

             <div class="bg-white">
                <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
                    <h2 class="text-2xl font-bold tracking-tight text-gray-900">Items available for purchase</h2>

                    <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
                  
             
                    <div class="group relative"  v-for="product in productList" :key="product.id">
                        <div class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-md bg-gray-200 lg:aspect-none group-hover:opacity-75 lg:h-80">
                        <img :src="product.image_url" alt="Front of men&#039;s Basic Tee in black." class="h-full w-full object-cover object-center lg:h-full lg:w-full">
                        </div>
                        <div class="mt-4 flex justify-between">
                        <div>
                            <h3 class="text-sm text-gray-700">
                            <a :href="`/products/${product.id}/detail`">
                                <span aria-hidden="true" class="absolute inset-0"></span>
                                 {{ product.name }}
                            </a>
                            </h3>
                        </div>
                        <p class="text-sm font-medium text-gray-900">${{ product.price  }}</p>
                        
                        </div>
                    </div>

                    <!-- More products... -->
                    </div>
                </div>
            </div>      
    </div>
</template>
<script setup>
import { ref, onMounted } from 'vue';
const productList = ref([])
async function getProducts() {
    const resp = await fetch('/view/products')
    productList.value = await resp.json()
}
onMounted(() => { 
    getProducts();
})
</script>