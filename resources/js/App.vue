<template>
    <fragment>
        <Navbar />
        <div class="app min-h-screen ml-24">
            <router-view></router-view>
            <Footer />
        </div>
    </fragment>
</template>

<script>
import Navbar from "./Components/Layouts/Navbar"
import Footer from "./Components/Layouts/Footer"

export default {
    name: "App",
    components: {
        Navbar,
        Footer
    }
};
</script>

<style lang="scss">
@import '../sass/variables.scss';

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

  &:hover {
    box-shadow: 0 5px 11px 0 rgba(0, 0, 0, 0.18),
      0 4px 15px 0 rgba(0, 0, 0, 0.15);
  }

  &:focus {
    border: 1px solid rgba(123, 198, 183, 0.5);
    border-radius: 0;
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
</style>
