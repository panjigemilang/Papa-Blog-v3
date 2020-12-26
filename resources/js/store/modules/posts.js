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

    await axios
      .post(BASE_URL + "/addPost", payload)
      .then(res => {
        console.log("Add Post Res : ", res);
      })
      .catch(err => {
        console.log("Err", err);
        commit("setErrors", err.response.data)
      })

    commit("setLoading")
    },
 async getAllPosts({ commit }) {
    commit("setLoading")

    await axios
      .get(BASE_URL + "/getAllPosts")
      .then(res => {
        console.log("Get Post Res : ", res);

        commit('setPosts', res.data);
      })
      .catch(err => {
        console.log("Err", err);
        commit("setErrors", err.response.data)
      })

    commit('setLoading')
    }

}

export default {
  namespaced,
  state,
  actions,
  mutations
}