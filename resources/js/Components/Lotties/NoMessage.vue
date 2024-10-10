<template>
    <div @click="next()">
        <lottie
            :options="heartOptions"
            :path="'https://static.dustinky.com/assets/lottie/no-message.json'"
            v-on:animCreated="heartAnimation"
        />
    </div>
</template>

<script>
import lottie from '../Lotties.vue'
//import LottieData from '../../../assets/json/no-message.json'
export default {
    name: "NoMessage",
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
    mounted() {},
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
