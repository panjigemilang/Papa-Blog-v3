<template>
    <div class="news container">
        <div
            class="news-content flex flex-row py-16 border-t-2 border-gray-200"
            v-for="(content, i) in newsContent"
            :key="i"
        >
            <div class="content pr-28 pt-4 w-7/12">
                <h1 class="font-black mb-4 tracking-wide md:text-4xl">
                    <router-link
                        class="transition-all duration-300 title"
                        :to="{
                            name: 'Post',
                            params: {
                                id: content.id,
                                title: content.title
                                    .toLowerCase()
                                    .replace(/\s|\+/g, '-')
                                    .replace(/:|&\s|,|;|\./g, '')
                            }
                        }"
                    >
                        {{ content.title }}
                    </router-link>
                </h1>
                <p v-html="content.content"></p>
            </div>
            <router-link
                class="w-5/12"
                :to="{
                    name: 'Post',
                    params: {
                        id: content.id,
                        title: content.title
                            .toLowerCase()
                            .replace(/\s|\+/g, '-')
                            .replace(/:|&\s|,|;|\./g, '')
                    }
                }"
            >
                <img
                    :src="
                        content.image_cover
                            ? content.image_cover
                            : 'img/cover/default.jpg'
                    "
                    alt="Image"
                    class="rounded-lg object-cover thumbnail w-10/12 mx-auto"
                />
            </router-link>
        </div>
        <div class="text-center my-8">
            <router-link to="posts">
                <button class="load-more">
                    Load More
                </button>
            </router-link>
        </div>
    </div>
</template>

<script>
export default {
    name: "News-Content",
    props: {
        newsContent: Array
    }
};
</script>

<style lang="scss" scoped>
@import "../../../sass/variables.scss";

.thumbnail {
    box-shadow: 0px 8px 30px 0px rgba(0, 0, 0, 0.5);
    height: 280px;
}

div.news-content:nth-last-child(2) {
    border-bottom: 2px rgba(229, 231, 235, 1) solid;
}

.content .title:hover {
    color: $bg-primary;
}

button.load-more {
    background-color: rgba(0, 0, 0, 0.1);
    border: 1px rgba(0, 0, 0, 0.3) solid;
    border-radius: 4px;
    width: 11rem;
}
</style>
