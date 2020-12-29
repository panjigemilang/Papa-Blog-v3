<template>
    <div class="min-h-screen w-full add-post">
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
                            required
                        />
                    </div>
                </div>

                <div class="flex flex-row flex-wrap my-8">
                    <label class="md:w-2/12 leading-10">Post Content</label>
                    <div class="md:w-10/12 content">
                        <wysiwyg v-model="content" aria-required="true" />
                    </div>
                </div>

                <div class="flex flex-row flex-wrap my-8">
                    <label class="md:w-2/12 leading-10">Cover Image</label>
                    <div class="md:w-10/12">
                        <input
                            type="file"
                            name="image_cover"
                            @change="onChangeImage"
                            v-if="uploadReady"
                            class="form-control"
                            required
                        />
                    </div>
                </div>

                <div class="flex flex-row flex-wrap my-8">
                    <label class="md:w-2/12 leading-10">Tags</label>
                    <div class="md:w-10/12">
                        <input
                            v-model="tagsVal"
                            type="text"
                            placeholder="Tags ... "
                            name="tags"
                            class="form-control"
                            @keyup.space="addTag"
                        />
                        <small>Add tags by pressing spacebar</small>
                        <div class="flex flex-row flex-wrap mt-3">
                            <p
                                class="p-2 mr-3 opacity-80 rounded-lg text-white bg-green-300"
                                v-for="(tag, i) in tags"
                                :key="'tag-' + i"
                            >
                                {{ tag }}
                                <i
                                    class="cursor-pointer fas fa-times ml-1"
                                    @click.prevent="deleteTag(i)"
                                ></i>
                            </p>
                        </div>
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
            image_cover: {},
            tags: [],
            tagsVal: "",
            uploadReady: true
        };
    },
    computed: {
        ...mapState("posts", ["loading"])
    },
    methods: {
        ...mapActions("posts", ["addPost"]),
        ...mapMutations("services", ["setErrors"]),
        addTag() {
            if (!this.tagsVal == "") this.tags.push(this.tagsVal.trim());

            this.tagsVal = "";
        },
        deleteTag(index) {
            this.tags.splice(index, 1);
        },
        createPost() {
            // Extracting all the base64 images
            const image_files = this.content.match(/data:image.+?(?=")/g);

            // replacing the img tag with empty src to be replace later
            const content = this.content.replace(/data:image.+?(?=")/g, "");

            const data = new FormData();
            data.append("title", this.title);
            data.append("content", content);
            data.append("image_files", image_files);
            data.append("image_cover", this.image_cover);
            data.append("tags", this.tags);

            this.addPost(data).then(() => {
                // emptying all the values
                this.title = "";
                this.content = "";
                this.tags = [];
                this.uploadReady = false;
                this.$nextTick(() => {
                    this.uploadReady = true;
                });
            });
        },
        onChangeImage(e) {
            const sizeLimit = 2000000;

            if (e.target.files[0].size > sizeLimit) {
                return this.setErrors({
                    message: "Image oversized"
                });
            }

            this.image_cover = e.target.files[0];
        }
    }
};
</script>
