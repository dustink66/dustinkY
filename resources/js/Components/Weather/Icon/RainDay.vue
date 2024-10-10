<template>
    <div @click="next()">
        <lottie
            :options="heartOptions"
            :path="'https://static.dustinky.com/assets/lottie/rain-day.json'"
            v-on:animCreated="heartAnimation"
        />
    </div>
</template>

<script>
import lottie from '../../Lotties.vue';
//import LottieData from '../../../../assets/json/rain-day.json'
export default {
    name: "RainDay",
    components: {
        lottie,
    },
    data() {
        return {
            heartOptions: {
                //animationData:LottieData,
                loop: true,
                autoplay: true,
            },
            heartanim: null,
            Direction: -1,
        };
    },
    methods: {
        heartAnimation: function (anim) {
            this.heartanim = anim;
        },
        next() {

            if (this.Direction > 0) {
                this.Direction = -1;
                this.heartanim.setDirection(this.Direction);
                this.heartanim.play();
            } else {
                this.Direction = 1;
                this.heartanim.setDirection(this.Direction);
                this.heartanim.play();
            }
        },
    },
};
</script>

<style lang="scss" scoped>
</style>
