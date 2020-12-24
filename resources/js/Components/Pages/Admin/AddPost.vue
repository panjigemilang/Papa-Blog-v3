<template>
    <div class="min-h-screen w-full">
        <form class="container mx-auto py-8" @submit.prevent="createPost">
            <div class="flex flex-row">
                <label class="md:w-2/12">Post Title</label>
                <div class="md:w-10/12">
                    <input
                        v-model="form.post_title"
                        type="text"
                        placeholder="New Post Title"
                        name="post_title"
                        class="form-control"
                        :class="{ 'is-invalid': form.errors.has('post_title') }"
                    />
                    <has-error :form="form" field="post_title"></has-error>
                </div>
            </div>

            <div class="flex flex-row">
                <label class="md:w-2/12">Post Text</label>
                <div class="md:w-10/12">
                    <ckeditor
                        class="md:w-10/12 form-control"
                        :class="{ 'is-invalid': form.errors.has('post_text') }"
                        tag-name="textarea"
                        name="post_text"
                        :editor="editor"
                        v-model="form.post_text"
                        :config="editorConfig"
                    ></ckeditor>
                    <has-error :form="form" field="post_text"></has-error>
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
                        :class="{ 'is-invalid': form.errors.has('post_image') }"
                    />
                    <has-error :form="form" field="post_image"></has-error>
                </div>
            </div>

            <div class="text-center">
                <button
                    type="submit"
                    class="rounded-lg shadow-lg bg-blue-400 text-white w-2/6 focus:rounded-lg"
                >
                    Add New
                </button>
            </div>
        </form>
    </div>
</template>

<script>
import ClassicEditor from "@ckeditor/ckeditor5-build-classic";
import Form from "vform";

export default {
    name: "Add_Post",
    data() {
        return {
            editor: ClassicEditor,
            editorData: "<p>Your Post Content</p>",
            editorConfig: {},

            form: new Form({
                post_text: "",
                post_title: "",
                post_image: ""
            })
        };
    },
    methods: {
        postImage(image) {
            let file = image.target.files[0];
            let reader = new FileReader();
            if (file["size"] < 2000000) {
                reader.onloadend = file => {
                    this.form.post_image = reader.result;
                };
                reader.readAsDataURL(file);
            } else {
                swal.fire({
                    icon: "error",
                    title: "Opps",
                    text: "Please select file smaller than 2 MB"
                });
            }
        },
        createPost() {
            alert("Created Post");
            // this.$Progress.start();
            // this.form.post("/admin/post").then(() => {
            //     toast.fire({
            //         icon: "success",
            //         title: "Post Added Successfully"
            //     });
            //     this.$Progress.finish();
            //     this.form.reset();
            // });
        }
    }
};
</script>
