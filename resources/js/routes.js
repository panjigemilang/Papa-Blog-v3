import VueRouter from "vue-router";
import Home from "./Components/Pages/Home"

const title = "Papa Blog"

const routes = [
    {
      path: "/",
      component: Home,
      meta: {
        title: `${title} - Login`,
      },
    },
  ]

const router = new VueRouter({
    routes,
    mode: "history",
  })
  
  router.beforeEach((to, from, next) => {
    window.scrollTo(0, 0)
    document.title = to.meta.title
    next()
  })

  export default router