<template>
    <div class="swiper-demo rounded-2xl hover:shadow-2xl dark:hover:shadow-2xl dark:hover:shadow-gray-400 transform transition duration-300">
        <div class="swiper-wrapper rounded-2xl">
            <div class="swiper-slide rounded-2xl" v-for="(slide, index) in slideArr" :key="index">
                <Link v-if="index % 2 === 0" :href="'/posts/' + slide.slug" class="relative isolate flex flex-col justify-center overflow-hidden rounded-2xl bg-gray-900 px-8 lg:px-12 aspect-[16/8] lg:aspect-[16/6] lg:w-full" >
                    <img :src="slide.image" alt="" class="absolute inset-0 -z-10 h-52 lg:h-full w-full object-cover">
                    <div class="absolute inset-0 -z-10 h-52 lg:h-full bg-gradient-to-t lg:bg-gradient-to-l from-gray-100 via-gray-100/80 dark:from-gray-900 dark:via-gray-900/80"></div>
                    <h3 class="mt-3 text-lg leading-6 text-gray-800 dark:text-gray-100">
                        <span class="absolute right-0 top-0 bg-green-50 py-2 px-2 rounded-bl-2xl text-green-700 dark:ring-1 dark:ring-inset dark:ring-green-500/50 dark:bg-green-50/10 dark:text-green-400">{{slide.category.title}}</span>
                        <div class="hidden sm:block title-max-w-md ml-auto h-full pr-10">
                            <span class="text-5xl line-clamp-2 transform hover:scale-125 transition duration-300">{{slide.title}}</span>
                            <p class="py-8 line-clamp-3">{{slide.meta_description}}</p>
                        </div>
                        <div class="block sm:hidden text-center">
                            <span class="text-2xl line-clamp-2">{{slide.title}}</span>
                        </div>
                    </h3>
                </Link>
                <Link v-else :href="'/posts/' + slide.slug" class="relative isolate flex flex-col justify-center overflow-hidden rounded-2xl bg-gray-900 px-8 lg:px-12 aspect-[16/8] lg:aspect-[16/6] lg:w-full" >
                    <img :src="slide.image" alt="" class="absolute inset-0 -z-10 h-52 lg:h-full w-full object-cover">
                    <div class="absolute inset-0 -z-10 h-52 lg:h-full bg-gradient-to-t lg:bg-gradient-to-r from-gray-100 via-gray-100/80 dark:from-gray-900 dark:via-gray-900/80"></div>
                    <h3 class="mt-3 text-lg leading-6 text-gray-800 dark:text-gray-100">
                        <span class="absolute right-0 top-0 bg-green-50 py-2 px-2 rounded-bl-2xl text-green-700 dark:ring-1 dark:ring-inset dark:ring-green-500/50 dark:bg-green-50/10 dark:text-green-400">{{slide.category.title}}</span>
                        <div class="hidden sm:block title-max-w-md h-full pl-10">
                            <span class="text-5xl line-clamp-2 transform hover:scale-125 transition duration-300">{{slide.title}}</span>
                            <p class="py-8 line-clamp-3">{{slide.meta_description}}</p>
                        </div>
                        <div class="block sm:hidden text-center">
                            <span class="text-2xl line-clamp-2">{{slide.title}}</span>
                        </div>
                    </h3>
                </Link>
            </div>
        </div>
        <div class="swiper-pagination"></div>
        <div class="swiper-button-prev px-6 py-8 rounded-r-2xl text-gray-800 hover:bg-opacity-80 dark:hover:bg-opacity-80 dark:text-gray-100 hover:bg-gray-800 hover:text-gray-100 dark:hover:bg-gray-100 dark:hover:text-gray-800"></div>
        <div class="swiper-button-next px-6 py-8 rounded-l-2xl text-gray-800 hover:bg-opacity-80 dark:hover:bg-opacity-80 dark:text-gray-100 hover:bg-gray-800 hover:text-gray-100 dark:hover:bg-gray-100 dark:hover:text-gray-800"></div>
    </div>
</template>
<script>
import Swiper from "swiper";
import "swiper/css/swiper.min.css";
export default {
    props: {
        slideList: {
            type: Array,
            required: true
        },

    },
    data() {
        return {
            slideArr: JSON.parse(this.slideList),
        };
    },
    mounted() {
        this.swiper = new Swiper(".swiper-demo", {
            loop: true,
            effect: "fade",
            fadeEffect: {
                crossFade: true,
            },
            autoplay: {
                delay: 7000,
                disableOnInteraction: false,
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
        });
    },
};
</script>

<style>
.swiper-demo {
    width: 100%;
    height: 100%;
    position: relative;
    overflow: hidden;
}
.swiper-wrapper {
    width: 100%;
    height: 100%;
}
.swiper-slide {
    width: 100%;
    height: 100%;
}
.swiper-slide img {
    width: 100%;
    height: 100%;
}
.swiper-button-next,
.swiper-button-prev {
    position: absolute;
    top: 50%;
    margin-top: -22px;
    z-index: 10;
    cursor: pointer;
    background-position: center;
    background-repeat: no-repeat;
    color: #000000;
}
.swiper-button-prev {
    left: 0;
}
.swiper-button-next {
    right: 0;
}
.swiper-pagination {
    position: absolute;
    left: 0;
    bottom: 10px;
    width: 100%;
    text-align: center;
}
.swiper-pagination-bullet {
    width: 12px;
    height: 12px;
    display: inline-block;
    border-radius: 100%;
    background: #fff;
    opacity: 0.5;
    margin: 0 12px;
    cursor: pointer;
}
.swiper-pagination-bullet-active {
    opacity: 1;
    background: #fff;
}
.title-max-w-md {
    max-width: 30rem;
}
</style>
