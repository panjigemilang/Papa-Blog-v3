import VueRouter from "vue-router";
import Home from "./Components/Pages/Home"
import Login from "./Components/Pages/Auth/Login"
import Dashboard from "./Components/Pages/Admin/Dashboard"

const title = "Papa Blog"

const routes = [
    {
      path: "/",
      component: Home,
      meta: {
        title: `${title} - Selamat Datang!`,
      },
    },
    {
      path: "/login",
      component: Login,
      meta: {
        title: `${title} - Login`,
      },
    },
    {
      path: "/admin",
      component: Dashboard,
      meta: {
        title: `${title} - Dashboard`,
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