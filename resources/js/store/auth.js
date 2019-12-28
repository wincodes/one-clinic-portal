import axios from 'axios'

export default {
  state: {
    user: null,
    profile: null
  },
  actions: {
    async getProfile({commit}){
      axios.get(`/user/profile`)
        .then(resp => {
          const { profile } = resp.data
          commit('setProfile', profile)
        })
    }
  },
  mutations: {
    setUser(state, user) {
      state.user = user
    },
    setProfile(state, profile) {
      state.profile = profile
    }
  }
}
