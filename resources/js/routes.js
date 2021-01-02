import VueRouter from "vue-router";
import Home from "./Components/Pages/Home"
import Post from "./Components/Pages/Post"
import Login from "./Components/Pages/Auth/Login"
import Dashboard from "./Components/Pages/Admin/Dashboard"
import AddPost from "./Components/Pages/Admin/AddPost"
import EditPost from "./Components/Pages/Admin/EditPost"

const title = "Papa Blog"

const privateRoute = (url, next) => {
  
  if (localStorage.jwtToken) next()
  else next(url)
}

const routes = [
    {
      path: "/",
      component: Home,
      meta: {
        title: `${title} - Selamat Datang!`,
      },
    },    
    {
      path: "/post/:title/:id",
      name: 'Post',
      component: Post,
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
      beforeEnter: (to, from, next) => {
        privateRoute('/', next)
      }
    },    
    {
      path: "/add",
      component: AddPost,
      meta: {
        title: `${title} - Add Post`,
      },
      beforeEnter: (to, from, next) => {
        privateRoute('/', next)
      }
    },
      {
        path: "/editPost/:id",
        name: 'editPost',
        component: EditPost,
        meta: {
          title: `${title} - Edit Post`
        },
        beforeEnter: (to, from, next) => {
          privateRoute('/', next)
        }
      }    
  ]

const router = new VueRouter({
    routes,
    mode: "history",
  })
  
  router.beforeEach((to, from, next) => {
    window.scrollTo(0, 0)
    document.title = to.meta.title
    
    if (to.params.title) {
      document.title = to.params.title.replace(/-/g, ' ')
    }

    next()
  })

  export default router