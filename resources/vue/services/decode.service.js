import EncodeApi from "../office/encode.api";

class DecodeService {
    async getDecodeImageService(decodeData) {
        return await EncodeApi.getDecodeImage(decodeData);
    }
}

export default new DecodeService();
