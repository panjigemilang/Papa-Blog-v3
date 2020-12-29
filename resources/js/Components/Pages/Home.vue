<template>
    <div>
        <Loading v-if="loading" />
        <div v-else>
            <NavTags />
            <Featured :galleryContent="posts.data[0].data" />
            <div class="flex flex-row">
                <News :newsContent="posts.data[0].data" />
            </div>
            <div class="latest-post container mt-12">
                <div class="heading mb-16 w-7/12">
                    <h1 class="text-4xl">
                        Latest Posts
                    </h1>
                    <p>
                        Latest posts that currently hot, we provide super cool
                        all news around the world
                    </p>
                </div>
                <NewsCard />
            </div>
        </div>
    </div>
</template>

<script>
import { mapActions, mapState } from "vuex";
import NavTags from "../Partials/NavTags";
import Featured from "../Partials/Featured";
import News from "../Partials/News";
import NewsCard from "../Partials/NewsCard";
import Trending from "../Partials/Trending";
import Loading from "../Utils/Loading";

export default {
    name: "Home",
    components: {
        NavTags,
        Featured,
        News,
        NewsCard,
        Trending,
        Loading
    },
    computed: {
        ...mapState("services", ["user", "isAuthenticated"]),
        ...mapState("posts", ["loading", "posts"])
    },
    methods: {
        ...mapActions("posts", ["getPosts"])
    },
    created() {
        this.getPosts();
    }
};
</script>
