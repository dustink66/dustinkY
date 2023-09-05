<template>
    <div>
        <img id="logo" class="dark:invert" v-if="url" :src="url" :class="height" />
        <div v-else>
            <div v-if="siteName" :class="height + ' ' + fontSize">
                <svg v-if="align === 'left'" class="h-full fill-black dark:fill-white">
                    <text id="textContainer" alignment-baseline="middle" x="0" y="50%">{{ siteName }}</text>
                </svg>
                <svg v-else class="h-full fill-black dark:fill-white">
                    <text id="textContainer" text-anchor="middle" alignment-baseline="middle" x="50%" y="50%">{{ siteName }}</text>
                </svg>
            </div>
            <svg v-else id="logo" :class="height" xmlns="http://www.w3.org/2000/svg"
                 xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                 viewBox="0 0 560 116" xml:space="preserve">
                <g class="logo-start fill-none">
                    <path class="st0" d="M44,33.8h39.2v10.7c0,3.6-2.9,6.4-6.5,6.4H44c-12.2,0-22,9.8-22,22c0,12.2,9.8,22,22,22s22-9.8,22-22v-7.7
                c0-3.6,2.9-6.5,6.5-6.5h10.8v14.3c-0.1,21.6-17.6,39.2-39.2,39.2C22.4,112.3,4.8,94.7,4.8,73.1C4.8,51.4,22.4,33.9,44,33.8z"/>
                    <path class="st1" d="M66.1,26V13.2C66.1,6.1,71.8,1,83.2,0v19.6c0,3.6-2.9,6.4-6.5,6.4H66.1z"/>
                </g>
                <g class="logo-text fill-none">
                    <path d="M143.6,99.4v-2.1c-1.9,2.4-3.9,4.5-6,6.1s-4.4,2.9-6.9,3.7c-2.5,0.8-5.4,1.2-8.6,1.2c-3.9,0-7.3-0.8-10.4-2.4
                c-3.1-1.6-5.4-3.8-7.1-6.6c-2-3.4-3-8.3-3-14.6V53c0-3.2,0.7-5.6,2.2-7.2c1.4-1.6,3.4-2.4,5.7-2.4c2.4,0,4.4,0.8,5.9,2.4
                c1.5,1.6,2.2,4,2.2,7.1v25.6c0,3.7,0.3,6.8,0.9,9.3c0.6,2.5,1.7,4.5,3.4,5.9c1.6,1.4,3.8,2.1,6.6,2.1c2.7,0,5.2-0.8,7.6-2.4
                c2.4-1.6,4.1-3.7,5.2-6.3c0.9-2.3,1.3-7.2,1.3-14.9V53c0-3.2,0.7-5.5,2.2-7.1c1.5-1.6,3.4-2.4,5.8-2.4c2.4,0,4.3,0.8,5.7,2.4
                c1.4,1.6,2.2,4,2.2,7.2v46.3c0,3-0.7,5.3-2.1,6.9c-1.4,1.5-3.2,2.3-5.4,2.3c-2.2,0-4-0.8-5.4-2.4
                C144.3,104.5,143.6,102.3,143.6,99.4z"/>
                    <path d="M229.6,87.5c0,4.4-1.1,8.2-3.2,11.3c-2.1,3.1-5.3,5.5-9.5,7.1c-4.2,1.6-9.3,2.4-15.3,2.4c-5.7,0-10.7-0.9-14.8-2.6
                s-7.1-4-9.1-6.6c-2-2.6-2.9-5.3-2.9-7.9c0-1.8,0.6-3.3,1.9-4.5c1.2-1.2,2.8-1.9,4.7-1.9c1.7,0,3,0.4,3.9,1.2
                c0.9,0.8,1.8,2,2.6,3.5c1.6,2.9,3.6,5,5.9,6.4s5.4,2.1,9.3,2.1c3.2,0,5.8-0.7,7.9-2.1s3.1-3.1,3.1-4.9c0-2.8-1.1-4.9-3.2-6.2
                c-2.1-1.3-5.6-2.5-10.5-3.7c-5.5-1.4-10-2.8-13.4-4.3s-6.2-3.5-8.3-5.9c-2.1-2.5-3.1-5.5-3.1-9.1c0-3.2,1-6.2,2.9-9.1
                c1.9-2.9,4.7-5.1,8.5-6.8c3.7-1.7,8.2-2.5,13.5-2.5c4.1,0,7.9,0.4,11.2,1.3c3.3,0.9,6.1,2,8.3,3.5c2.2,1.4,3.9,3,5,4.8
                c1.2,1.8,1.7,3.5,1.7,5.2c0,1.8-0.6,3.3-1.8,4.5s-3,1.8-5.2,1.8c-1.6,0-3-0.5-4.2-1.4c-1.2-0.9-2.5-2.3-4-4.2
                c-1.2-1.6-2.6-2.8-4.3-3.8s-3.9-1.4-6.7-1.4c-2.9,0-5.3,0.6-7.2,1.8c-1.9,1.2-2.9,2.8-2.9,4.6c0,1.7,0.7,3.1,2.1,4.1
                s3.3,2,5.7,2.7c2.4,0.7,5.7,1.6,9.8,2.6c5,1.2,9,2.7,12.2,4.3c3.1,1.7,5.5,3.7,7.1,5.9C228.8,82,229.6,84.6,229.6,87.5z"/>
                    <path d="M247.6,44.8h1.8v-9.6c0-2.6,0.1-4.6,0.2-6.1c0.1-1.5,0.5-2.7,1.1-3.8c0.6-1.1,1.5-2,2.7-2.7c1.2-0.7,2.5-1,3.9-1
                c2,0,3.9,0.8,5.5,2.3c1.1,1,1.8,2.3,2.1,3.7s0.4,3.5,0.4,6.2v10.9h5.9c2.3,0,4,0.5,5.2,1.6c1.2,1.1,1.8,2.5,1.8,4.1
                c0,2.1-0.8,3.7-2.5,4.5c-1.7,0.9-4.1,1.3-7.3,1.3h-3v29.4c0,2.5,0.1,4.4,0.3,5.8s0.6,2.4,1.4,3.3s2,1.3,3.7,1.3
                c0.9,0,2.2-0.2,3.8-0.5c1.6-0.3,2.9-0.5,3.8-0.5c1.3,0,2.5,0.5,3.5,1.6c1,1,1.6,2.3,1.6,3.8c0,2.6-1.4,4.6-4.2,5.9
                s-6.9,2.1-12.1,2.1c-5,0-8.8-0.8-11.4-2.5c-2.6-1.7-4.3-4-5.1-7c-0.8-3-1.2-6.9-1.2-11.9V56.4h-2.1c-2.3,0-4.1-0.5-5.3-1.6
                c-1.2-1.1-1.8-2.5-1.8-4.2c0-1.7,0.6-3.1,1.9-4.1C243.4,45.4,245.2,44.8,247.6,44.8z"/>
                    <path d="M300.9,36c-2.2,0-4.1-0.7-5.7-2.1c-1.6-1.4-2.4-3.3-2.4-5.8c0-2.3,0.8-4.1,2.4-5.6c1.6-1.5,3.5-2.2,5.7-2.2
                c2.1,0,3.9,0.7,5.5,2c1.6,1.3,2.4,3.3,2.4,5.8c0,2.5-0.8,4.4-2.3,5.8C304.9,35.3,303.1,36,300.9,36z M308.8,52.5v46.2
                c0,3.2-0.8,5.6-2.3,7.3s-3.5,2.5-5.8,2.5s-4.2-0.8-5.7-2.5s-2.2-4.1-2.2-7.2V53c0-3.2,0.7-5.5,2.2-7.1c1.5-1.6,3.4-2.4,5.7-2.4
                s4.3,0.8,5.8,2.4C308.1,47.4,308.8,49.7,308.8,52.5z"/>
                    <path d="M343.5,52.3v1.9c2.8-3.7,5.9-6.4,9.2-8.2c3.3-1.7,7.2-2.6,11.5-2.6c4.2,0,8,0.9,11.3,2.8c3.3,1.8,5.8,4.4,7.4,7.8
                c1.1,2,1.7,4.1,2.1,6.3c0.3,2.3,0.5,5.2,0.5,8.7v29.8c0,3.2-0.7,5.6-2.2,7.3s-3.4,2.5-5.7,2.5c-2.4,0-4.3-0.8-5.8-2.5
                c-1.5-1.7-2.2-4.1-2.2-7.2V72.1c0-5.3-0.7-9.3-2.2-12.1s-4.4-4.2-8.8-4.2c-2.9,0-5.4,0.8-7.8,2.5s-4.1,4-5.2,7
                c-0.8,2.4-1.2,6.8-1.2,13.4v20c0,3.2-0.8,5.7-2.3,7.3c-1.5,1.6-3.4,2.4-5.8,2.4c-2.3,0-4.2-0.8-5.7-2.5c-1.5-1.7-2.2-4.1-2.2-7.2
                V52.5c0-3,0.7-5.3,2-6.8c1.3-1.5,3.1-2.3,5.4-2.3c1.4,0,2.7,0.3,3.8,1c1.1,0.7,2,1.7,2.7,3C343.1,48.7,343.5,50.4,343.5,52.3z"/>
                    <path d="M444.9,101.1l-14.1-23.2l-8.7,8.2v12.7c0,3.1-0.8,5.5-2.4,7.1c-1.6,1.7-3.5,2.5-5.6,2.5c-2.5,0-4.4-0.8-5.8-2.5
                s-2.1-4.1-2.1-7.3V30.5c0-3.6,0.7-6.3,2.1-8.1c1.4-1.9,3.3-2.8,5.9-2.8c2.5,0,4.4,0.8,5.9,2.5c1.4,1.7,2.2,4.2,2.2,7.4v38.8
                l18-18.9c2.2-2.3,3.9-3.9,5.1-4.8c1.2-0.9,2.6-1.3,4.3-1.3c2,0,3.7,0.6,5,1.9c1.3,1.3,2,2.9,2,4.8c0,2.3-2.2,5.5-6.5,9.4l-8.5,7.8
                l16.4,25.8c1.2,1.9,2.1,3.4,2.6,4.4s0.8,1.9,0.8,2.8c0,2.5-0.7,4.5-2.1,6c-1.4,1.5-3.2,2.2-5.5,2.2c-2,0-3.5-0.5-4.5-1.6
                S446.7,103.9,444.9,101.1z"/>
                </g>
                <g class="logo-end fill-none">
                    <path d="M502.4,96.3V64.5L478,26.6c-2.1-3.4-3.7-6.1-4.5-8s-1.3-3.6-1.3-5c0-2.3,0.9-4.3,2.7-6c1.8-1.7,4-2.5,6.7-2.5
                c2.8,0,4.9,0.8,6.3,2.4s3.6,4.7,6.5,9.4L513,47.3l18.9-30.4c1.1-1.9,2.1-3.4,2.9-4.7c0.8-1.3,1.6-2.5,2.6-3.6c0.9-1.1,2-2,3.1-2.6
                c1.1-0.6,2.5-0.9,4.2-0.9c2.6,0,4.7,0.8,6.4,2.5c1.7,1.7,2.6,3.6,2.6,5.8c0,1.8-0.4,3.6-1.3,5.3c-0.9,1.8-2.3,4.2-4.4,7.4
                l-25.1,38.5v31.8c0,4.1-1,7.2-2.9,9.3s-4.4,3.1-7.3,3.1c-3,0-5.4-1-7.3-3C503.4,103.6,502.4,100.5,502.4,96.3z"/>
                </g>
            </svg>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        align: {
            type: String,
            default: '',
        },
        siteName: {
            type: String,
            default: '',
        },
        fontSize: {
            type: String,
            default: 'text-3xl',
        },
        url: {
            type: String,
            default: '',
        },
        height: {
            type: String,
            default: 'h-9',
        },
    },
    mounted() {
        const logo = document.querySelectorAll('.logo path');
        for (let i = 0; i < logo.length; i++) {
            console.log(`Letter ${i} is ${logo[i].getTotalLength()}`);
        }
        if (this.siteName && this.url === null) {
            const textContainer = document.getElementById('textContainer');
            const text = this.siteName;
            let index = 0;

            function typeText() {
                textContainer.textContent = text.slice(0, index);
                index++;
                if (index <= text.length) {
                    setTimeout(typeText, 100);
                }
            }

            typeText();
        }
    },
};
</script>

