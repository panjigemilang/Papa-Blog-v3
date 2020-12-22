<template>
    <div class="home-app">
        <h1 v-if="isAuthenticated">Selamat datang, {{ user.name }}!</h1>
        <h1 v-else>Home</h1>
    </div>
</template>

<script>
import { mapState } from "vuex";

export default {
    name: "Home",
    computed: {
        ...mapState("services", ["user", "isAuthenticated"])
    }
};
</script>

<style></style>
