<template>
    <div class="trending sticky top-0 py-8 px-4">
        <h1 class="tracking-widest text-lg mb-4 font-black">
            TRENDING NOW
        </h1>
        <div class="flex flex-row" v-for="(content, i) in contents" :key="i">
            <a href="#">
                <img
                    :src="content.image"
                    alt="Thumbnail"
                    class="thumbnail object-cover rounded-lg"
                />
            </a>
            <h2 class="w-max px-4 py-2">
                <strong>
                    <a href="#">
                        {{ content.title }}
                    </a>
                </strong>
            </h2>
        </div>
    </div>
</template>

<script>
export default {
    name: "Trending_News",
    data() {
        return {
            contents: [
                {
                    image: "http://via.placeholder.com/80x80.png",
                    title:
                        "Haru ga kite anna ni suki datta no ni, habe mo sora mo"
                }
            ]
        };
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