<style scoped>

.logo-start {
    stroke: #3b82f6;
    stroke-width: 5px;
    animation: fill-anim-blue 2s ease forwards 3s;
}

.logo-text {
    stroke: black;
    stroke-width: 5px;
    animation: fill-anim 2s ease forwards 17s;
}

.logo-end {
    stroke: limegreen;
    stroke-width: 5px;
    animation: fill-anim-limegreen 2s ease forwards 17s;
}

.logo-start path:nth-child(1) {
    stroke-dasharray: 424px;
    stroke-dashoffset: 424px;
    animation: line-anim 2s ease forwards 1s;
}
.logo-start path:nth-child(2) {
    stroke-dasharray: 77px;
    stroke-dashoffset: 77px;
    animation: line-anim 1s ease forwards;
}
.logo-text path:nth-child(1) {
    stroke-dasharray: 323px;
    stroke-dashoffset: 323px;
    animation: line-anim 2s ease forwards 3s;
}
.logo-text path:nth-child(2) {
    stroke-dasharray: 345px;
    stroke-dashoffset: 345px;
    animation: line-anim 2s ease forwards 5s;
}
.logo-text path:nth-child(3) {
    stroke-dasharray: 254px;
    stroke-dashoffset: 254px;
    animation: line-anim 2s ease forwards 7s;
}
.logo-text path:nth-child(4) {
    stroke-dasharray: 198px;
    stroke-dashoffset: 198px;
    animation: line-anim 2s ease forwards 9s;
}
.logo-text path:nth-child(5) {
    stroke-dasharray: 324px;
    stroke-dashoffset: 324px;
    animation: line-anim 2s ease forwards 11s;
}
.logo-text path:nth-child(6) {
    stroke-dasharray: 352px;
    stroke-dashoffset: 352px;
    animation: line-anim 2s ease forwards 13s;
}
.logo-end path:nth-child(1) {
    stroke-dasharray: 356px;
    stroke-dashoffset: 356px;
    animation: line-anim 2s ease forwards 15s;
}

