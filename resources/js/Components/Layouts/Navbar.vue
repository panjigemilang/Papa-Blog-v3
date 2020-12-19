<template>
    <nav class="fixed h-screen">
        <ul class="flex flex-col">
            <li class="mb-4">
                <button class="w-full" type="button">
                    <div class="bg-red-600 rounded-full h-14 w-14 flex items-center justify-center">
                        <i class="text-white fas fa-sign-in-alt"></i>                    
                    </div>
                </button>
            </li>
            <li class="mb-4">
                <button class="w-full" type="button">
                    <i class="text-white fas fa-home fa-primary"></i>                    
                </button>
            </li>
        </ul>
    </nav>
</template>

<script>
export default {
    name: "Navigation"
};
</script>

<style lang="scss">
@import '../../../sass/variables.scss';

nav {
    background-color: $color-primary-dark;
    
    button:hover {
        box-shadow: none;
    }
}
</style>
