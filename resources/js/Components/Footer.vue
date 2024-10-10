<template>
    <footer id="footer" class="bg-white bg-opacity-50 dark:bg-zinc-900 dark:bg-opacity-50 backdrop-blur-sm backdrop-filter" :style="footerStyle">
        <div class="mx-auto max-w-7xl py-6 md:items-center md:justify-between px-4" :class="{'md:flex': icpNumber}">
            <div class="mt-8 md:order-1 md:mt-0">
                <div class="flex text-center text-xl leading-8 text-gray-700 dark:text-gray-200" >
                    <span class="antd icon-copyright-circle-fil text-xl pr-2 leading-8"></span>
                    2020-2024
                    <span class="ZhiMangXing text-2xl hover:text-green-500 px-1">{{ appName }}</span>
                    <p class="flex" v-html="allRightsReserved"></p>
                    <p class="hidden sm:flex">，由 <a href="https://www.upyun.com/?utm_source=lianmeng&utm_medium=referral" target="_blank" class="hover:text-green-500"><img src="https://help.upyun.com/wp-content/uploads/2018/08/logo.png" class="h-8 px-1"></a> 提供CDN服务</p>
                </div>

            </div>
            <div v-if="icpNumber" class="mt-8 md:order-1 md:mt-0">
                <p class="text-center text-base leading-8 text-gray-700 dark:text-gray-200" >
                    <span class="antd icon-beian text-xl"></span>
                    <a href="https://beian.miit.gov.cn/" target="_blank" class="pl-3 text-xl hover:text-green-500">{{ icpNumber }}</a>
                </p>
            </div>
        </div>
    </footer>
</template>

<script>
import SvgLogo from './SvgLogo.vue';
export default {
    name: 'Footer',
    props: {
        appName: {
            type: String,
            required: true
        },
        icpNumber: {
            type: String,
            required: true
        },
        allRightsReserved: {
            type: String,
            required: true
        }
    },
    data() {
        return {
            footerStyle: {}
        };
    },
    mounted() {
        this.handleFooterPosition(); // Initial positioning of the footer
        window.addEventListener('resize', this.handleFooterPosition); // Update positioning on window resize
    },
    beforeDestroy() {
        window.removeEventListener('resize', this.handleFooterPosition);
    },
    methods: {
        handleFooterPosition() {
            const bodyHeight = document.body.scrollHeight;
            const windowHeight = window.innerHeight;

            // Check if the content is not filling the page height
            if (bodyHeight < windowHeight) {
                this.footerStyle = {
                    position: 'fixed',
                    bottom: '0'
                };
            } else {
                this.footerStyle = {
                    position: 'relative',
                    bottom: 'auto'
                };
            }
        }
    }
}
</script>

<style>
/* Add the following CSS styles to the existing styles for the Footer component */

/* The footer will stick to the bottom when the content is not enough */
#footer {
    width: 100%;
    margin-top: auto;
}
</style>
