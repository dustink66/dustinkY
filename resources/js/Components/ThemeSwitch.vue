<template>
<!--    <div class="w-9 h-9 rounded-full bg-gradient-to-b from-gray-100 to-gray-50 flex justify-center items-center" @click="lightMode">-->
<!--        <span class="text-3xl text-yellow-400 antd icon-sun" style="text-shadow: rgb(234, 179, 8) 5px -5px 1em, rgb(234, 179, 8) 0px 0px 1em;"></span>-->
<!--    </div>-->

    <div v-if="theme === 'dark'" class="w-9 h-9 rounded-full bg-gradient-to-tr from-transparent to-gray-800 flex justify-center items-center " @click="lightMode">
        <button class="text-xl text-white antd icon-sun transform hover:scale-125 transition duration-300" style="text-shadow: rgb(234, 179, 8) 0px 0px 0.8em, rgb(234, 179, 8) 0px 0px 0.8em;"></button>
    </div>
    <div v-else class="w-9 h-9 rounded-full bg-gradient-to-b from-blue-900 to-blue-500 flex justify-center items-center" @click="darkMode">
        <button class="text-xl text-yellow-400 text-shadow antd icon-moon transform hover:scale-125 transition duration-300" style="text-shadow: rgb(234, 179, 8) 5px -5px 1em, rgb(234, 179, 8) 0px 0px 0.8em;"></button>
    </div>



</template>


<script>
export default {
    components: {},
    data() {
        return {
            theme: 'light',
        };
    },
    methods: {
        darkMode() {
            document.documentElement.classList.add('dark')
            localStorage.setItem('theme', 'dark')
            this.theme = 'dark';
        },
        lightMode() {
            document.documentElement.classList.remove('dark')
            localStorage.setItem('theme', 'light')
            this.theme = 'light';
        },
    },
    mounted() {
        if (!('theme' in localStorage)) {
            const isDarkTheme = window.matchMedia("(prefers-color-scheme: dark)");
            if (isDarkTheme.matches) {
                document.documentElement.classList.add('dark')
                this.theme = 'dark';
            } else {
                document.documentElement.classList.remove('dark')
                this.theme = 'light';
            }
        } else {
            if (localStorage.getItem('theme') === 'dark') {
                document.documentElement.classList.add('dark')
                this.theme = 'dark';
            } else {
                document.documentElement.classList.remove('dark')
                this.theme = 'light';
            }
        }
    },
};
</script>
