import axios from "axios";

export const userName = "";
export const apiKey = "";

export const api = axios.create({
    withCredentials: false,
    baseURL: "",
});

const errorHandler = (error) => {
    const statusCode = error.response?.status
    if (statusCode && statusCode !== 401) {
        console.error(error)
    }
    return Promise.reject(error)
}

api.interceptors.response.use(undefined, (error) => {
    return errorHandler(error)
});