@keyframes line-anim {
    to {
        stroke-dashoffset: 0;
    }
}

@keyframes fill-anim {
    from {
        stroke-width: 5px;
        fill: transparent;
    }
    to {
        stroke-width: 1px;
        fill: black;
    }
}

@keyframes fill-anim-blue {
    from {
        stroke-width: 5px;
        fill: transparent;
    }
    to {
        stroke-width: 1px;
        fill: #3b82f6;
    }
}

@keyframes fill-anim-limegreen {
    from {
        stroke-width: 5px;
        fill: transparent;
    }
    to {
        stroke-width: 1px;
        fill: limegreen;
    }
}

html.dark .logo-start {
    stroke: #3b82f6;
    stroke-width: 5px;
    animation: fill-anim-dark-blue 2s ease forwards 3s;
}

html.dark .logo-text {
    stroke: white;
    stroke-width: 5px;
    animation: fill-anim-dark 2s ease forwards 17s;
}

html.dark .logo-end {
    stroke: limegreen;
    stroke-width: 5px;
    animation: fill-anim-dark-limegreen 2s ease forwards 17s;
}

html.dark .logo-start path:nth-child(1) {
    animation: line-anim-dark 2s ease forwards 1s;
}
html.dark .logo-start path:nth-child(2) {
    animation: line-anim-dark 1s ease forwards;
}
html.dark .logo-text path:nth-child(1) {
    animation: line-anim-dark 2s ease forwards 3s;
}
html.dark .logo-text path:nth-child(2) {
    animation: line-anim-dark 2s ease forwards 5s;
}
html.dark .logo-text path:nth-child(3) {
    animation: line-anim-dark 2s ease forwards 7s;
}
html.dark .logo-text path:nth-child(4) {
    animation: line-anim-dark 2s ease forwards 9s;
}
html.dark .logo-text path:nth-child(5) {
    animation: line-anim-dark 2s ease forwards 11s;
}
html.dark .logo-text path:nth-child(6) {
    animation: line-anim-dark 2s ease forwards 13s;
}
html.dark .logo-end path:nth-child(1) {
    animation: line-anim-dark 2s ease forwards 15s;
}

@keyframes line-anim-dark {
    to {
        stroke-dashoffset: 0;
    }
}

@keyframes fill-anim-dark {
    from {
        stroke-width: 5px;
        fill: transparent;
    }
    to {
        stroke-width: 1px;
        fill: white;
    }
}

@keyframes fill-anim-dark-blue {
    from {
        stroke-width: 5px;
        fill: transparent;
    }
    to {
        stroke-width: 1px;
        fill: #3b82f6;
    }
}

@keyframes fill-anim-dark-limegreen {
    from {
        stroke-width: 5px;
        fill: transparent;
    }
    to {
        stroke-width: 1px;
        fill: limegreen;
    }
}
</style>

