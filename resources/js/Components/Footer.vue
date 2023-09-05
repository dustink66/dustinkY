<template>
    <footer id="footer" class="bg-white bg-opacity-50 dark:bg-zinc-900 dark:bg-opacity-50 backdrop-blur-sm backdrop-filter" :style="footerStyle">
        <div class="mx-auto max-w-7xl py-6 md:items-center md:justify-between px-4" :class="{'md:flex': icpNumber}">
            <div class="mt-8 md:order-1 md:mt-0">
                <p class="text-center text-xl leading-5 text-gray-700 dark:text-gray-200" >
                    <span class="antd icon-copyright-circle-fil text-xl"></span>
                    2020-2023
                    <span class="ZhiMangXing text-2xl hover:text-green-500 px-1">{{ appName }}</span>
                    {{ allRightsReserved }}
                </p>
            </div>
            <div v-if="icpNumber" class="mt-8 md:order-1 md:mt-0">
                <p class="text-center text-base leading-5 text-gray-700 dark:text-gray-200" >
                    <span class="antd icon-beian text-xl"></span>
                    <a href="https://beian.miit.gov.cn/" target="_blank" class="pl-3 text-xl hover:text-green-500">{{ icpNumber }}</a>
                </p>
            </div>
        </div>
    </footer>
</template>

<script>
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
