<script setup lang="ts">
useSeoMeta({
  title: 'Hogwarts Interactive Portal - Explore Student and Teacher Directories',
  ogTitle: 'Discover Hogwarts: A Harry Potter Student and Teacher Database',
  description: 'Dive into the magical world of Hogwarts! Access detailed profiles of students and teachers, explore houses, and connect with the Harry Potter community. Perfect for fans and scholars alike!',
  ogDescription: 'Join us at Hogwarts Interactive Portal to explore student and teacher directories, get insights into each Harry Potter house, and engage with a vibrant wizarding community. Start your magical journey today!',
  twitterCard: 'summary_large_image',
})

</script>

<template>
    <AppNav />

    <slot class="min-h-screen bg-gray-100"/>
    
    <AppFooter />
</template>