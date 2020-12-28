<template>
    <div class="card flex flex-row">
        <div class="md:w-4/12 px-4" v-for="(post, i) in posts" :key="i">
            <div class="rounded-lg shadow-2xl overflow-hidden">
                <router-link
                    :to="
                        'post/' +
                            post.title
                                .toLowerCase()
                                .replace(/\s|\+/g, '-')
                                .replace(/:|&\s|,|;|\./g, '') +
                            '/' +
                            post.id
                    "
                >
                    <img
                        src="http://via.placeholder.com/800x300.png"
                        alt="thumbnail"
                        class="w-full h-72 object-cover"
                    />
                </router-link>
                <div class="content pt-4 pb-6 px-8">
                    <div class="sub flex flex-row mb-4">
                        <img
                            src="img/assets/icons/ic_date_range_24px.svg"
                            class="icon mr-2"
                        />
                        <p>
                            {{ post.created_at }}
                        </p>
                        <div class="author ml-auto">
                            <i class="fas fa-user mr-2"></i>
                            Admin
                        </div>
                    </div>
                    <h1
                        class="text-3xl font-black mb-4 hover:text-blue-600 transition-colors"
                    >
                        <router-link
                            :to="
                                'post/' +
                                    post.title
                                        .toLowerCase()
                                        .replace(/ /g, '-') +
                                    '/' +
                                    post.id
                            "
                        >
                            {{ post.title }}
                        </router-link>
                    </h1>
                    <router-link
                        :to="
                            'post/' +
                                post.title
                                    .toLowerCase()
                                    .replace(/\s|\+/g, '-')
                                    .replace(/:|&\s|,|;|\./g, '') +
                                '/' +
                                post.id
                        "
                    >
                        <p
                            class="transition-colors text-blue-400 hover:text-blue-600"
                        >
                            Read More
                        </p>
                    </router-link>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "News_Card",
    data() {
        return {
            posts: [
                {
                    id: 1,
                    title: "yin yang, begitulah namanya terceritakan xixixi",
                    created_at: "20 DEC 2020"
                }
            ]
        };
    }
};
</script>

<style></style>
