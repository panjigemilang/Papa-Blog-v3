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
                    class="font-black md:text-5xl absolute top-1/2 transform -translate-y-1/2 w-7/12 py-8 pl-16 tracking-wider text-white"
                >
                    {{ post.data[0].title }}
                </h1>
            </div>
            <div class="container flex flex-row">
                <div class="md:w-7/12 p-8 content">
                    <div v-html="content"></div>
                </div>
                <div class="relative md:w-5/12">
                    <Trending />
                </div>
            </div>
        </fragment>
    </div>
</template>

<script>
import Trending from "../Partials/Trending";
import Loading from "../Utils/Loading";
import isEmpty from "../Utils/isEmpty";
import { Fragment } from "vue-fragment";
import { mapActions, mapState } from "vuex";

export default {
    name: "Post_Detail",
    components: {
        Trending,
        Fragment,
        Loading
    },
    computed: {
        ...mapState("posts", ["loading", "post"]),
        content() {
            const images = this.post.data[0].content.match(/src=""/g);

            console.log("Images", images);

            if (isEmpty(images)) {
                return this.post.data[0].content;
            } else {
                let content = this.post.data[0].content;

                for (let i = 0; i < images.length; i++) {
                    content = content.replace(
                        'src=""',
                        `src="${this.post.data[i].img_path}"`
                    );
                }

                return content;
            }
        }
    },
    methods: {
        ...mapActions("posts", ["getAllPosts"])
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
