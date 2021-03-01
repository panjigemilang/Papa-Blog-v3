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
                    class="font-black text-2xl md:text-5xl absolute bottom-6 md:bottom-12 w-full md:w-7/12 py-8 pl-6 md:pl-16 tracking-wider text-white"
                >
                    {{ post.data[0].title }}
                </h1>
            </div>
            <div class="container flex flex-row flex-wrap">
                <div class="w-full md:w-7/12 py-4 px-8">
                    <div class="flex flex-row flex-wrap pb-2 md:pb-0">
                        <p class="md:py-4 break-words text-blue-500">
                            Blog >&nbsp;
                        </p>
                        <p
                            class="md:py-4 break-words text-blue-500 hover:text-blue-600"
                        >
                            <router-link
                                :to="
                                    `/posts?tag=${activeTag.replace(' > ', '')}`
                                "
                            >
                                {{ activeTag }}
                            </router-link>
                        </p>
                        <p class="md:py-4 break-words text-blue-500">
                            {{ post.data[0].title }}
                        </p>
                    </div>
                    <div class="content" v-html="content"></div>
                </div>
                <div class="relative w-full md:w-5/12">
                    <Trending />
                </div>
            </div>
            <div class="container">
                <h1
                    class="tracking-wider text-xl md:text-4xl font-black md:mb-4 px-4"
                >
                    You May Also Like
                </h1>
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
            const imagesLength = this.post.data[0].pictures.length;

            if (isEmpty(imagesLength)) {
                return content;
            } else {
                for (let i = 0; i < imagesLength; i++) {
                    content = content.replace(
                        'src=""',
                        `src="${this.post.data[0].pictures[i].img_path}"`
                    );
                }

                return content;
            }
        },
        activeTag() {
            let content = this.post.data[0].tags[0].tags.length
                ? this.post.data[0].tags[0].tags
                : "";

            if (content) {
                content += " > ";
            }

            return content;
        },
        excludePost() {
            const posts = this.posts.data.data.filter(
                item => item.id != this.$route.params.id
            );

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
@media (max-width: 640px) {
    .banner-image {
        height: 60vh;
    }
}
</style>
