<template>
    <div class="featured min-h-screen mb-8">
        <div class="min-h-screen flex flex-row relative">
            <carousel
                class="md:w-6/12 md:pl-40 md:pt-32"
                :autoplay="true"
                :data="items"
                :controls="false"
            ></carousel>
            <div class="cover-image md:w-6/12 relative">
                <img
                    src="img/assets/home.jpg"
                    class="absolute transform -translate-y-2/4 -right-40 top-1/2"
                />
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Featured-News",
    props: {
        galleryContent: Array
    },
    data() {
        return {
            items: [
                `
                <div class="flex flex-col">
                    <p class="mb-6">Tag</p>
                    <h1 class="font-bold text-5xl mb-6">
                        Title: Nehru Priyambodo suka memasang behel Lesti
                    </h1>
                    <p class="text-lg mb-6">
                        Sangat disayangkan padahal masih muda
                    </p>
                </div>
                `,
                `<div class="flex flex-col">
                    <p class="mb-6">Tag</p>
                    <h1 class="font-bold text-5xl mb-6">
                        Title: Panji Gemilang
                    </h1>
                    <p class="text-lg mb-6">
                        Ngakak abieez
                    </p>
                </div>`
            ]
        };
    }
    // computed: {
    //     carouselData() {
    //         const data = []
    //         let temp

    //         this.galleryContent.map(item => {
    //             temp.push(`
    //                 <div
    //             `)
    //         })
    //     }
    // }
};
</script>

<style lang="scss" scoped>
.carousel button.carousel__control--prev {
    left: 11rem !important;
}

.carousel .carousel__indicator::before {
    background-color: black !important;
}
</style>
