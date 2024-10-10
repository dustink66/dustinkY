<template>
    <div @click="next">
        <lottie
            :options="heartOptions"
            v-on:animCreated="heartAnimation"
        />
    </div>
</template>

<script>
import lottie from '../Lotties.vue';
import sunnyNight from "../../../assets/json/sunny-night.json";
import fog from "../../../assets/json/fog.json";
// 假设你有其他天气类型的动画数据，也需要导入它们
// import rain from '../../../assets/json/rain.json';
// ...

export default {
    name: 'WeatherLottieIcon',
    components: {
        lottie,
    },
    props: {
        icon: {
            type: String,
            required: true,
        },
    },
    data() {
        return {
            heartOptions: {
                animationData: fog, // 初始化为 null
                loop: true,
                autoplay: true,
            },
            heartanim: null,
            Direction: -1,
        };
    },
    mounted() {
        console.log(this.icon)
        switch (this.icon) {
            case 'sunnyNight':
                this.heartOptions.animationData = sunnyNight;
                break;
            case 'fog':
                this.heartOptions.animationData = fog;
                break;
            // 添加其他天气类型的 case
            // case 'rain':
            //   this.heartOptions.animationData = rain;
            //   break;
            // ...
            default:
                console.warn(`Unknown icon type: ${this.icon}`);
                break;
        }
    },
    methods: {
        heartAnimation(anim) {
            this.heartanim = anim;
        },
        next() {

            if (this.Direction > 0) {
                this.Direction = -1;
                this.heartanim.setDirection(this.Direction);
                this.heartanim.play();
                console.log(1);
            } else {
                this.Direction = 1;
                this.heartanim.setDirection(this.Direction);
                this.heartanim.play();
                console.log(2);
            }
        },
    },
};
</script>

<style lang="scss" scoped>
/* 你的样式 */
</style>
