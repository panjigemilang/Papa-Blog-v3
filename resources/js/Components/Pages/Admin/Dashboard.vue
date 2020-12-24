<template>
    <div class="min-h-screen w-full">
        <div
            class="absolute top-1/2 left-1/2 transform -translate-y-1/2 -translate-x-1/2"
            v-if="loading"
        >
            <i class="text-5xl fas fa-circle-notch fa-spin"></i>
        </div>
        <div v-else>
            <div class="container mx-auto py-8">
                <h1 class="text-lg">Selamat datang, {{ user.name }}!</h1>
            </div>
        </div>
    </div>
</template>

<script>
import { mapActions, mapState } from "vuex";

export default {
    name: "Dashboard",
    computed: {
        ...mapState("services", ["loading", "user"])
    },
    methods: {
        ...mapActions("services", ["getUser"])
    }
};
</script>
