<template>
    <div class="news container">
        <div
            class="news-content flex flex-row py-16 border-t-2 border-gray-200"
            v-for="(content, i) in formattedPosts"
            :key="i"
        >
            <div class="content relative pr-28 pt-4 w-7/12">
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
                <small
                    class="absolute -bottom-8 right-20 text-base flex flex-row"
                >
                    <img
                        src="img/assets/icons/ic_date_range_24px.svg"
                        class="icon mr-2"
                    />
                    {{ content.created_at }}
                </small>
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
    </div>
</template>

<script>
import moment from "moment";

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
