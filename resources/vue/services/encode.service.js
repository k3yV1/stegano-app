import EncodeApi from "../office/encode.api";

class EncodeService {
    async createEncodeImageService(encodeData) {
        return await EncodeApi.createEncodeImage(encodeData);
    }
}

export default new EncodeService();
