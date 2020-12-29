<template>
    <div
        class="transition-all duration-300 fixed transform -translate-x-2/4 left-1/2 p-4 min-w-min max-w-screen-sm bg-opacity-80 bg-red-600 rounded-lg"
        :class="
            toast
                ? 'visible bottom-8 opacity-100'
                : 'invisible -bottom-4 opacity-0'
        "
    >
        <div class="flex flex-row text-white">
            <h3 class="pr-2" v-if="!checkEmpty(errorsMessage)">
                {{ errorsMessage }}
            </h3>
            <h3 class="pr-2" v-else>
                Errors Message
            </h3>
            <div class="close cursor-pointer" @click.prevent="onToggleToast">
                <i class="fas fa-times"></i>
            </div>
        </div>
    </div>
</template>

<script>
import { mapActions, mapState } from "vuex";
import isEmpty from "./isEmpty";

export default {
    name: "Toast",
    computed: {
        ...mapState("services", ["errors"]),
        ...mapState("posts", {
            postsErrors: state => state.errors
        }),
        ...mapState("general", ["toast"]),
        errorsMessage() {
            let message = "";

            if (!this.checkEmpty(this.errors)) {
                message = this.errors.message;
            } else if (!this.checkEmpty(this.postsErrors)) {
                message = this.postsErrors.message;
            }

            return message;
        }
    },
    methods: {
        ...mapActions("general", ["toggleToast"]),
        onToggleToast() {
            this.toggleToast();
        },
        checkEmpty(val) {
            return isEmpty(val);
        }
    }
};
</script>

<style></style>
