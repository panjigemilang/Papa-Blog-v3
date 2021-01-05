<template>
    <div
        class="search-app transition-all duration-300 min-w-min fixed w-full h-full z-50"
        :class="
            search
                ? 'visible bottom-0 opacity-100'
                : 'invisible -bottom-6 opacity-0'
        "
    >
        <div
            class="fixed w-full h-full z-40 opacity-80 bg-gray-800"
            @click.prevent="toggleSearch"
        >
            <i
                class="close cursor-pointer fas fa-times fixed top-8 right-8 text-lg text-white shadow-xl"
            ></i>
        </div>
        <div
            class="fixed bg-white text-gray-600 py-8 px-6 md:px-16 w-full h-80 z-50 bottom-0"
        >
            <div class="transform translate-y-1/2 form-group flex flex-row">
                <i
                    class="fas fa-search mr-4 mt-1 cursor-pointer text-xl transition-all duration-300 transform hover:scale-110"
                    @click="onSubmit"
                ></i>
                <input
                    ref="search"
                    type="search"
                    class="w-full pb-4 text-2xl"
                    name="search"
                    id="search"
                    v-model="searchInput"
                    placeholder="Search by title ..."
                    @keyup.enter="onSubmit"
                />
            </div>
        </div>
    </div>
</template>

<script>
import { mapActions, mapState } from "vuex";

export default {
    name: "Search_Modal",
    data() {
        return {
            searchInput: ""
        };
    },
    computed: {
        ...mapState("general", ["search"])
    },
    methods: {
        ...mapActions("general", ["toggleSearch"]),
        onSubmit() {
            this.toggleSearch();

            this.$router.push(
                `/posts?title=${this.searchInput
                    .toLowerCase()
                    .replace(/\s|\+/g, "-")
                    .replace(/:|&\s|,|;|\./g, "")}`
            );
        }
    },
    watch: {
        search: function() {
            setTimeout(() => {
                this.$refs.search.focus();
            }, 100);
        }
    }
};
</script>

<style></style>
