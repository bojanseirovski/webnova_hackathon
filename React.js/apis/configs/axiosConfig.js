import axios from "axios";

export const userName = "testuser123";
export const apiKey = "Pf4y860leVsTLUWY5V7xFWK3sWznyj4N";

export const api = axios.create({
    withCredentials: false,
    baseURL: "http://45.33.41.62",
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