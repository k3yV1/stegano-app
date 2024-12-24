import axiosInstance from "../services/axios.service";
class EncodeApi {
    async createEncodeImage(encodeData) {
        return (
            await axiosInstance.post(`encode-image`, {
                encodeData: encodeData
            })
        ).data
    }

    async getDecodeImage(decodeData) {
        return (
            await axiosInstance.post(`decode-image`, {
                decodeData: decodeData
            })
        ).data
    }
}

export default new EncodeApi();
