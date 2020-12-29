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
                <tbody>
                    <tr v-for="(post, i) in formattedPosts" :key="i">
                        <td class="text-center">
                            {{ i + 1 }}
                        </td>
                        <td class="text-center">
                            {{ post.title }}
                        </td>
                        <td class="text-center"></td>
                        <td class="text-center">
                            {{ post.created_at }}
                        </td>
                        <td class="text-center">
                            {{ post.updated_at }}
                        </td>
                        <td class="text-center">
                            <router-link
                                class="text-blue-400 hover:text-blue-500 p-4"
                                :to="'/editPost/' + post.id"
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
import { mapActions } from "vuex";
import moment from "moment";

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
        }
    },
    methods: {
        ...mapActions("posts", ["deletePost"]),
        onDelete(postId) {
            const confirm = window.confirm(
                "Are you sure you want to delete it?"
            );

            if (confirm) {
                this.deletePost();
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
