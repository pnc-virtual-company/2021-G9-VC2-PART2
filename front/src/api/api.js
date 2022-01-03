// import axios from "axios";

// export default axios.create({
//   baseURL: process.env.VUE_APP_API_URL,
//   headers: {
//     "Content-type": "application/json"
//   }
// });

import axios from "axios";

const axiosApi = axios.create({
baseURL: process.env.VUE_APP_API_URL,
headers: {
"Content-type": "application/json",
},
});

// Set the AUTH token for any request
axiosApi.interceptors.request.use(function (config) {
const token = localStorage.getItem("token");
config.headers.Authorization = token ? `Bearer ${token}` : "";
return config;
});

export default axiosApi;