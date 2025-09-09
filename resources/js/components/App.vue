<!-- resources/js/components/App.vue -->
<template>
    <div class="p-8 max-w-4xl mx-auto">
        <h1 class="text-3xl font-bold mb-6 text-gray-800">Últimas Publicaciones</h1>

        <!-- Mostramos un mensaje si no hay posts -->
        <p v-if="!posts || posts.length === 0" class="text-gray-500">No hay publicaciones para mostrar.</p>

        <!-- Iteramos sobre los posts y los mostramos -->
        <ul v-else class="space-y-4">
            <li v-for="post in posts" :key="post.id"
                class="bg-white p-6 border rounded-lg shadow-sm hover:shadow-md transition-shadow duration-200">
                <h2 class="text-xl font-semibold text-indigo-600">{{ post.title }}</h2>
                <p class="text-gray-600 mt-2">{{ post.description }}</p>
            </li>
        </ul>
    </div>
</template>

<script setup>
// Definimos las 'props' que nuestro componente espera recibir.
// En este caso, un array llamado 'posts'.
defineProps({
    posts: Array,
});
</script>