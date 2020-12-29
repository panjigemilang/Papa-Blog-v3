<template>
    <fragment>
        <div class="banner-image relative overflow-hidden w-full">
            <img
                src="/img/cover/default.jpg"
                alt="Banner"
                class="object-cover w-full h-full"
            />
            <div class="overlay"></div>
            <h1
                class="font-black md:text-5xl absolute top-1/2 transform -translate-y-1/2 w-7/12 py-8 pl-16 tracking-wider text-white"
            >
                Yin-yang, kekuatan dari dalam yang selalu di cari manusia sejak
                dahulu kala
            </h1>
        </div>
        <div class="content container flex flex-row">
            <div class="md:w-7/12 p-8">
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                    Aliquam consectetur interdum ante quis rhoncus. Duis
                    consectetur metus sem, ac cursus elit congue a. Sed ac
                    tempor lorem. Donec est lacus, suscipit sed volutpat nec,
                    semper id dui. Quisque vitae sem vitae tellus euismod
                    pretium non vel libero. Sed vehicula ultrices nunc, vitae
                    lacinia arcu sodales et. Morbi rhoncus dolor gravida enim
                    ornare ultrices id sed diam. Nullam sit amet dictum metus.
                    Curabitur mollis dolor ut ligula laoreet fringilla. Nam id
                    leo eget augue interdum maximus. Etiam luctus erat ex, at
                    vestibulum nunc pretium sed. Ut lobortis leo eu nisl
                    suscipit viverra. Vestibulum ante ipsum primis in faucibus
                    orci luctus et ultrices posuere cubilia curae; Morbi a
                    facilisis quam, sed tincidunt ligula. Pellentesque maximus
                    venenatis porttitor. Praesent at tortor in nunc lobortis
                    commodo. Nullam scelerisque porttitor orci, sit amet aliquam
                    orci fermentum non. Praesent sed quam ultrices, sollicitudin
                    mauris at, lobortis lorem. Integer ultricies non ante id
                    condimentum. Aliquam nec feugiat purus.
                </p>
                <img src="/img/assets/home.jpg" alt="test" />
                <p>
                    Ut lobortis leo eu nisl suscipit viverra. Vestibulum ante
                    ipsum primis in faucibus orci luctus et ultrices posuere
                    cubilia curae; Morbi a facilisis quam, sed tincidunt ligula.
                    Pellentesque maximus venenatis porttitor. Praesent at tortor
                    in nunc lobortis commodo. Nullam scelerisque porttitor orci,
                    sit amet aliquam orci fermentum non. Praesent sed quam
                    ultrices, sollicitudin mauris at, lobortis lorem. Integer
                    ultricies non ante id condimentum. Aliquam nec feugiat
                    purus. Lorem ipsum dolor sit amet, consectetur adipiscing
                    elit. Aliquam consectetur interdum ante quis rhoncus. Duis
                    consectetur metus sem, ac cursus elit congue a. Sed ac
                    tempor lorem. Donec est lacus, suscipit sed volutpat nec,
                    semper id dui. Quisque vitae sem vitae tellus euismod
                    pretium non vel libero. Sed vehicula ultrices nunc, vitae
                    lacinia arcu sodales et. Morbi rhoncus dolor gravida enim
                    ornare ultrices id sed diam. Nullam sit amet dictum metus.
                    Curabitur mollis dolor ut ligula laoreet fringilla. Nam id
                    leo eget augue interdum maximus. Etiam luctus erat ex, at
                    vestibulum nunc pretium sed.
                </p>
                <br />
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                    Aliquam consectetur interdum ante quis rhoncus. Duis
                    consectetur metus sem, ac cursus elit congue a. Sed ac
                    tempor lorem. Donec est lacus, suscipit sed volutpat nec,
                    semper id dui. Quisque vitae sem vitae tellus euismod
                    pretium non vel libero. Sed vehicula ultrices nunc, vitae
                    lacinia arcu sodales et. Morbi rhoncus dolor gravida enim
                    ornare ultrices id sed diam. Nullam sit amet dictum metus.
                    Curabitur mollis dolor ut ligula laoreet fringilla. Nam id
                    leo eget augue interdum maximus. Etiam luctus erat ex, at
                    vestibulum nunc pretium sed. Ut lobortis leo eu nisl
                    suscipit viverra. Vestibulum ante ipsum primis in faucibus
                    orci luctus et ultrices posuere cubilia curae; Morbi a
                    facilisis quam, sed tincidunt ligula. Pellentesque maximus
                    venenatis porttitor. Praesent at tortor in nunc lobortis
                    commodo. Nullam scelerisque porttitor orci, sit amet aliquam
                    orci fermentum non. Praesent sed quam ultrices, sollicitudin
                    mauris at, lobortis lorem. Integer ultricies non ante id
                    condimentum. Aliquam nec feugiat purus.
                </p>
            </div>
            <div class="relative md:w-5/12">
                <Trending />
            </div>
        </div>
    </fragment>
</template>

<script>
import Trending from "../Partials/Trending";
import { Fragment } from "vue-fragment";

export default {
    name: "Post_Detail",
    components: {
        Trending,
        Fragment
    }
};
</script>

<style lang="scss" scoped>
.banner-image {
    height: 60vh;
}
</style>
