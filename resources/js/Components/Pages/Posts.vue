<template>
    <div>
        <Loading v-if="firstLoad" />
        <div class="container flex flex-col" v-else>
            <NavTags />
            <div class="min-h-screen" v-if="loading">
                <Loading />
            </div>
            <News
                :stripHtml="stripHtml"
                :shorten="shorten"
                :newsContent="posts.data.data"
                v-else
            />
            <div class="pagination flex flex-row flex-wrap justify-center mt-6">
                <router-link
                    :to="'/posts?page=' + (posts.data.current_page - 1)"
                >
                    <li
                        class="text-center cursor-pointer h-12 w-max mx-2 py-2 px-4 text-base list-none hover:text-gray-500 leading-8"
                        v-if="posts.data.current_page != 1"
                    >
                        <i class="fas fa-chevron-left"></i>
                    </li>
                </router-link>
                <router-link
                    v-for="(page, i) in pageNumber"
                    :key="'page-number-' + i"
                    :to="'/posts?page=' + page"
                >
                    <li
                        class="text-center cursor-pointer h-12 w-max mx-2 py-2 px-4 text-base rounded shadow-md list-none hover:bg-gray-100 leading-8"
                        :class="posts.data.current_page == page ? 'active' : ''"
                    >
                        {{ page }}
                    </li>
                </router-link>
                <router-link
                    :to="'/posts?page=' + (posts.data.current_page + 1)"
                >
                    <li
                        class="text-center cursor-pointer h-12 w-max mx-2 py-2 px-4 text-base list-none hover:text-gray-500 leading-8"
                        v-if="posts.data.current_page != posts.data.last_page"
                    >
                        <i class="fas fa-chevron-right"></i>
                    </li>
                </router-link>
            </div>
        </div>
    </div>
</template>

<script>
import NavTags from "../Partials/NavTags";
import News from "../Partials/News";
import Loading from "../Utils/Loading";
import { mapActions, mapState } from "vuex";

export default {
    name: "Posts_Lists",
    data() {
        return {
            limit: 3,
            pageNumber: [],
            firstLoad: false
        };
    },
    components: {
        NavTags,
        Loading,
        News
    },
    computed: {
        ...mapState("posts", ["loading", "posts"])
    },
    methods: {
        ...mapActions("posts", ["getPosts"]),
        shorten(str, maxLen, separator = " ") {
            if (str.length <= maxLen) return str;

            return str.substr(0, str.lastIndexOf(separator, maxLen));
        },
        stripHtml(content) {
            // Create a new div element
            let temp = document.createElement("div");
            // Set the HTML content with the providen
            temp.innerHTML = content;
            // Retrieve the text property of the element (cross-browser support)
            return temp.textContent || temp.innerText || "";
        },
        getPagingRange(current, { min = 1, total = 20, length = 5 } = {}) {
            if (length > total) length = total;

            let start = current - Math.floor(length / 2);
            start = Math.max(start, min);
            start = Math.min(start, min + total - length);

            return Array.from({ length: length }, (el, i) => start + i);
        },
        getTotalPage(total, limit) {
            let i = 0,
                temp = total,
                pageNumber = [];

            if (total < limit) {
                pageNumber.push(1);
            } else {
                while (temp >= limit) {
                    temp = temp - limit;
                    pageNumber.push(++i);
                }

                if (temp !== 0) {
                    const addOne = pageNumber[pageNumber.length - 1] + 1;
                    pageNumber.push(addOne);
                }
            }

            return pageNumber.length;
        }
    },
    created() {
        console.log("Route", this.$route);
        this.firstLoad = true;

        const page = this.$route.query.page ? this.$route.query.page : 0;
        let query;

        if (page) {
            query = `${this.limit}?page=${this.$route.query.page}`;
        } else {
            query = this.limit;
        }

        this.getPosts(query).then(() => {
            this.pageNumber = this.getPagingRange(
                parseInt(this.posts.data.current_page),
                {
                    total: this.getTotalPage(this.posts.data.total, this.limit),
                    length: this.limit
                }
            );

            this.firstLoad = false;
        });
    }
};
</script>

<style lang="scss" scoped>
@import "../../../sass/variables.scss";

li.active {
    background-color: $bg-primary;
    color: white;

    &:hover {
        opacity: 0.8;
    }
}
</style>
