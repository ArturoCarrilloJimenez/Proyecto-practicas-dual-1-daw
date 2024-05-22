<script setup lang="ts">

const getData = (url: string) => {
    const { data } = useFetch(url);
    console.log(data);
    return { data }
}

const { data } = getData('http://127.0.0.1:8000/api/student');

</script>

<template>
    <main class="container mx-auto mt-10 p-4">
        <section class="text-center">
            <h2 class="text-3xl font-bold mb-4">¡Bienvenidos al gestor de estudiantes!</h2>
            <div v-for="{name, image,house} in data.data">
                <h3>{{ name }}</h3>
                <h5>{{ house }}</h5>
                <img v-if="image != null" :src="image" :alt="image">
                <img v-else src="https://cremationproducts.ie/wp-content/uploads/2017/08/placeholder-400x600.jpg" alt="">
            </div>
            {{ data }}
        </section>
    </main>
</template>