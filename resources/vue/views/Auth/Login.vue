<template>
    <div class="login">
        <div class="login__wrapper">
            <div class="login__left-side">
                <div class="left-side__top">
                    <div class="left-side__app-title">
                        <span>Web Hosting</span>
                    </div>
                    <div class="left-side__app-description">
                        <span>Цифровий веб-хостінг картинок</span>
                    </div>
                </div>
                <div class="left-side__bottom">
                    <div class="left-side__author">
                        <span>created by Kostiantyn Voskov</span>
                    </div>
                </div>
            </div>
            <div class="login__right-side">
                <div class="right-side__content">
                    <div class="content__title">
                        <span>Вхід в систему</span>
                    </div>
                    <div class="content__form">
                        <div class="form__fields">
                            <div class="form__input">
                                <input type="text" placeholder="example@gmai.com">
                            </div>
                            <div class="form__input">
                                <input type="text" placeholder="Введіть пароль">
                            </div>
                        </div>
                        <div class="form__registry">
                            <span>Ви ще не зареєстровані?</span>
                            <span class="registry" @click="goToRegistry">Реєстрація</span>
                        </div>
                        <div class="form__button">
                            <button>Вхід</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Login",

    data() {
        return {

        }
    },

    methods: {
        goToRegistry() {
            this.$router.push({
                name: 'registry'
            })
        }
    }
}
</script>

<style lang="scss" scoped>
    .login {
        width: 100%;
        height: 100%;

        .login__wrapper {
            display: flex;
            flex-direction: row;
            height: 100%;

            .login__left-side {
                width: 50%;
                display: flex;
                flex-direction: column;
                justify-content: space-between;
                background-color: #969CF4;
                background-image: url('../../../assets/images/web-hosting-bg.png');
                background-repeat: no-repeat;
                background-position: center;
                padding: 10px 15px;

                .left-side__top {
                    .left-side__app-title {
                        span {
                            font-family: "Monomaniac One", serif;
                            font-weight: 400;
                            font-size: 22px;
                            color: #fff;
                        }
                    }

                    .left-side__app-description {
                        span {
                            font-family: "Monomaniac One", serif;
                            font-weight: 400;
                            font-size: 16px;
                            color: #fff;
                        }
                    }
                }

                .left-side__bottom {
                    .left-side__author {
                        display: flex;
                        align-items: center;
                        justify-content: center;

                        span {
                            font-family: "Monomaniac One", serif;
                            font-weight: 400;
                            font-size: 16px;
                            color: #fff;
                            opacity: 0.5;
                        }
                    }
                }
            }

            .login__right-side {
                flex: 1;
                padding: 49px 100px 43px;

                .right-side__content {
                    display: flex;
                    margin-top: 78px;
                    flex-direction: column;
                    gap: 28px;

                    .content__title {
                        span {
                            font-family: Montserrat, sans-serif;
                            font-size: 28px;
                            font-weight: bold;
                            color: #000;
                        }
                    }

                    .content__form {
                        width: 300px;
                        display: flex;
                        flex-direction: column;

                        .form__fields {
                            display: flex;
                            flex-direction: column;
                            gap: 15px;
                            .form__input {
                                display: flex;
                                width: 100%;
                                input[type="text"] {
                                    font-family: Montserrat, sans-serif;
                                    color: #000;
                                    font-size: 14px;
                                    font-weight: 500;
                                    width: 100%;
                                    height: 65px;
                                    border-radius: 5px;
                                    border: 1px solid #D9D9D9;
                                    padding-left: 20px;

                                    &::placeholder {
                                        font-family: Montserrat, sans-serif;
                                        font-size: 14px;
                                        font-weight: 400;
                                        color: #000;
                                        opacity: 0.3;
                                    }

                                    &:focus {
                                        outline: none !important;
                                        border: 1px solid #969CF4;
                                    }
                                }
                            }
                        }

                        .form__registry {
                            display: flex;
                            gap: 5px;
                            margin-top: 10px;

                            span {
                                font-family: Montserrat, sans-serif;
                                font-size: 12px;
                                font-weight: 500;
                                color: #000;
                            }

                            .registry {
                                cursor: pointer;
                                color: #969CF4;
                                font-weight: 500;
                                transition: opacity .2s linear;
                                &:hover {
                                    text-decoration: underline;
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
            }
        }
    }
</style>
