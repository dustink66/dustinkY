<template>
    <div class="bg-white bg-opacity-50 dark:bg-opacity-70 rounded-2xl hover:shadow-2xl dark:hover:shadow-2xl dark:hover:shadow-gray-400 backdrop-blur-sm backdrop-filter overflow-hidden rounded-lg shadow-lg dark:bg-zinc-900 dark:text-gray-100">
        <div class="flex items-end justify-end h-32 p-4 dark:bg-gray-500 bg-center bg-cover" style="background-image: url(/storage/images/8768d8d7897ebe1da3c53f9e997b32d1.jpeg);">
            <p class="px-4 py-2 text-base tracki bg-gray-200 dark:text-gray-100 uppercase dark:bg-gray-800 bg-opacity-75 rounded shadow-lg">{{ weather.city }} {{ weather.win }} {{ weather.win_speed }} {{ weather.win_meter }}</p>
        </div>
        <div class="flex justify-between p-4">
            <div class="flex flex-col flex-1 gap-4">
                <div class="flex justify-between">
                    <div class="flex gap-2">
                        <span class="text-5xl font-semibold">{{ weather.tem }}°</span>
                        <span class="text-lg dark:text-gray-400">/ {{ weather.date }} {{ weather.wea }}</span>
                    </div>
                </div>
            </div>
            <div class="text-sm leadi">
                <div class="flex items-center">
                    <div class="w-20 h-20 scale-150" style="margin:-1rem;" v-if="weather.wea_img === 'qing' && time === 'day'">
                        <SunnyDay/>
                    </div>
                    <div class="w-20 h-20 scale-200" style="margin:-1rem;" v-if="weather.wea_img === 'qing' && time === 'night'">
                        <SunnyNight/>
                    </div>
                    <div class="w-20 h-20 scale-150" style="margin:-1rem;" v-if="weather.wea_img === 'yun' && time === 'day'">
                        <CloudyDay/>
                    </div>
                    <div class="w-20 h-20 scale-150" style="margin:-1rem;" v-if="weather.wea_img === 'yun' && time === 'night'">
                        <CloudyNight/>
                    </div>
                    <div class="w-20 h-20 scale-150" style="margin:-1rem;" v-if="weather.wea_img === 'xue'">
                        <Snow/>
                    </div>
                    <div class="w-20 h-20 scale-150" style="margin:-1rem;" v-if="weather.wea_img === 'lei'">
                        <Thunder/>
                    </div>
                    <div class="w-20 h-20 scale-150" style="margin:-1rem;" v-if="weather.wea_img === 'shachen'">
                        <Fog/>
                    </div>
                    <div class="w-20 h-20 scale-150" style="margin:-1rem;" v-if="weather.wea_img === 'bingbao'">
                        <Snow/>
                    </div>
                    <div class="w-20 h-20 scale-150" style="margin:-1rem;" v-if="weather.wea_img === 'yu' && time === 'day'">
                        <RainDay/>
                    </div>
                    <div class="w-20 h-20 scale-150" style="margin:-1rem;" v-if="weather.wea_img === 'yu' && time === 'night'">
                        <RainNight/>
                    </div>
                    <div class="w-20 h-20 scale-150" style="margin:-1rem;" v-if="weather.wea_img === 'yin'">
                        <Overcast/>
                    </div>
                    <div class="w-20 h-20 scale-150" style="margin:-1rem;" v-if="weather.wea_img === 'wu'">
                        <Fog/>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex items-center justify-between gap-8 p-4 border-t dark:text-gray-400 dark:border-gray-700">
            <div class="flex items-center space-x-1">
                <span class="font-bold">{{ weather.tem_night }}°</span>
                <span class="text-sm">夜间低温</span>
            </div>
            <div class="flex items-center space-x-1">
                <span class="font-bold">{{ weather.air }}</span>
                <span class="text-sm">空气指数</span>
            </div>
            <div class="flex items-center space-x-1">
                <span class="font-bold">{{ weather.tem_day }}°</span>
                <span class="text-sm">白天高温</span>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import SunnyDay from "./Weather/Icon/SunnyDay.vue";
import SunnyNight from "./Weather/Icon/SunnyNight.vue";
import Fog from "./Weather/Icon/Fog.vue";
import Overcast from "./Weather/Icon/Overcast.vue";
import CloudyDay from "./Weather/Icon/CloudyDay.vue";
import CloudyNight from "./Weather/Icon/CloudyNight.vue";
import Snow from  "./Weather/Icon/Snow.vue";
import Thunder from "./Weather/Icon/Thunder.vue";
import RainDay from "./Weather/Icon/RainDay.vue";
import RainNight from "./Weather/Icon/RainNight.vue";
import { transform, transition } from "@tailwindcss/aspect-ratio";
import jsonp from 'axios-jsonp'


export default {
    components: {
        RainNight,
        RainDay,
        Thunder,
        SunnyDay,
        SunnyNight,
        Fog,
        Overcast,
        CloudyDay,
        CloudyNight,
        Snow
    },
    name: 'Weather',
    data() {
        return {
            weather: '',
            time: '',
            lastRequestTime: null,
        }
    },
    mounted() {
        this.getCity()
        this.isDaytime()
        let that = this;
        window.addEventListener("setItemEvent", function(e) {
            if (e.key === "theme") {
                if (e.newValue === 'light') {
                    that.time = 'day';
                } else {
                    that.time = 'night';
                }
            }
        })
    },
    methods: {
        isDaytime() {
            if (!('theme' in localStorage)) {
                const date = new Date(); // 创建日期对象
                const currentHour = date.getHours(); // 获取当前小时数
                if (currentHour >= 6 && currentHour <= 18) {
                    this.time = 'day';
                } else {
                    this.time = 'night';
                }
            } else {
                if (localStorage.getItem('theme') === 'dark') {
                    this.time = 'night';
                } else {
                    this.time = 'day';
                }
            }
        },
        jsonpRequest(url) {
            return axios({
                url: url,
                adapter: jsonp
            })
        },
        async getCity() {
            try {
                const response = await axios.get('https://ip.useragentinfo.com/json');
                if (response.data.area && response.data.area.length > 0) {
                    const url = 'https://v1.yiketianqi.com/free/day?city=' + response.data.area.slice(0, -1) + '&unescape=1&appid=35847559&appsecret=kveLP2Sd&unescape=1'
                    this.getWeather(url)
                } else {
                    const url = 'https://v1.yiketianqi.com/free/day?unescape=1&appid=35847559&appsecret=kveLP2Sd&unescape=1'
                    this.getWeather(url)
                }
            } catch (error) {
                console.log(error)
            }
        },
        async getWeather(url) {
            this.jsonpRequest(url)
                .then(response => {
                    // 请求成功处理逻辑
                    this.weather = response.data;
                })
                .catch(error => {
                    // 请求失败处理逻辑
                    console.error('请求失败', error)
                })
        }
    }
}
</script>
<style>

</style>
