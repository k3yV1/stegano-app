<template>
    <div class="decode">
        <div class="decode__header">
            <div class="header__title">
                <div class="icon"></div>
                <span>Декодування</span>
            </div>
            <div class="header__line"></div>
        </div>
        <div class="decode__main">
            <div class="main__wrapper">
                <div class="wrapper__top">
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
                            <button>Декодувати</button>
                        </div>
                    </div>
                </div>
                <div class="wrapper__bottom">
                    <div class="title">
                        <span>Результат декодування</span>
                    </div>
                    <div class="table">
                        <div class="thead">
                            <div class="tr">
                                <div class="th">Назва файлу</div>
                                <div class="th">Повідомлення</div>
                                <div class="th">Статус</div>
                            </div>
                        </div>
                        <div class="tbody">
                            <div class="tr">
                                <div class="td">haskhdjkasdkjhaskjdhkashdjkasdjka</div>
                                <div class="td">hasjkhdjkashdjkaskjdhkjasdhkjashdkjhasjkdhjkas</div>
                                <div class="td">asjiudhasihdilashkjdhasjkdhjkasdhkjajkdajkd</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Decode",

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
.decode {
    padding-left: 57px;
    padding-right: 120px;
    padding-top: 63px;
    width: calc(100% - 53px);

    .decode__header {
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

    .decode__main {
        margin-top: 50px;
        .main__wrapper {
            display: flex;
            flex-direction: column;
            align-items: center;
            .wrapper__top {
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

            .wrapper__bottom {
                display: flex;
                flex-direction: column;
                align-items: center;
                width: 100%;
                margin-top: 50px;
                border-top: 1px solid rgba(224, 224, 224, 0.5);

                .title {
                    padding-top: 20px;
                    span {
                        font-family: Montserrat, sans-serif;
                        font-weight: 500;
                        font-size: 14px;
                        color: #000;
                    }
                }

                .table {
                    margin-top: 20px;
                    width: 800px;
                    border-radius: 5px;
                    border: 1px solid rgba(224, 224, 224, 0.5);
                    .thead {
                        .tr {
                            display: flex;
                            font-family: Montserrat, sans-serif;
                            font-weight: 500;
                            font-size: 12px;
                            color: #000;
                            border-bottom: 1px solid rgba(224, 224, 224, 0.5);
                            .th {
                                flex: 1;
                                border-right: 1px solid rgba(224, 224, 224, 0.5);
                                text-align: center;
                                padding: 5px 0;
                                &:last-child {
                                    border-right: none;
                                }
                            }
                        }
                    }

                    .tbody {
                        .tr {
                            display: flex;
                            font-family: Montserrat, sans-serif;
                            font-weight: 500;
                            font-size: 12px;
                            color: #000;
                            .td {
                                flex: 1;
                                border-right: 1px solid rgba(224, 224, 224, 0.5);
                                text-align: center;
                                padding: 10px 5px;
                                overflow-wrap: anywhere;
                                &:last-child {
                                    border-right: none;
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}
</style>
