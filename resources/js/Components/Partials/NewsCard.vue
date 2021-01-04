<template>
    <div class="card flex flex-row">
        <div
            class="md:w-4/12 px-4"
            v-for="(post, i) in formattedPosts"
            :key="i"
        >
            <div class="rounded-lg shadow-2xl overflow-hidden">
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
                        alt="thumbnail"
                        class="w-full h-72 object-cover"
                    />
                </router-link>
                <div class="pt-4 pb-6 px-8">
                    <div class="sub flex flex-row mb-4">
                        <img
                            src="/img/assets/icons/ic_date_range_24px.svg"
                            class="icon mr-2"
                        />
                        <p>
                            {{ post.created_at }}
                        </p>
                        <div class="author ml-auto">
                            <i class="fas fa-user mr-2"></i>
                            {{ post.admin.name }}
                        </div>
                    </div>
                    <h1
                        class="text-3xl font-black mb-4 hover:text-blue-600 transition-colors"
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
                            {{
                                post.title.length > maxChar
                                    ? shorten(post.title, maxChar).concat(
                                          concateText
                                      )
                                    : post.title
                            }}
                        </router-link>
                    </h1>
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
                        <p
                            class="transition-colors text-blue-400 hover:text-blue-600"
                        >
                            Read More
                        </p>
                    </router-link>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import moment from "moment";

export default {
    name: "News_Card",
    data() {
        return {
            concateText: " ...",
            maxChar: 55
        };
    },
    props: {
        newsContent: Array,
        shorten: Function
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

<style></style>
