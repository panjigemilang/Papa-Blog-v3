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
        const items = [];
        const maxChar = 100;
        const concateText = " ...";

        this.galleryContent.map((item, i) =>
            items.push(`
                <div class="flex flex-col">
                    <p class="mb-6">Tag</p>
                    <h1 class="font-bold text-5xl mb-6">${item.title}</h1>
                    <p class="text-lg mb-6">${
                        item.content.length > maxChar
                            ? this.shorten(item.content, maxChar).concat(
                                  concateText
                              )
                            : item.content
                    }</p>
                </div>
            `)
        );

        return {
            items
        };
    },
    methods: {
        shorten(str, maxLen, separator) {
            if (str.length <= maxLen) return str;

            return str.substr(0, str.lastIndexOf(separator, maxLen));
        }
    }
};
</script>
