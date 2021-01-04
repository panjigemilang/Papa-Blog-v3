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
                    class="absolute transform -translate-y-2/4 -right-40 top-80"
                />
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Featured-News",
    props: {
        galleryContent: Array,
        shorten: Function,
        stripHtml: Function
    },
    data() {
        const items = [];
        const maxChar = 100;
        const concateText = " ...";

        this.galleryContent.map((item, i) =>
            items.push(`
                <div class="flex flex-col">
                    <p class="mb-6 text-lg font-light">${
                        item.tags.length > 0 ? "#" + item.tags[0].tags : ""
                    }</p>
                    <h1 class="font-bold text-5xl mb-6">
                        <router-link
                            class="transition-all duration-300 title"
                            to="/post/${item.title
                                .toLowerCase()
                                .replace(/\s|\+/g, "-")
                                .replace(/:|&\s|,|;|\./g, "")}/${item.id}"
                        >
                            ${item.title}
                        </router-link>
                    </h1>
                    <p class="text-lg mb-6">${
                        item.content.length > maxChar
                            ? this.shorten(
                                  this.stripHtml(item.content),
                                  maxChar
                              ).concat(concateText)
                            : this.stripHtml(item.content)
                    }</p>
                </div>
            `)
        );

        return {
            items
        };
    }
};
</script>
