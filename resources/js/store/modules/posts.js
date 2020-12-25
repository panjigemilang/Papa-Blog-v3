import axios from "axios"

const BASE_URL = "/api/posts"

const namespaced = true

const state = {  
  post: {},
  posts: {},
  loading: false,
  errors: {}
}

const mutations = {
  setPost: (state, data) => {
    state.post = data
  }, 
  setPosts: (state, data) => {
    state.posts = data
  }, 
  setLoading: (state) => {
    state.loading = !state.loading
  },
  setErrors: (state, data) => {
    state.errors = data
  }
}

const actions = {
  async addPost({ commit }, payload) {
    commit("setLoading")

    axios
    .post(BASE_URL + "/addPost", payload)
    .then(res => {
      console.log("Add Post Res : ", res);
    })
    .catch(err => {
      console.log("Err", err);
      commit("setErrors", err.response.data)
    })
  }
 }

 export default {
   namespaced,
   state,
   actions,
   mutations
 }