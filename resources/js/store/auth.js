import axios from 'axios'

export default {
  state: {
    user: null,
    profile: null,
    loading: true
  },
  actions: {
    async getProfile({ commit }) {
      commit('setLoading', true)
      axios.get(`/user/profile`).then(resp => {
        const { profile } = resp.data
        commit('setProfile', profile)
        commit('setLoading', false)
      })
    },
  },
  mutations: {
    setLoading(state, load){
      state.loading = load
    },
    setUser(state, user) {
      state.user = user
    },
    setProfile(state, profile) {
      state.profile = profile
    }
  }
}
