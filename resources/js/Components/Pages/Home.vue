<template>
    <div>
        <Loading v-if="loading" />
        <div v-else>
            <NavTags />
            <Featured :galleryContent="posts.data[0].data" />
            <div class="flex flex-row">
                <News :newsContent="newsContent" />
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
    data() {
        return {
            newsContent: [
                {
                    id: 1,
                    title: "Yin Yang, sebuah kekuatan bersatu dalam satu rasa",
                    description: "Kucing ini tertidur pulas",
                    thumbnail: "/storage/kucing.jpeg"
                },
                {
                    id: 2,
                    title:
                        "Ngakak abieez Cyberbug 2077 berasa seperti Cyberpunk jaman perang!",
                    description: "duar duar",
                    thumbnail: "/storage/kucing.jpeg"
                }
            ]
        };
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
