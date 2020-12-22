<template>
    <nav class="fixed h-screen">
        <ul class="flex flex-col">
            <li class="mb-4">
                <button
                    class="w-full"
                    type="button"
                    v-if="isAuthenticated"
                    @click.prevent="logout"
                >
                    <div
                        class="bg-red-600 rounded-full h-14 w-14 flex items-center justify-center"
                    >
                        <i class="text-white fas fa-sign-in-alt"></i>
                    </div>
                </button>
                <button class="w-full" type="button" v-else>
                    <router-link to="/login">
                        <div
                            class="bg-green-400 rounded-full h-14 w-14 flex items-center justify-center"
                        >
                            <i class="text-white fas fa-sign-in-alt"></i>
                        </div>
                    </router-link>
                </button>
            </li>
            <li class="mb-4">
                <button class="w-full" type="button">
                    <i class="text-white fas fa-home fa-primary"></i>
                </button>
            </li>
        </ul>
    </nav>
</template>

<script>
import { mapActions, mapState } from "vuex";

export default {
    name: "Navigation",
    computed: {
        ...mapState("services", ["isAuthenticated"])
    },
    methods: {
        ...mapActions("services", ["logout"])
    }
};
</script>

<style lang="scss">
@import "../../../sass/variables.scss";
@import "../../../sass/prefix.scss";

nav {
    background-color: $color-primary-dark;

    button:hover {
        box-shadow: none;

        i {
            @include transform(scale(1.2));
            transition: 0.3s ease-in-out;
        }
    }
}
</style>
