<template>
    <div class="app min-h-screen">
        <Navbar />
        <div class="ml-22">
            <router-view></router-view>
            <Toast />
            <Footer />
        </div>
    </div>
</template>

<script>
import Navbar from "./Components/Layouts/Navbar";
import Footer from "./Components/Layouts/Footer";
import Toast from "./Components/Utils/Toast";
import setAuthToken from "./Components/Utils/setAuthToken";
import { mapActions } from "vuex";
import jwt_decode from "jwt-decode";
import axios from "axios";

export default {
    name: "App",
    components: {
        Navbar,
        Footer,
        Toast
    },
    methods: {
        ...mapActions("services", ["logout", "setCurrentUser", "getUser"])
    },
    created() {
        if (localStorage.jwtToken) {
            // set token for authorization
            setAuthToken(localStorage.jwtToken);
            // decode token
            const decoded = jwt_decode(localStorage.jwtToken);
            // set current user and isAuthenticated
            this.getUser().then(() => {
                // check for expired token
                const currentTime = Date.now() / 1000;

                if (decoded.exp < currentTime) {
                    // logout user
                    this.logout();
                    // redirect to login
                    this.$router.push("/login");
                }
            });
        }
    }
};
</script>

<style lang="scss">
@import "../sass/variables.scss";

@font-face {
    font-family: "Product Sans";
    src: url("../fonts/Product-Sans-Regular.ttf") format("truetype");
    font-weight: 300;
}

html,
body {
    height: 100%;
    position: relative;
    width: 100%;
}

body {
    background-color: var($bg-primary);
    color: var($text-primary);
    font-size: 92.5% !important;
    font-family: "Product Sans";
    margin: 0;
    padding: 0;
}

body.overflow {
    overflow-x: hidden;
}

body::-webkit-scrollbar {
    width: 0.25rem;
}

body::-webkit-scrollbar-track {
    background: var($text-secondary);
}

body::-webkit-scrollbar-thumb {
    background: #e63946;
}

#app {
    overflow-x: hidden;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}

button {
    border: none;
    cursor: pointer;
    padding: 15px;
    transition: 0.3s ease-in-out;

    &:hover {
        box-shadow: 0 5px 11px 0 rgba(0, 0, 0, 0.18),
            0 4px 15px 0 rgba(0, 0, 0, 0.15);
    }

    &:focus {
        border: 1px solid rgba(123, 198, 183, 0.5);
        border-radius: inherit;
        outline: none;
    }
}

.btn-box {
    text-align: center;
}

h1.title {
    font-size: 2.5em;
    font-weight: bolder;
}

#router-link {
    display: inline-block;
}

.ml-22 {
    margin-left: 5.3rem;
}

label {
    color: rgba($color: $text-muted, $alpha: 0.8);
}

span.required {
    color: $required;
}

label.control-label {
    cursor: text;
    font-size: $font-sm;
    position: absolute;
    top: 0;
    left: 0;
    transition: 0.3s ease-in-out;
    z-index: 0;
}

input:focus {
    border-color: rgba($color: $color-secondary, $alpha: 0.8) !important;
    outline: none;
}

input:not([type="date"]) {
    background-color: transparent;
    border: none;
    border-bottom: 2px rgba($color: $text-muted, $alpha: 0.7) solid;

    &:focus + .control-label {
        pointer-events: none;
        top: -18px;
        left: 2px;
        font-size: $font-size-base;
    }
}

.control-label-not-empty {
    pointer-events: none !important;
    top: -18px !important;
    left: 2px !important;
    font-size: $font-size-base !important;
}

.form-control {
    background-clip: padding-box;
    background-color: #fff;
    border: 1px solid #ced4da;
    border-radius: 0.25rem;
    color: #495057;
    display: block;
    font-size: 1rem;
    line-height: 1.5;
    padding: 0.375rem 0.75rem;
    transition: border-color 0.15s ease-in-out;
    width: 100%;

    &:focus {
        background-color: #fff;
        border-color: #80bdff;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        color: #495057;
        outline: 0;
    }
}

.form-group {
    margin-bottom: 1.67rem;
    margin-left: auto;
    margin-right: auto;
    max-width: 90%;
    position: relative;
}
</style>
