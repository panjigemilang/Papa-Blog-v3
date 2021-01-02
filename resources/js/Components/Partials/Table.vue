<template>
    <div class="min-h-screen w-full">
        <div class="container">
            <table class="table-fixed rounded-lg w-full bg-white text-gray-800">
                <thead>
                    <tr>
                        <th class="w-auto">
                            No
                        </th>
                        <th class="w-2/12">
                            Title
                        </th>
                        <th class="w-3/12">
                            Cover
                        </th>
                        <th class="w-2/12">
                            Created
                        </th>
                        <th class="w-2/12">
                            Modified
                        </th>
                        <th class="w-2/12">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody v-if="emptyData">
                    <tr>
                        <td colspan="6" class="text-center font-bold">
                            No posts found. You can add new post on the left
                            side navigation bar.
                        </td>
                    </tr>
                </tbody>
                <tbody v-else>
                    <tr v-for="(post, i) in formattedPosts" :key="i">
                        <td class="text-center">
                            {{ i + 1 }}
                        </td>
                        <td class="text-center">
                            <router-link
                                class="title"
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
                        </td>
                        <td class="text-center">
                            <div class="w-10/12 mx-auto max-h-60">
                                <img
                                    :src="post.image_cover"
                                    alt="Cover"
                                    class="object-cover"
                                />
                            </div>
                        </td>
                        <td class="text-center">
                            {{ post.created_at }}
                        </td>
                        <td class="text-center">
                            {{ post.updated_at }}
                        </td>
                        <td class="text-center">
                            <router-link
                                class="text-blue-400 hover:text-blue-500 p-4"
                                :to="{
                                    name: 'editPost',
                                    params: {
                                        id: post.id
                                    }
                                }"
                            >
                                Edit
                            </router-link>
                            <button
                                class="text-red-400 hover:text-red-500"
                                @click.prevent="onDelete(post.id)"
                            >
                                Delete
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
import { mapActions, mapMutations } from "vuex";
import moment from "moment";
import isEmpty from "../Utils/isEmpty";

export default {
    name: "Table",
    props: {
        posts: Array
    },
    computed: {
        formattedPosts() {
            const posts = this.posts.map(item => ({
                ...item,
                created_at: new moment(item.created_at).format(
                    "hh:mm A DD-MMM-YYYY"
                ),
                updated_at: new moment(item.updated_at).format(
                    "hh:mm A DD-MMM-YYYY"
                )
            }));

            return posts;
        },
        emptyData() {
            return isEmpty(this.posts);
        }
    },
    methods: {
        ...mapActions("posts", ["deletePost"]),
        ...mapActions("general", ["toggleToast"]),
        ...mapMutations("general", ["setMessages"]),
        onDelete(postId) {
            const confirm = window.confirm(
                "Are you sure you want to delete it?"
            );

            if (confirm) {
                this.deletePost(postId).then(() => {
                    this.setMessages("Delete post success!");
                    this.toggleToast();
                });
            }
        }
    }
};
</script>

<style lang="scss" scoped>
th,
td {
    border: 1px rgba($color: #000000, $alpha: 0.8) solid;
    padding: 16px;
}

button:hover {
    box-shadow: none !important;
}
</style>
