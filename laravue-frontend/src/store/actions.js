// https://vuex.vuejs.org/en/actions.html

import { apiServer } from '../setup-axios'

export default {
  login ({ commit }, credentials) {
    console.log('credentials :', credentials)
    return apiServer
      .post('/user-management/login', {
        email: credentials.username,
        password: credentials.password,
      })
      .then(({ data }) => {
        commit('SET_USER_DATA', data)
      })
  },
  logout ({ commit }) {
    commit('LOGOUT')
  },
  setStatus (context, payload) {
    context.commit('SET_STATUS', payload)
  },

}
