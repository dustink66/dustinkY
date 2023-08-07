<template>
    <div>
        <h1 className="title">{{ title }}</h1>
    </div>
</template>

<script>
export default {
    props: {
        title: {
            type: String,
            default: '默认标题'
        }
    },
    mounted() {
        const titleElement = document.querySelector('.title');

        // 设置文本居中
        titleElement.style.display = 'flex';
        titleElement.style.justifyContent = 'center';
        titleElement.style.alignItems = 'center';

        // 设置渐变动画
        titleElement.style.backgroundImage = 'linear-gradient(to right, #FFFFFF, #FFFFFF)';
        titleElement.style.backgroundSize = '200% 100%';
        titleElement.style.backgroundRepeat = 'no-repeat';
        titleElement.style.webkitBackgroundClip = 'text';
        titleElement.style.webkitTextFillColor = 'transparent';
        titleElement.style.webkitTextStroke = '1px #FFFFFF';
        titleElement.style.backgroundPositionX = '200%';


        const fillupAnimation = `
      @keyframes fillup {
        from {
          background-position-x: 200%;
        }
        to {
          background-position-x: 0%;
        }
      }
    `;

        const fadeinAnimation = `
      @keyframes fadein {
        from {
          opacity: 0;
        }
        to {
          opacity: 1;
        }
      }
    `;

        const styleElement = document.createElement('style');
        styleElement.innerHTML = fillupAnimation + fadeinAnimation;
        document.head.appendChild(styleElement);

        titleElement.addEventListener('animationend', () => {
            // 动画结束后将文字颜色设…[omitted]
            setTimeout(() => {
                titleElement.style.webkitTextFillColor = '#FFFFFF';
            }, 3000);
        });

        titleElement.style.animation = 'fillup 5s ease-in-out 2s forwards, fadein 2s ease-in-out forwards';
    }
}
</script>

<style scoped>
</style>
