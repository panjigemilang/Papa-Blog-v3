const namespaced = true

const state = {
  navbar: false,
  toast: false
}

const actions = {
  toggleNavbar({ commit, state }) {
    state.navbar = !state.navbar
  }, 
  toggleToast({ commit, state }) {
    state.toast = !state.toast
  }
}

export default {
  namespaced,
  state,
  actions
}