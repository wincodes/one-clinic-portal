import Vuex from 'vuex'
import Vue from 'vue'
import auth from './auth'
import notification from './notification'
import general from './general'

Vue.use(Vuex)

export default new Vuex.Store({
  modules: {
    auth,
    notification,
    general
  }
})

