<template>
    <div class="news container">
        <div v-if="emptyNews">
            <h1 class="text-4xl p-4">No Post Found.</h1>
        </div>
        <div
            class="news-content flex flex-row flex-wrap py-8 md:py-16 border-t-2 border-gray-200"
            v-for="(content, i) in formattedPosts"
            :key="i"
            v-else
        >
            <div
                class="content relative px-8 md:pr-28 pt-4 w-full md:w-7/12 order-2 md:order-1"
            >
                <h1 class="font-black mb-4 tracking-wide text-lg md:text-4xl">
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
                <p>
                    {{
                        content.content.length > maxChar
                            ? shorten(
                                  stripHtml(content.content),
                                  maxChar
                              ).concat(concateText)
                            : stripHtml(content.content)
                    }}
                </p>
                <div class="tags flex flex-wrap items-center my-3">
                    <span
                        class="px-2.5 py-1.5 rounded-lg mr-1.5 text-blue-400 hover:text-blue-600 link"
                        v-for="item in content.tags"
                        :key="`tag-${item.tags}`"
                    >
                        <router-link :to="`/posts?tag=${item.tags}`">
                            <i> #{{ item.tags }} </i>
                        </router-link>
                    </span>
                </div>
                <small
                    class="float-right static md:absolute -bottom-8 right-20 text-sm md:text-base flex flex-row pt-4 md:pt-0"
                >
                    <img
                        src="img/assets/icons/ic_date_range_24px.svg"
                        class="icon mr-2"
                    />
                    {{ content.created_at }}
                </small>
            </div>
            <router-link
                class="w-full md:w-5/12 order-1 md:order-2"
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
    </div>
</template>

<script>
import moment from "moment";
import isEmpty from "../Utils/isEmpty";

export default {
    name: "News-Content",
    data() {
        return {
            concateText: " ...",
            maxChar: 300
        };
    },
    props: {
        newsContent: Array,
        shorten: Function,
        stripHtml: Function
    },
    computed: {
        formattedPosts() {
            const posts = this.newsContent.map(item => ({
                ...item,
                created_at: new moment(item.created_at).format("DD-MMM-YYYY"),
                updated_at: new moment(item.updated_at).format("DD-MMM-YYYY")
            }));

            return posts;
        },
        emptyNews() {
            return isEmpty(this.newsContent);
        }
    }
};
</script>

<style lang="scss" scoped>
.thumbnail {
    box-shadow: 0px 9px 28px -8px rgba(0, 0, 0, 0.5);
    height: 280px;
}

div.news-content:nth-last-child(1) {
    border-bottom: 2px rgba(229, 231, 235, 1) solid;
}
</style>
