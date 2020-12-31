<template>
    <div class="trending sticky top-0 py-8 px-4">
        <h1 class="tracking-widest text-lg mb-4 font-black">
            TRENDING NOW
        </h1>
        <div
            class="absolute top-full left-1/2 transform -translate-y-1/2 -translate-x-1/2"
            v-if="loading"
        >
            <i class="text-5xl fas fa-circle-notch fa-spin"></i>
        </div>
        <div
            class="flex flex-row mb-4"
            v-for="(post, i) in filterData"
            :key="i"
            v-else
        >
            <router-link
                :to="{
                    name: 'Post',
                    params: {
                        id: post.id,
                        title: post.title
                            .toLowerCase()
                            .replace(/\s|\+/g, '-')
                            .replace(/:|&\s|,|;|\./g, '')
                    }
                }"
            >
                <img
                    :src="post.image_cover"
                    alt="Thumbnail"
                    class="thumbnail object-cover rounded-lg shadow-lg"
                />
            </router-link>
            <h2 class="w-max px-4 py-2">
                <strong>
                    <router-link
                        :to="{
                            name: 'Post',
                            params: {
                                id: post.id,
                                title: post.title
                                    .toLowerCase()
                                    .replace(/\s|\+/g, '-')
                                    .replace(/:|&\s|,|;|\./g, '')
                            }
                        }"
                    >
                        {{ post.title }}
                    </router-link>
                </strong>
            </h2>
        </div>
    </div>
</template>

<script>
import { mapState } from "vuex";

export default {
    name: "Trending_News",
    computed: {
        ...mapState("posts", ["posts", "loading"]),
        filterData() {
            return this.posts.data.data.filter(
                item => item.id !== parseInt(this.$route.params.id)
            );
        }
    },
    created() {
        console.log("Params", this.$route.params);
    }
};
</script>

<style lang="scss" scoped>
.thumbnail {
    height: 80px;
    width: 80px;
}

.tracking-widest {
    letter-spacing: 0.3rem;
}
</style>
