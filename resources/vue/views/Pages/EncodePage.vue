<template>
    <div class="encode">
        <div class="encode__header">
            <div class="header__title">
                <div class="icon"></div>
                <span>Кодування</span>
            </div>
            <div class="header__line"></div>
        </div>
        <div class="encode__main">
            <div class="main__wrapper">
                <div class="left-side">
                    <div class="form">
                        <div class="form-input">
                            <label for="uploadFile" class="file-box">Upload file</label>
                            <input type="file" id="uploadFile" class="uploadFile"  @change="previewImage" placeholder="Upload file" accept="image/*">
                        </div>
                        <div class="form-preview image-preview" v-if="imageData.length > 0">
                            <img class="preview" :src="imageData" alt="">
                        </div>
                        <div class="form-textarea">
                            <textarea placeholder="Введіть повідомлення"></textarea>
                        </div>
                        <div class="form__button">
                            <button>Кодувати</button>
                        </div>
                    </div>
                </div>
                <div class="right-side">
                    <div class="download-form">
                        <div class="picture">
<!--                            Тут в ответе будет картинка закодированная-->
<!--                            <img src="" alt="">-->
                        </div>
                        <div class="download-btn">
                            <button>Завантажити</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Encode",

    data() {
        return {
            imageData: "",
            fileName: "",
        };
    },

    methods: {
        previewImage(event) {
            const input = event.target;
            if (input.files && input.files[0]) {
                const file = input.files[0];
                this.fileName = file.name;

                const reader = new FileReader();
                reader.onload = (e) => {
                    this.imageData = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        },
    }
}
</script>

<style lang="scss" scoped>
.encode {
    padding-left: 57px;
    padding-right: 120px;
    padding-top: 63px;
    width: calc(100% - 53px);

    .encode__header {
        .header__title {
            display: flex;
            align-items: center;
            gap: 10px;
            .icon {
                width: 27px;
                height: 27px;
                border-radius: 8px;
                background-color: #969CF4;
            }

            span {
                font-family: Montserrat, sans-serif;
                font-size: 28px;
                font-weight: bold;
                color: #000;
            }
        }

        .header__line {
            margin-top: 13px;
            width: 100%;
            height: 1px;
            background-color: #000;
            opacity: 0.1;
        }
    }

    .encode__main {
        margin-top: 50px;
        .main__wrapper {
            display: flex;
            flex-direction: row;
            .left-side {
                flex: 1;
                .form {
                    display: flex;
                    flex-direction: column;
                    gap: 10px;
                    width: 300px;
                    .form-input {
                        .uploadFile {
                            display: none;
                        }

                        .file-box {
                            font-family: "Monomaniac One", serif;
                            font-weight: 400;
                            font-size: 16px;
                            display: flex;
                            width: 100%;
                            color: #000;
                            border: 1px solid rgba(224, 224, 224, 0.5);
                            border-radius: 5px;
                            padding: 10px;
                            box-sizing: border-box;
                            cursor: pointer; // Указываем, что элемент кликабелен
                            text-align: center;
                            background-color: #fff;
                            &:hover {
                                background-color: rgba(224, 224, 224, 0.1);
                            }
                        }
                    }

                    .image-preview {
                        img {
                            width: 100%;
                        }
                    }

                    .form-textarea {
                        display: flex;
                        textarea {
                            font-family: Montserrat, sans-serif;
                            font-weight: 400;
                            font-size: 14px;
                            outline: none;
                            padding: 5px;
                            width: 100%;
                            height: 105px;
                            border: 1px solid rgba(224, 224, 224, 0.5);
                            border-radius: 5px;

                            &::placeholder {
                                font-family: Montserrat, sans-serif;
                                font-weight: 400;
                                font-size: 12px;
                            }
                        }
                    }

                    .form__button {
                        display: flex;
                        margin-top: 40px;
                        button {
                            cursor: pointer;
                            font-family: Montserrat, sans-serif;
                            width: 100%;
                            height: 65px;
                            background-color: #969CF4;
                            color: #fff;
                            font-size: 14px;
                            font-weight: 500;
                            border-radius: 5px;
                            border: none;
                            transition: opacity .2s linear;

                            &:hover {
                                opacity: 0.7;
                            }
                        }
                    }
                }
            }

            .right-side {
                flex: 1;
                .download-form {
                    display: flex;
                    flex-direction: column;
                    gap: 20px;
                    .picture {
                        width: 100%;
                        height: 400px;
                        background-color: #4a5568;
                    }

                    .download-btn {
                        width: 300px;
                        margin: 0 auto;
                        button {
                            cursor: pointer;
                            font-family: Montserrat, sans-serif;
                            width: 100%;
                            height: 65px;
                            background-color: #969CF4;
                            color: #fff;
                            font-size: 14px;
                            font-weight: 500;
                            border-radius: 5px;
                            border: none;
                            transition: opacity .2s linear;

                            &:hover {
                                opacity: 0.7;
                            }
                        }
                    }
                }
            }
        }
    }
}
</style>
