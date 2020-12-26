<template>
    <div class="min-h-screen w-full">
        <form class="container mx-auto py-8" @submit.prevent="createPost">
            <div class="flex flex-row">
                <label class="md:w-2/12">Post Title</label>
                <div class="md:w-10/12">
                    <input
                        v-model="title"
                        type="text"
                        placeholder="New Post Title"
                        name="title"
                        class="form-control"
                    />
                </div>
            </div>

            <div class="flex flex-row">
                <label class="md:w-2/12">Post Text</label>
                <div class="md:w-10/12">
                    <wysiwyg v-model="content" />
                </div>
            </div>

            <div class="flex flex-row">
                <label class="md:w-2/12">Post Image</label>
                <div class="md:w-10/12">
                    <input
                        type="file"
                        name="post_image"
                        @change="postImage"
                        class="form-control"
                    />
                </div>
            </div>

            <div class="text-center">
                <button
                    type="submit"
                    class="rounded-lg shadow-lg bg-blue-400 text-white w-2/6 focus:rounded-lg"
                >
                    Add Post
                </button>
            </div>
        </form>
    </div>
</template>

<script>
import { mapActions } from "vuex";

export default {
    name: "Add_Post",
    data() {
        return {
            title: "",
            content: ""
        };
    },
    methods: {
        ...mapActions("posts", ["addPost"]),
        createPost() {
            // Extracting all the base64 images
            const image_files = this.content.match(/data:image.+?(?=")/g);

            // replacing the img tag with empty src to be replace later
            const content = this.content.replace(/data:image.+?(?=")/g, "");

            const data = {
                image_files,
                title: this.title,
                content
            };

            this.addPost(data).then(() => {
                console.log("Setelah upload");
            });
        },
        postImage() {
            console.log("pipop");
        }
    }
};
</script>
