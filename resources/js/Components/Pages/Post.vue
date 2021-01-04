<template>
    <div class="post-detail">
        <Loading v-if="loading" />
        <fragment v-else>
            <div class="banner-image relative overflow-hidden w-full">
                <img
                    :src="post.data[0].image_cover"
                    alt="Banner"
                    class="object-cover w-full h-full"
                />
                <div class="overlay"></div>
                <h1
                    class="font-black text-lg md:text-5xl absolute bottom-12 w-7/12 py-8 pl-16 tracking-wider text-white"
                >
                    {{ post.data[0].title }}
                </h1>
            </div>
            <div class="container flex flex-row flex-wrap">
                <div class="md:w-7/12 p-8 content">
                    <div v-html="content"></div>
                </div>
                <div class="relative md:w-5/12">
                    <Trending />
                </div>
            </div>
            <div class="container">
                <NewsCard :shorten="shorten" :newsContent="excludePost" />
            </div>
        </fragment>
    </div>
</template>

<script>
import Trending from "../Partials/Trending";
import NewsCard from "../Partials/NewsCard";
import Loading from "../Utils/Loading";
import isEmpty from "../Utils/isEmpty";
import { Fragment } from "vue-fragment";
import { mapActions, mapState } from "vuex";

export default {
    name: "Post_Detail",
    components: {
        Trending,
        NewsCard,
        Fragment,
        Loading
    },
    computed: {
        ...mapState("posts", ["loading", "post", "posts"]),
        content() {
            let content = this.post.data[0].content;

            // replace text iframe to iframe tag
            content = content.replace(/&lt;/g, "<");
            content = content.replace(/&gt;/g, ">");
            // replace empty src with data
            const images = content.match(/src=""/g);

            if (isEmpty(images)) {
                return content;
            } else {
                for (let i = 0; i < images.length; i++) {
                    content = content.replace(
                        'src=""',
                        `src="${this.post.data[i].img_path}"`
                    );
                }

                return content;
            }
        },
        excludePost() {
            const posts = this.posts.data.data.filter(
                item => item.id != this.$route.params.id
            );

            console.log("Posts, Route", posts, this.$route);

            return posts;
        }
    },
    methods: {
        ...mapActions("posts", ["getAllPosts"]),
        shorten(str, maxLen, separator = " ") {
            if (str.length <= maxLen) return str;

            return str.substr(0, str.lastIndexOf(separator, maxLen));
        }
    },
    created() {
        const data = {
            id: this.$route.params.id,
            limit: 5
        };

        this.getAllPosts(data);
    }
};
</script>

<style lang="scss" scoped>
.banner-image {
    height: 60vh;
}
</style>
