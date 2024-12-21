<template>
    <div class="sidebar">
        <div class="sidebar-header">
            <div class="sidebar__logo">
                <div class="logo__icon">
                    <img src="../../../assets/images/web-hosting.png" alt="logo">
                </div>
                <div class="logo__text">
                    <span>Web Hosting</span>
                </div>
            </div>
            <div class="links">
                <router-link :to="{ name: 'encode' }">Кодування</router-link>
                <router-link :to="{ name: 'decode' }">Декодування</router-link>
<!--                <router-link :to="{ name: 'statistics' }">Статистика</router-link>-->
            </div>
        </div>
        <div class="sidebar-footer">
            <div class="footer__text">
                <span>created by Kostiantyn Voskov</span>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "SideBar"
}
</script>

<style lang="scss" scoped>
    .sidebar {
        height: auto;
        background-color: #969CF4;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        padding: 33px 17px;
        width: 53px;
        z-index: 999;
        transition: width .2s linear, box-shadow .2s linear;

        .sidebar-header {
            height: 50px;
            white-space: nowrap;
            .sidebar__logo {
                display: flex;
                align-items: center;
                max-width: 100%;
                gap: 10px;
                overflow: hidden;

                .logo__icon {
                    img {
                        width: 50px;
                    }
                }

                .logo__text {
                    opacity: 0;
                    transition: opacity .2s linear;
                    span {
                        font-family: "Monomaniac One", serif;
                        font-weight: 400;
                        font-size: 28px;
                        color: #fff;
                    }
                }
            }

            .links {
                opacity: 0;
                display: flex;
                flex-direction: column;
                gap: 20px;
                font-family: Montserrat, sans-serif;
                font-weight: 500;
                font-size: 18px;
                margin-top: 100px;

                a {
                    color: #fff;
                    text-decoration: none;

                    &:hover {
                        text-decoration: underline;
                    }
                }

                .router-link-active {
                    color: #fff;
                    text-decoration: underline;
                }
            }
        }

        .sidebar-footer {
            opacity: 0;
            white-space: nowrap;
            .footer__text {
                span {
                    font-family: "Monomaniac One", serif;
                    font-weight: 400;
                    font-size: 16px;
                    color: #fff;
                    opacity: 0.5;
                }
            }
        }

        &:hover {
            box-shadow: 0 -5px 60px rgba(120, 140, 184, .2);
            width: 280px;

            .sidebar-header {
                .sidebar__logo {
                    .logo__text {
                        opacity: 1;
                    }
                }
            }

            .links {
                opacity: 1;
            }

            .sidebar-footer {
                opacity: 1;
            }
        }
    }
</style>
