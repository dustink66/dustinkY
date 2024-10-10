<template>
    <div v-if="theme === 'dark'" class="w-12 h-12 rounded-full bg-gradient-to-tr from-transparent to-blue-950 flex justify-center items-center" @click="lightMode">
        <SunnyNight class="scale-175 transform hover:scale-225 transition duration-300" />
    </div>
    <div v-else class="w-12 h-12 rounded-full bg-gradient-to-tr from-transparent to-sky-600 flex justify-center items-center" @click="darkMode">
        <SunnyDay class="scale-150 transform hover:scale-200 transition duration-300"/>
    </div>


</template>


<script>
import SunnyDay from "./Weather/Icon/SunnyDay.vue";
import SunnyNight from "./Weather/Icon/SunnyNight.vue";
export default {
    components: {
        SunnyDay,SunnyNight
    },
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
