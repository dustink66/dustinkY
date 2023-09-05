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
            contentElement.querySelectorAll('pre code').forEach((block) => {
                hljs.highlightElement(block);
            });
        };

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
