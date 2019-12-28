export default {
  state: {
    message: null,
    type: null
  },
  actions: {
    
  },
  mutations: {
    setNotification(state, payload) {
      state.message = payload.message
      state.type = payload.type
    }
  }
}