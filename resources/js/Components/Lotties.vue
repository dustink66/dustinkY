<template>
    <div>
        <div ref="bodyAnimation" :style="style"></div>
    </div>
</template>

<script>
import lottie from "lottie-web";
export default {
    name: "LPC",
    props: {
        options: {
            type: Object,
            required: true,
        },
        path: {
            type: String,
            required: true,
        },
        width: {
            type: Number,
        },
        height: {
            type: Number,
        },
    },
    data() {
        return {
            style: {
                width: this.width ? `${this.width}px` : "100%",
                height: this.height ? `${this.height}px` : "100%",
                overflow: "hidden",
                margin: "0 auto",
            },
        };
    },
    mounted() {
        this.anim = lottie.loadAnimation({
            container: this.$refs.bodyAnimation, // the dom element that will contain the animation
            renderer: "svg",
            loop: this.options.loop !== false,
            autoplay: this.options.autoplay !== false,
            animationData: this.options.animationData,
            rendererSettings: this.options.rendererSettings,
            path: this.path,
            //   path: sheepJson // the path to the animation json
        });
        this.$emit("animCreated", this.anim);
    },
    methods: {},
};
</script>

<style lang="scss" scoped>
</style>
