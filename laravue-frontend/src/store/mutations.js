// https://vuex.vuejs.org/en/mutations.html

import { apiServer } from '../setup-axios'
import router from '../router';

export default {
  SET_USER_DATA (state, userData) {
    state.user = userData
    localStorage.setItem('user', JSON.stringify(userData))
    apiServer.defaults.headers.common.Authorization = `Bearer ${
      userData.token
      }`
  },
  LOGOUT () {
    localStorage.removeItem('user')
    router.push('/logout')
  },
  SET_STATUS (state, payload) {
    state.status.snackbarColor = payload.snackbarColor
    state.status.snackbarText = payload.snackbarText
  },
}
