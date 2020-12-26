<template>
    <div class="container py-8">
        <Featured :galleryContent="galleryContent" />
        <div class="flex flex-row">
            <News :newsContent="newsContent" />
            <Trending />
        </div>
    </div>
</template>

<script>
import { mapState } from "vuex";
import Featured from "../Partials/Featured";
import News from "../Partials/News";
import Trending from "../Partials/Trending";

export default {
    name: "Home",
    components: {
        Featured,
        News,
        Trending
    },
    data() {
        return {
            galleryContent: [
                {
                    image: "/storage/tamvan.jpeg",
                    title:
                        "Seorang mahasiswa tamvan menakhlukan seluruh wanita jepang hanya dengan senyuman manis"
                },
                {
                    image: "/storage/neru.jpeg",
                    title: "Sepasang mahasiswa siap melakukan kegiatan g4y"
                },
                {
                    image: "/storage/neru 2.jpeg",
                    title: "Naruto Priyambodo ditemukan ternyata asli Blitar!"
                },
                {
                    image: "/storage/tidur.jpeg",
                    title: "Seorang mahasiswa tertidur saat sedang tidur siang"
                },
                {
                    image: "/storage/insang.jpeg",
                    title:
                        "Mahasiswa ini ternyata menyimpan anak kecil didalam jaketnya wow!"
                }
            ],
            newsContent: [
                {
                    id: 1,
                    title: "Yin Yang, sebuah kekuatan bersatu dalam satu rasa",
                    thumbnail: "/storage/kucing.jpeg"
                }
            ]
        };
    },
    computed: {
        ...mapState("services", ["user", "isAuthenticated"])
    }
};
</script>

<style scoped>
@media (min-width: 1536px) {
    .container {
        max-width: 1200px;
    }
}
</style>
