<template>
    <div>
        <Featured :galleryContent="galleryContent" />
        <div class="flex flex-row">
            <News :newsContent="newsContent" />
        </div>
        <div class="latest-post container mt-12">
            <div class="heading mb-16 w-7/12">
                <h1 class="text-4xl">
                    Latest Posts
                </h1>
                <p>
                    Latest posts that currently hot, we provide super cool all
                    news around the world
                </p>
            </div>
            <NewsCard />
        </div>
    </div>
</template>

<script>
import { mapState } from "vuex";
import Featured from "../Partials/Featured";
import News from "../Partials/News";
import NewsCard from "../Partials/NewsCard";
import Trending from "../Partials/Trending";

export default {
    name: "Home",
    components: {
        Featured,
        News,
        NewsCard,
        Trending
    },
    data() {
        return {
            galleryContent: [
                {
                    image: "/img/assets/home.jpg",
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
                    description: "Kucing ini tertidur pulas",
                    thumbnail: "/storage/kucing.jpeg"
                },
                {
                    id: 2,
                    title:
                        "Ngakak abieez Cyberbug 2077 berasa seperti Cyberpunk jaman perang!",
                    description: "duar duar",
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
