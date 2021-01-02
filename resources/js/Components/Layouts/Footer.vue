<template>
    <footer
        class="md:py-16 md:px-36 bg-gray-800 relative w-full mt-12"
        :class="['', loading ? 'hidden' : '', isAuthenticated ? 'hidden' : '']"
    >
        <div class="bg-white p-8 text-center flex flex-row flex-wrap">
            <div class="md:w-1/6 w-6/6 mx-auto md:mx-0 mb-6 md:mb-0">
                <img
                    src="/img/profile/panji.jpg"
                    alt="author"
                    class="w-24 h-24 rounded-full shadow-lg"
                />
            </div>
            <h1 class="text-xl font-black md:w-4/6 w-6/6 mb-6 md:mb-0">
                Subscribe and join thousands like you!
            </h1>
            <div
                class="sosmed md:w-1/6 w-6/6 flex flex-row justify-center items-center"
            >
                <a
                    href="http://instagram.com/_panjig"
                    target="_blank"
                    rel="noopener noreferrer"
                >
                    <i class="fab fa-instagram text-3xl mr-4"></i>
                </a>
                <a
                    href="/img/assets/line.jpeg"
                    target="_blank"
                    rel="noopener noreferrer"
                >
                    <i class="fab fa-line text-3xl mr-4"></i>
                </a>
                <a href="mailto:panjigemilang31298@gmail.com">
                    <i class="far fa-envelope text-3xl mr-4"></i>
                </a>
            </div>
        </div>
    </footer>
</template>

<script>
import { mapState } from "vuex";

export default {
    name: "Footer",
    computed: {
        ...mapState("services", {
            servicesLoading: state => state.loading,
            isAuthenticated: state => state.isAuthenticated
        }),
        ...mapState("posts", {
            postsLoading: state => state.loading
        }),
        loading() {
            if (this.servicesLoading || this.postsLoading) {
                return true;
            } else {
                return false;
            }
        }
    }
};
</script>

<style lang="scss" scoped>
@media (min-width: 768px) {
    footer h1 {
        line-height: 6rem;
    }
}
</style>
