<template>
    <div class="container flex flex-row px-8 md:px-0 md:w-full text-center">
        <router-link
            class="w-3/6 md:w-1/5 my-8"
            v-for="(item, i) in tags.data"
            :key="'tag-' + i"
            :to="`/posts?tag=${item.tags}`"
        >
            <h3
                class="text-xl font-black transition-colors text-green-500 hover:text-green-600"
            >
                {{ item.tags }}
            </h3>
        </router-link>
    </div>
</template>

<script>
import { mapActions, mapState } from "vuex";

export default {
    name: "Navigation_Tags",
    computed: {
        ...mapState("tags", ["tags"])
    },
    methods: {
        ...mapActions("tags", ["getTags"])
    },
    created() {
        this.getTags();
    }
};
</script>

<style></style>
