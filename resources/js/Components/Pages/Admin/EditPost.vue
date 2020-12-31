<template>
    <div class="min-h-screen w-full add-post">
        <Loading v-if="loading" />
        <div class="container py-8" v-else>
            <h1 class="heading text-center text-3xl font-black">
                Edit Post
            </h1>
            <form
                class="py-8"
                @submit.prevent="edit"
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
                        Edit Post
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import { mapActions, mapMutations, mapState } from "vuex";
import isEmpty from "../../Utils/isEmpty";
import Loading from "../../Utils/Loading";

export default {
    name: "Edit_Post",
    components: {
        Loading
    },
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
        ...mapState("posts", ["loading", "errors", "post"])
    },
    methods: {
        ...mapActions("posts", ["editPost", "getPost"]),
        ...mapActions("general", ["toggleToast"]),
        ...mapMutations("services", ["setErrors"]),
        ...mapMutations("general", ["setMessages"]),
        addTag() {
            if (!this.tagsVal == "") this.tags.push(this.tagsVal.trim());

            this.tagsVal = "";
        },
        deleteTag(index) {
            this.tags.splice(index, 1);
        },
        edit() {
            // check condition of inserted file
            if (!isEmpty(this.image_cover)) {
                if (!this.image_cover.type.includes("image")) {
                    return this.toggleToast();
                }
            }
            // clearing all errors
            this.setErrors({});
            // Extracting all the base64 images
            const image_files = this.content.match(/data:image.+?(?=")/g);

            // replacing the img tag with empty src to be replace later
            const content = this.content.replace(/data:image.+?(?=")/g, "");

            const data = new FormData();
            data.append("id", this.$route.params.id);
            data.append("title", this.title);
            data.append("content", content);
            data.append("image_files", image_files);
            data.append("image_cover", this.image_cover);
            data.append("tags", this.tags);

            this.editPost(data).then(() => {
                if (isEmpty(this.errors)) {
                    this.uploadReady = false;
                    this.$nextTick(() => {
                        this.uploadReady = true;
                    });

                    this.setMessages("Edit post success!");
                    this.toggleToast();
                }
            });
        },
        onChangeImage(e) {
            // check file type and size
            if (e.target.files[0].type.includes("image")) {
                const sizeLimit = 2000000;

                if (e.target.files[0].size > sizeLimit) {
                    this.setErrors({
                        message: "Image oversized"
                    });

                    return this.toggleToast();
                }
            } else {
                this.setErrors({
                    message: "File should be an image type! (jpg, jpeg, png)"
                });

                return this.toggleToast();
            }

            this.image_cover = e.target.files[0];
        }
    },
    created() {
        this.getPost(this.$route.params.id).then(() => {
            this.title = this.post.data[0].title;
            this.content = this.post.data[0].content;

            if (!isEmpty(this.post.data[0].tags)) {
                this.tags = this.post.data[0].tags.split(",");
            }
        });
    }
};
</script>
