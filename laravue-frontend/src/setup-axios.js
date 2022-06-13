import axios from 'axios'
import { backendUrl, userManagementUrl } from './config/env'

export const apiServer = axios.create({
  baseURL: backendUrl,
})

export const ssoServer = axios.create({
  baseURL: `${userManagementUrl}/api`,
})

export const axiosGlobalConfig = axios

export const fileUrl = backendUrl
