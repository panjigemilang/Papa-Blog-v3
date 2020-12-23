<template>
    <div class="featured grid md:grid-cols-12 md:grid-rows-2 mb-8">
        <a
            href="#"
            class="relative border-1 border-gray-500 overflow-hidden"
            v-for="(gallery, index) in galleryContent"
            :key="index"
            :class="
                index == 0
                    ? 'main col-span-6 row-span-2'
                    : 'col-span-3 row-span-1'
            "
        >
            <img
                :src="gallery.image"
                alt="Featured"
                class="object-cover w-full h-full"
                :class="index == galleryContent.length - 1 ? 'object-top' : ''"
            />
            <div
                class="img-overlay absolute w-full h-full top-0 opacity-60"
            ></div>
            <p
                class="absolute bottom-0 left-0 tracking-wider"
                :class="index == 0 ? 'py-5 px-8 text-2xl' : 'py-4 px-5'"
            >
                <strong>{{ gallery.title }}</strong>
            </p>
        </a>
    </div>
</template>

<script>
export default {
    name: "Featured News",
    props: {
        galleryContent: Array
    }
};
</script>

<style scoped>
.featured {
    max-height: 500px;
}

.img-overlay {
    background: rgb(61, 164, 249);
    background: linear-gradient(
        180deg,
        rgba(61, 164, 249, 0) 0%,
        rgba(0, 0, 0, 1) 100%
    );
}

.border-1 {
    border-width: 1px;
}
</style>
