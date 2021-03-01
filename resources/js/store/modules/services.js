import axios from "axios"
import setAuthToken from "../../Components/Utils/setAuthToken"
import isEmpty from "../../Components/Utils/isEmpty"

const BASE_URL = "/api/users"

const namespaced = true

const state = {
  errors: {},
  isAuthenticated: false,
  loading: false,
  user: {}
}

const mutations = {
  setErrors: (state, data) => {
    state.errors = data
  },
  setIsAuthenticated: (state, data) => {
    state.isAuthenticated = data
  },
  setLoading: (state, data) => {
    state.loading = data
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
      .post(BASE_URL + "/login", payload)
      .then((res) => {
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
        commit("setErrors", err.response.data)
      })

    state.loading = false
  },
  async getUser({ commit }) {
    state.loading = true

    await axios
      .get(BASE_URL)
      .then(res => {
        console.log("Get User", res);
        commit("setUser", res.data.user)
      })
      .catch(err => {
        commit("setErrors", err.response.data)
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
    commit("setErrors", {})
  },
}

export default {
  namespaced,
  state,
  actions,
  mutations,
}
