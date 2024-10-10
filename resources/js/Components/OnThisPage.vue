<template>
    <div id="content"
         class="px-4 py-4 sm:px-4 lg:px-8 sm:py-4 lg:py-8 bg-opacity-50 text-gray-600 shadow-sm rounded-lg sm:rounded-lg bg-white dark:bg-zinc-800 dark:bg-opacity-50 dark:text-gray-200 backdrop-blur-sm backdrop-filter">
        <div ref="content" v-html="content"></div>
        <div class="justify-end text-right mt-12">{{ updatedText }}<span
            class="font-bold pl-3">{{ updatedAt }}</span></div>
    </div>


    <div id="on-this-page" class="on-this-page fixed top-60">
        <ul></ul>
    </div>
</template>

<script>
import 'highlight.js/styles/stackoverflow-light.css'
import 'highlight.js/lib/common';
import hljs from "highlight.js";

export default {
    props: {
        content: {
            type: String,
            required: true,
        },
        updatedAt: {
            type: String,
            default: '',
        },
        updatedText: {
            type: String,
            default: '',
        },
        fontFamily: {
            type: String,
            default: '',
        },
    },

    data() {
        return {
            show: false,
        };
    },
    mounted() {
        const contentElement = this.$refs.content;

        const highlight = () => {
            // 使用 highlight.js 高亮所有的 pre code 块
            const codeBlocks = document.querySelectorAll('pre code');
            codeBlocks.forEach((block) => {
                hljs.highlightBlock(block); // 使用 highlightBlock 而不是 highlightElement
            });

            // 查找所有 pre code 块中的第一个 span 并在其之前插入 div
            const firstSpans = document.querySelectorAll('pre code');
            firstSpans.forEach((firstSpan) => {
                // 创建一个新的 div 元素
                const newDivA = document.createElement('div');
                const newDiv = document.createElement('div');
                newDiv.className='flex';
                newDiv.style='margin: -1rem ;background: #000000;height:35px; margin-bottom: 1rem; padding:5px;';
                const red = document.createElement('i');
                // 设置 i 标签的内容或属性（可选）
                red.style = 'margin:5px; width:15px;height:15px;border-radius:50%;background-color:#FF5D59;display: block';
                newDiv.appendChild(red);
                const yellow = document.createElement('i');
                // 设置 i 标签的内容或属性（可选）
                yellow.style = 'margin:5px; width:15px;height:15px;border-radius:50%;background-color:#FFBA3D;display: block';
                newDiv.appendChild(yellow);
                const green = document.createElement('i');
                // 设置 i 标签的内容或属性（可选）
                green.style = 'margin:5px; width:15px;height:15px;border-radius:50%;background-color:#29C74A;display: block';
                newDiv.appendChild(green);
                newDivA.appendChild(newDiv);
                // 在第一个 span 元素之前插入新的 div 元素
                firstSpan.innerHTML = newDivA.innerHTML + firstSpan.innerHTML;
            });
        };

// 调用 highlight 函数
        highlight();

        const headings = contentElement.querySelectorAll('h1, h2, h3, h4, h5, h6');

        if (headings.length > 0) {
            this.show = true;
        }

        headings.forEach((heading) => {
            const text = heading.textContent;
            const link = document.createElement('a');
            link.href = `#${text}`;
            link.textContent = text;

            const pl = ((parseInt(heading.tagName.slice(1)) - 1) * 18) + "px";
            const li = document.createElement('li');
            li.className = "py-2 text-lg text-white hover:text-green-400 pg-text-shadow";
            li.style.paddingLeft = pl;
            li.appendChild(link);

            document.querySelector('#on-this-page ul').appendChild(li);
        });
    }


};
</script>
<style>
.on-this-page {
    right: 10rem;
}

#content img {
    padding: 1.5rem 1rem;
}

#content p {
    margin: 15px 0;
}

.hljs {
    margin: 1rem;
    background: rgba(246, 246, 246, 0.75);
    color: rgb(75 85 99);
    border-radius: 0.5rem;
}

.pg-text-shadow {
    text-shadow: rgb(0, 0, 0) 0 0 0.8em, rgb(0, 0, 0) 0 0 0.4em;
}

@media (max-width: 1850px) {
    .on-this-page {
        display: none;
    }
}

@media (min-width: 1851px) and (max-width: 2540px) {
    .on-this-page {
        right: 2rem;
    }
}

</style>
