import axios from "axios"
import setAuthToken from "../../Components/Utils/setAuthToken"
import isEmpty from "../../Components/Utils/isEmpty"

const post_url = "/api/posts"
const user_url = "/api/users"

const namespaced = true

const state = {
  errors: {},
  isAuthenticated: false,
  loading: false,
  post: {},
  posts: {},
  user: {}
}

const mutations = {
  setError: (state, data) => {
    state.errors = data
  },
  setIsAuthenticated: (state, data) => {
    state.isAuthenticated = data
  },
  setLoading: (state, data) => {
    state.loading = data
  },
  setPost: (state, postData) => {
    state.post = postData
  },
  setPosts: (state, postData) => {
    state.posts = postData
  },
  setUser: (state, userData) => {
    state.isAuthenticated = !isEmpty(userData)
    state.user = userData
  },
}

const actions = {
  async login({ commit, dispatch, state }, payload) {
    state.loading = true

    await axios
      .post(user_url + "/login", payload)
      .then((res) => {
        console.log("RES", res);
        const { token } = res.data

        // set token to local storage
        localStorage.setItem("jwtToken", token)
        // Set token to Auth Header
        setAuthToken(token)
        // set current user
        dispatch('getUser')
      })
      .catch((err) => {
        console.log("ERR", err);
        commit("setError", err.response.data)
      })

    state.loading = false
  },
  async getUser({ commit }) {
    state.loading = true

    await axios
      .get(user_url)
      .then(res => {
        console.log("Get User", res);
        commit("setUser", res.data.user)
      })
      .catch(err => {
        commit("setError", err.response.data)
      })

    state.loading = false
  },
  logout({ commit }) {
    // Remove token from local storage
    localStorage.removeItem("jwtToken")
    // Remove authorization token
    setAuthToken(false)
    commit("setUser", {})
  },
  setCurrentUser({ commit }, payload) {
    commit("setUser", payload)
  },
  clearErrors({ commit }) {
    commit("setError", {})
  },
}

export default {
  namespaced,
  state,
  actions,
  mutations,
}
