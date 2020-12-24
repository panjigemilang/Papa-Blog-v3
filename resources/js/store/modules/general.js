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
    const temp = !state.toast        
    state.toast = !state.toast        

    if (temp == true) {
      setTimeout(() => {
        state.toast = false
      }, 3000);
    }
  }
}

export default {
  namespaced,
  state,
  actions
}