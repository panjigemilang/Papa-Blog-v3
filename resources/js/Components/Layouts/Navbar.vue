<template>
    <nav
        class="transition-all duration-300 fixed h-screen"
        :class="navbar ? 'left-0' : '-left-20'"
    >
        <ul class="flex flex-col h-full">
            <li class="mb-4">
                <button
                    class="w-full"
                    type="button"
                    v-if="isAuthenticated"
                    @click.prevent="onLogout"
                >
                    <div
                        class="bg-red-600 rounded-full h-14 w-14 flex items-center justify-center"
                    >
                        <i class="text-white fas fa-sign-in-alt"></i>
                    </div>
                </button>
                <button
                    class="w-full"
                    @click="toggleNavbar"
                    type="button"
                    v-else
                >
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
                <router-link to="/">
                    <button class="w-full" @click="toggleNavbar" type="button">
                        <i class="text-white fas fa-home fa-primary"></i>
                    </button>
                </router-link>
            </li>
            <li class="mb-4 mt-auto">
                <button class="w-full" @click="onSearch" type="button">
                    <i class="text-white fas fa-search fa-primary"></i>
                </button>
            </li>
            <li class="mb-4">
                <router-link to="/admin" v-if="user.who == 'admin'">
                    <button class="w-full" @click="toggleNavbar" type="button">
                        <i class="text-white fas fa-columns fa-primary"></i>
                    </button>
                </router-link>
            </li>
            <li class="mb-4">
                <button
                    class="w-full"
                    @click="toggleNavbar"
                    type="button"
                    v-if="user.who == 'admin'"
                >
                    <router-link to="/add">
                        <div
                            class="bg-green-600 rounded-full h-14 w-14 flex items-center justify-center"
                        >
                            <i class="text-white fas fa-plus"></i>
                        </div>
                    </router-link>
                </button>
            </li>
        </ul>
        <button
            class="transition-all duration-300 nav-btn cursor-pointer fixed bottom-10 w-16 p-3 rounded-r-lg shadow-xl focus:border-transparent"
            :class="navbar ? 'show' : 'left-0'"
            @click="toggleNavbar"
        >
            <span
                class="transition-all duration-300 block my-2 w-full h-1 rounded-md transform"
                :class="
                    navbar
                        ? 'rotate-45 translate-y-2'
                        : 'rotate-0 translate-y-0'
                "
            ></span>
            <span
                class="transition-all duration-300 block my-2 w-full h-1 rounded-md transform"
                :class="
                    navbar
                        ? '-rotate-45 -translate-y-1'
                        : 'rotate-0 translate-y-0'
                "
            ></span>
        </button>
    </nav>
</template>

<script>
import { mapActions, mapState } from "vuex";
import isEmpty from "../Utils/isEmpty";

export default {
    name: "Navigation",
    computed: {
        ...mapState("services", ["isAuthenticated", "user"]),
        ...mapState("general", ["navbar"])
    },
    methods: {
        ...mapActions("services", ["logout"]),
        ...mapActions("general", ["toggleNavbar", "toggleSearch"]),
        checkEmpty(val) {
            return isEmpty(val);
        },
        addPost() {
            alert("add post");
        },
        onSearch() {
            this.toggleNavbar();
            this.toggleSearch();
        },
        onLogout() {
            this.logout();
            this.toggleNavbar();

            this.$router.push("/");
        }
    }
};
</script>

<style lang="scss" scoped>
@import "../../../sass/variables.scss";
@import "../../../sass/prefix.scss";

.-left-20 {
    left: -5.37rem !important;
}

nav {
    background-color: $color-primary-dark;
    z-index: 49;

    button:hover {
        box-shadow: none;

        i {
            @include transform(scale(1.2));
            transition: 0.3s ease-in-out;
        }
    }

    .nav-btn {
        background-color: $bg-secondary;

        span {
            background-color: #fff;
        }

        &.show {
            left: 5.37rem;
        }
    }
}
</style>
