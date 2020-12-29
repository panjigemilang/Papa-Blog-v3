<template>
    <div class="min-h-screen w-full">
        <div class="container py-8">
            <h1 class="heading text-center text-3xl font-black">
                Add Post
            </h1>
            <form
                class="py-8"
                @submit.prevent="createPost"
                enctype="multipart/form-data"
            >
                <div class="flex flex-row flex-wrap my-8">
                    <label class="md:w-2/12 leading-10">Post Title</label>
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

                <div class="flex flex-row flex-wrap my-8">
                    <label class="md:w-2/12 leading-10">Post Content</label>
                    <div class="md:w-10/12">
                        <wysiwyg v-model="content" />
                    </div>
                </div>

                <div class="flex flex-row flex-wrap my-8">
                    <label class="md:w-2/12 leading-10">Cover Image</label>
                    <div class="md:w-10/12">
                        <input
                            type="file"
                            name="image_cover"
                            @change="onChangeImage"
                            class="form-control"
                        />
                    </div>
                </div>

                <div class="text-center">
                    <button
                        type="submit"
                        class="rounded-lg shadow-lg bg-blue-400 text-white w-2/6 focus:rounded-lg"
                    >
                        <i
                            class="fas fa-circle-notch fa-spin"
                            v-if="loading"
                        ></i>
                        Add Post
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import { mapActions, mapMutations, mapState } from "vuex";

export default {
    name: "Add_Post",
    data() {
        return {
            title: "",
            content: "",
            image_cover: {}
        };
    },
    computed: {
        ...mapState("posts", ["loading"])
    },
    methods: {
        ...mapActions("posts", ["addPost"]),
        ...mapMutations("services", ["setErrors"]),
        createPost() {
            // Extracting all the base64 images
            const image_files = this.content.match(/data:image.+?(?=")/g);

            // replacing the img tag with empty src to be replace later
            const content = this.content.replace(/data:image.+?(?=")/g, "");

            // const data = {
            //     image_files,
            //     title: this.title,
            //     content
            //     image_cover: this.image_cover
            // };

            // console.log("Data : ", data);

            const data = new FormData();
            data.append("title", this.title);
            data.append("content", content);
            data.append("image_files", image_files);
            data.append("image_cover", this.image_cover);

            // for (let pair of data.entries()) {
            //     console.log(pair[0] + ", " + pair[1]);
            // }

            this.addPost(data).then(() => {});
        },
        onChangeImage(e) {
            const sizeLimit = 2000000;

            if (e.target.files[0].size > sizeLimit) {
                return this.setErrors({
                    message: "Image oversized"
                });
            }
            console.log("Files", e.target.files[0]);

            this.image_cover = e.target.files[0];
        }
    }
};
</script>
