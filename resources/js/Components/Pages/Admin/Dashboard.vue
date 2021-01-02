<template>
    <div class="min-h-screen w-full">
        <Loading v-if="loading" />
        <div v-else>
            <div class="container py-8">
                <h1 class="text-lg mb-6">Selamat datang, {{ user.name }}!</h1>
                <div class="text-center mt-16" v-if="post_loading">
                    <i class="text-5xl fas fa-circle-notch fa-spin"></i>
                </div>
                <div v-else>
                    <Table :posts="posts.data.data" />
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapActions, mapState } from "vuex";
import Table from "../../Partials/Table";
import Loading from "../../Utils/Loading";

export default {
    name: "Dashboard",
    components: {
        Table,
        Loading
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
        ...mapActions("posts", ["getPosts"])
    },
    created() {
        const limit = 5;

        this.getPosts(limit);
    }
};
</script>
