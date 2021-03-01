import axios from "axios"

const BASE_URL = "/api/tags/"

const namespaced = true

const state = {
  tags: {},  
  errors: {}
}

const mutations = {
  setTags: (state, data) => {
    state.tags = data
  }
}

const actions = {
  async getTags({ commit }, num = 5) {
    await axios
      .get(BASE_URL + num)
      .then(res => {
        console.log("Get Tags", res.data);
        commit('setTags', res.data)
      })
      .catch(err => {
        commit('posts/setErrors', err, { root: true })
      })
  }
}

export default {
  namespaced,
  state,
  mutations,
  actions
}