<template>
    <div class="login-app mx-auto container min-h-screen">
        <div class="w-5/12 mx-auto pt-16">
            <div class="heading text-center mb-8">
                <h2 class="md:text-4xl font-bold">Login</h2>
            </div>
            <form
                class="card bg-white rounded-md px-6 py-10 md:w-8/12 mx-auto shadow-xl"
                @submit.prevent="onSubmit"
            >
                <div class="form-group">
                    <input
                        type="text"
                        name="email"
                        id="email"
                        class="w-full text-black"
                        required=""
                        v-model="email"
                    />
                    <label
                        class="control-label"
                        :class="email ? 'control-label-not-empty' : ''"
                        for="email"
                        >Email</label
                    >
                </div>
                <div class="form-group">
                    <input
                        type="password"
                        name="password"
                        id="password"
                        class="w-full text-black"
                        required=""
                        v-model="password"
                    />
                    <label
                        class="control-label"
                        :class="password ? 'control-label-not-empty' : ''"
                        for="password"
                        >Password</label
                    >
                </div>
                <div class="text-center">
                    <button
                        class="rounded-lg shadow-lg bg-blue-400 text-white w-2/6 focus:rounded-lg"
                    >
                        <i
                            class="fas fa-circle-notch fa-spin"
                            v-if="loading"
                        ></i>
                        Login
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import { mapState, mapActions } from "vuex";
import isEmpty from "../../Utils/isEmpty";

export default {
    name: "Login",
    data() {
        return {
            email: "",
            password: ""
        };
    },
    created() {
        if (localStorage.getItem("jwtToken")) {
            this.$router.push("/admin");
        }
    },
    computed: {
        ...mapState("services", ["loading", "errors"])
    },
    methods: {
        ...mapActions("services", ["login", "clearErrors"]),
        ...mapActions("general", ["toggleToast"]),
        onSubmit() {
            this.clearErrors();

            const formData = {
                email: this.email,
                password: this.password
            };

            this.login(formData).then(() => {
                // If no errors, login success and directing to next page
                if (isEmpty(this.errors)) {
                    this.$router.push("/admin");
                } else {
                    this.toggleToast();
                }
            });
        }
    }
};
</script>

<style lang="scss" scoped></style>
