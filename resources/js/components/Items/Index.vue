<script setup>
import { onMounted } from "vue";
import useItems from "../../composables/items";

const { items, getItems } = useItems()
    onMounted(() => {
        getItems()
    })
</script>

<template>
    <div v-for="item in items">
        <div>{{ item.name }}</div>
    </div>

    <h1>Items list</h1>
</template>
