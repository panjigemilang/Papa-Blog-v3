<template>
    <div class="min-h-screen w-full">
        <div
            class="absolute top-1/2 left-1/2 transform -translate-y-1/2 -translate-x-1/2"
            v-if="loading"
        >
            <i class="text-5xl fas fa-circle-notch fa-spin"></i>
        </div>
        <div v-else>
            <div class="container py-8">
                <h1 class="text-lg">Selamat datang, {{ user.name }}!</h1>
                <div class="text-center mt-16" v-if="post_loading">
                    <i class="text-5xl fas fa-circle-notch fa-spin"></i>
                </div>
                <div v-else>
                    <News :newsContent="posts.data" />
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapActions, mapState } from "vuex";
import News from "../../Partials/News";

export default {
    name: "Dashboard",
    components: {
        News
    },
    computed: {
        ...mapState("services", ["loading", "user"]),
        ...mapState("posts", {
            post_loading: state => state.loading,
            posts: state => state.posts
        })
    },
    methods: {
        ...mapActions("services", ["getUser"]),
        ...mapActions("posts", ["getAllPosts"])
    },
    created() {
        this.getAllPosts();
    }
};
</script>
