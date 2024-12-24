import axios from "axios";
import { API_URL } from "../../js/const/api";

const axiosInstance = axios.create({
    baseURL: API_URL,
    headers: {
        Accept: "application/json",
        "Content-Type": "application/json",
    },
});

export default axiosInstance;
