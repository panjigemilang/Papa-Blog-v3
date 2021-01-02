<template>
    <div>
        <Loading v-if="loading" />
        <div v-else>
            <NavTags />
            <Featured
                :stripHtml="stripHtml"
                :shorten="shorten"
                :galleryContent="posts.data.data"
            />
            <div class="flex flex-col">
                <News
                    :stripHtml="stripHtml"
                    :shorten="shorten"
                    :newsContent="posts.data.data"
                />
                <div class="text-center my-8">
                    <router-link to="posts">
                        <button class="load-more shadow-lg">
                            Load More
                        </button>
                    </router-link>
                </div>
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
                <NewsCard :shorten="shorten" :newsContent="posts.data.data" />
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
        ...mapActions("posts", ["getPosts"]),
        shorten(str, maxLen, separator = " ") {
            if (str.length <= maxLen) return str;

            return str.substr(0, str.lastIndexOf(separator, maxLen));
        },
        stripHtml(content) {
            // Create a new div element
            let temp = document.createElement("div");
            // Set the HTML content with the providen
            temp.innerHTML = content;
            // Retrieve the text property of the element (cross-browser support)
            return temp.textContent || temp.innerText || "";
        }
    },
    created() {
        this.getPosts();
    }
};
</script>

<style lang="scss" scoped>
button.load-more {
    background: rgb(3, 72, 191);
    background: linear-gradient(
        160deg,
        rgba(3, 72, 191, 1) 0%,
        rgba(32, 98, 212, 1) 35%,
        rgba(0, 164, 255, 1) 100%
    );
    border-radius: 4px;
    color: white;
    width: 11rem;
}
</style>
