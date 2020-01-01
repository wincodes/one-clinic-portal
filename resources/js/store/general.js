import axios from 'axios'

export default {
  state: {
    countries: null
  },
  actions: {
    async getCountries({ commit }) {
      axios.get(`/countries`).then(resp => {
        // const { countries } = resp.data
        commit('setCountries', resp.data)
      })
    }
  },
  mutations: {
    setCountries(state, countries) {
      state.countries = countries[0]
    }
  }
}
