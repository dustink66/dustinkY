<template>
    <div class="py-2">
        <div class="flex justify-between items-center">
            <div class="text-2xl font-semibold text-gray-700 dark:text-gray-200" >
                偶得佳句
            </div>

            <div class="transform hover:scale-150 transition duration-300">
                <button class="rotate-on-hover antd icon-shuaxin1 text-2xl hover:text-green-500 hover:shadow-2xl ml-auto dark:text-white" @click="getHitokoto"></button>
            </div>
        </div>

        <section class="isolate overflow-hidden px-3">
            <div class="relative mx-auto max-w-2xl pt-12 lg:max-w-4xl">
                <figure class="grid grid-cols-1 items-center gap-y-8">
                    <div class="relative col-span-2 lg:col-start-1 lg:row-start-2">
                        <span class="absolute -top-12 lg:-top-16 left-48 -z-10 h-32 text-3xl text-gray-900/10 dark:text-gray-200/20" >Daily Motto</span>
                        <svg viewBox="0 0 162 128" fill="none" aria-hidden="true" class="absolute -top-12 left-0 -z-10 h-32 stroke-gray-900/20 dark:stroke-gray-600">
                            <path id="b56e9dab-6ccb-4d32-ad02-6b4bb5d9bbeb" d="M65.5697 118.507L65.8918 118.89C68.9503 116.314 71.367 113.253 73.1386 109.71C74.9162 106.155 75.8027 102.28 75.8027 98.0919C75.8027 94.237 75.16 90.6155 73.8708 87.2314C72.5851 83.8565 70.8137 80.9533 68.553 78.5292C66.4529 76.1079 63.9476 74.2482 61.0407 72.9536C58.2795 71.4949 55.276 70.767 52.0386 70.767C48.9935 70.767 46.4686 71.1668 44.4872 71.9924L44.4799 71.9955L44.4726 71.9988C42.7101 72.7999 41.1035 73.6831 39.6544 74.6492C38.2407 75.5916 36.8279 76.455 35.4159 77.2394L35.4047 77.2457L35.3938 77.2525C34.2318 77.9787 32.6713 78.3634 30.6736 78.3634C29.0405 78.3634 27.5131 77.2868 26.1274 74.8257C24.7483 72.2185 24.0519 69.2166 24.0519 65.8071C24.0519 60.0311 25.3782 54.4081 28.0373 48.9335C30.703 43.4454 34.3114 38.345 38.8667 33.6325C43.5812 28.761 49.0045 24.5159 55.1389 20.8979C60.1667 18.0071 65.4966 15.6179 71.1291 13.7305C73.8626 12.8145 75.8027 10.2968 75.8027 7.38572C75.8027 3.6497 72.6341 0.62247 68.8814 1.1527C61.1635 2.2432 53.7398 4.41426 46.6119 7.66522C37.5369 11.6459 29.5729 17.0612 22.7236 23.9105C16.0322 30.6019 10.618 38.4859 6.47981 47.558L6.47976 47.558L6.47682 47.5647C2.4901 56.6544 0.5 66.6148 0.5 77.4391C0.5 84.2996 1.61702 90.7679 3.85425 96.8404L3.8558 96.8445C6.08991 102.749 9.12394 108.02 12.959 112.654L12.959 112.654L12.9646 112.661C16.8027 117.138 21.2829 120.739 26.4034 123.459L26.4033 123.459L26.4144 123.465C31.5505 126.033 37.0873 127.316 43.0178 127.316C47.5035 127.316 51.6783 126.595 55.5376 125.148L55.5376 125.148L55.5477 125.144C59.5516 123.542 63.0052 121.456 65.9019 118.881L65.5697 118.507Z" />
                            <use href="#b56e9dab-6ccb-4d32-ad02-6b4bb5d9bbeb" x="86" />
                        </svg>
                        <blockquote class="text-xl leading-8 text-gray-900 sm:text-2xl sm:leading-9">
                            <p class="text-3xl MaShanZheng py-2 px-2 text-gray-700 dark:text-gray-200"><a :href="'https://www.baidu.com/s?wd=' + hitokoto" target="_blank">{{ hitokoto }}</a></p>
                        </blockquote>
                    </div>
                    <figcaption v-if="from_who" class="text-xl lg:col-start-1 lg:row-start-3 text-right" >
                        <div class="mt-1 text-gray-500 dark:text-gray-300">{{ from }}</div>
                        <div class="font-semibold text-gray-900 dark:text-gray-200">{{ from_who }}</div>
                    </figcaption>
                    <figcaption v-else class="text-xl lg:col-start-1 lg:row-start-3 text-right" >
                        <div class="mt-1 text-gray-500 dark:text-gray-300">{{ from }}</div>
                    </figcaption>
                </figure>
            </div>
        </section>
    </div>
</template>

<script>
import axios from 'axios';
import { transform, transition } from "@tailwindcss/aspect-ratio";
import jsonp from "axios-jsonp";

export default {
    name: 'Motto',
    data() {
        return {
            hitokoto: '',
            from: '',
            from_who: ''
        }
    },
    mounted() {
        this.getHitokoto()
    },
    methods: {
        jsonpRequest(url) {
            return axios({
                url: url,
                adapter: jsonp
            })
        },
        async getHitokoto() {
            this.jsonpRequest('https://v1.hitokoto.cn/')
                .then(response => {
                    // 请求成功处理逻辑
                    this.hitokoto = response.data.hitokoto;
                    this.from = response.data.from;
                    this.from_who = response.data.from_who;
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

.rotate-on-hover {
    display: inline-block;
    animation: rotate 2s infinite steps(100);
}

@keyframes rotate {
    0% {
        transform: rotate(0deg);
    }
    100% {
        transform: rotate(360deg);
    }
}



</style>
