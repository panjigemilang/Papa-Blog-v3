<template>
    <div class="news md:w-7/12 mr-4">
        <div
            class="rounded-lg flex flex-row border-gray-300 bg-gray-800 shadow-xl mb-8"
            v-for="(content, index) in newsContent"
            :key="index"
        >
            <a class="w-4/12" href="#">
                <img
                    :src="content.thumbnail"
                    alt="Image"
                    class="rounded-lg object-cover mr-3 thumbnail w-full"
                />
            </a>
            <div class="content p-4 w-8/12">
                <h1 class="font-black mb-4 text-xl">
                    <a class="transition-all duration-300 title" href="#">
                        {{ content.title }}
                    </a>
                </h1>
                <div class="author">
                    <div class="flex flex-row">
                        <img
                            src="https://via.placeholder.com/30x30.png"
                            alt="Author"
                            class="rounded-full author-image mr-2"
                        />
                        <div class="flex flex-col text-white">
                            <p>
                                <span class="opacity-70">
                                    by
                                </span>
                                <span class="opacity-100">Panji Gemilang</span>
                            </p>
                            <small class="opacity-70">about 8 hours ago</small>
                        </div>
                    </div>
                </div>
            </div>
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

.author-image {
    height: 40px;
    width: 40px;
}

.thumbnail {
    height: 164px;
}

.content .title:hover {
    color: $color-secondary;
}
</style>
