<template>
    <div v-if="uploading" class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div class="relative transform overflow-hidden rounded-lg bg-white dark:bg-zinc-900 dark:bg-opacity-90 px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:p-6">
                    <div>
                        <p class="text-base font-medium text-gray-900 dark:text-gray-200">正在上传中...</p>
                        <div class="mt-6" aria-hidden="true">
                            <div class="overflow-hidden rounded-full bg-gray-200">
                                <div class="h-2 rounded-full bg-green-400" :style="'width:' + process + '%'"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="fixed w-full flex justify-center items-center bg-white border-1 dark:bg-zinc-900 z-10">
        <Toolbar
            class="justify-center items-center text-center"
            :editor="editorRef"
            :defaultConfig="toolbarConfig"
            :mode="mode"
        />
    </div>

    <div class="pt-10 pb-5">
        <div class="max-w-7xl mx-auto px-4">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-5 sm:py-1 lg:px-8 dark:bg-zinc-900 bg-opacity-80 dark:bg-opacity-80">
                <div class="py-8 leading-8 border-b-2 dark:border-zinc-700">
                    <input :placeholder="titlePlaceholder" v-model="title" class="text-5xl focus:outline-none w-full bg-transparent dark:text-gray-200" >
                </div>
                <div id="content">
                    <Editor
                        style="min-height: 550px;"
                        v-model="valueHtml"
                        :defaultConfig="editorConfig"
                        :mode="mode"
                        @onCreated="handleCreated"
                        @onChange="handleChanged"
                    />
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import SparkMD5 from "spark-md5";
import '@wangeditor/editor/dist/css/style.css' // 引入 css

import { onBeforeUnmount, ref, shallowRef, onMounted } from 'vue'
import { Editor, Toolbar } from '@wangeditor/editor-for-vue'
import {debounce} from 'lodash'

import 'highlight.js/styles/stackoverflow-light.css'
import 'highlight.js/lib/common';
import hljs from "highlight.js";

export default {
    components: { Editor, Toolbar },
    props: {
        titlePlaceholder: {
            type: String,
            default: 'Page Title'
        },
        titleValue: {
            type: String,
            default: 'Page Title'
        },
        content: String,
        url: String,
        uploadVideoUrl: String,
        checkUrl: String,
        uploadImageUrl: String,
        contentTimeoutId: {
            type: String,
            default: null
        }
    },
    data() {
        return {
            title: this.titleValue,
            titleTimeoutId: null,
        }
    },
    watch: {
        title() {
            if (this.titleTimeoutId) {
                clearTimeout(this.titleTimeoutId);
            }
            this.titleTimeoutId = setTimeout(() => {
                axios.patch(this.url, { title: this.title })
                    .then(response => {
                            console.log(response)
                        })
            }, 3000);
        },
    },
    setup(props) {
        // 编辑器实例，必须用 shallowRef
        const editorRef = shallowRef()
        // 内容 HTML
        const valueHtml = ref(props.content)

        const uploading = ref(false)

        const process = ref(0)

        const toolbarConfig = {
        }

        const vHigelight = debounce(() => {
            const code = document.querySelectorAll('pre code');
            code.forEach((block) => {
                hljs.highlightElement(block);
            });
        }, 500)

        const editorConfig = {
            placeholder: '请输入内容...',
            MENU_CONF: {},
            scroll: false,
        };

        // 自定义校验视频
        function customCheckVideoFn(src, poster) {
            console.log(src)
            // JS 语法
            if (!src) {
                return
            }
            if (src.indexOf('http') !== 0 || src.indexOf('<iframe') !== 0) {
                return '视频地址必须以 http/https 开头'
            }
            return true

            // 返回值有三种选择：
            // 1. 返回 true ，说明检查通过，编辑器将正常插入视频
            // 2. 返回一个字符串，说明检查未通过，编辑器会阻止插入。会 alert 出错误信息（即返回的字符串）
            // 3. 返回 undefined（即没有任何返回），说明检查未通过，编辑器会阻止插入。但不会提示任何信息
        }

		// 自定义转换视频
        function customParseVideoSrc(src) {
            if (src.includes('<iframe')) {
                const pattern = /<iframe.*?src=['"](.*?)['"]/;
                const match = pattern.exec(src);
                const iframeSrc = match[1];
                const container = document.createElement('div');
                container.classList.add('video-container');
                const iframe = document.createElement('iframe');
                iframe.classList.add('h-full');
                iframe.classList.add('w-full');
                iframe.src = iframeSrc;
                iframe.scrolling = 'no';
                iframe.border = '0';
                iframe.frameborder = 'no';
                iframe.framespacing = '0';
                iframe.allowfullscreen = 'true';
                container.appendChild(iframe);
                return container.innerHTML;
            } else {
                return src;
            }
        }


        editorConfig.MENU_CONF['insertVideo'] = {
            onInsertedVideo(videoNode) {
                if (videoNode == null) return
                const { src } = videoNode
                console.log('inserted video', src)
            },
            parseVideoSrc: customParseVideoSrc,
        }

        function calculateMD5(file) {
            return new Promise((resolve, reject) => {
                const fileReader = new FileReader();
                fileReader.onload = () => {
                    const arrayBuffer = fileReader.result;
                    const hash = SparkMD5.ArrayBuffer.hash(arrayBuffer);
                    resolve(hash);
                };
                fileReader.onerror = (error) => {
                    reject(error);
                };
                fileReader.readAsArrayBuffer(file);
            });
        }

        function getFileExtension(fileName) {
            const lastDotIndex = fileName.lastIndexOf('.');
            if (lastDotIndex === -1) {
                return '';
            }
            return fileName.substr(lastDotIndex + 1).toLowerCase();
        }

        editorConfig.MENU_CONF['uploadImage'] = {
            maxFileSize: 3 * 1024 * 1024,
            maxNumberOfFiles: 1,
            allowedFileTypes: ['image/*'],
            timeout: 5 * 1000, // 5 秒
            async customUpload(file, insertFn) {
                uploading.value = true
                let extension = getFileExtension(file.name);
                calculateMD5(file).then((hash) => {
                    axios.post(props.checkUrl, {
                        path: 'images/' + hash + '.' + extension,
                    }).then(res => {
                        if (res.data.code === 200) {
                            uploading.value = false;
                            insertFn(res.data.url);
                        } else {
                            let params = new FormData();
                            params.append('image', file, file.name);
                            axios.post(props.uploadImageUrl, params, {
                                headers: {
                                    'Content-Type': 'multipart/form-data'
                                },
                                onUploadProgress: function (progressEvent) {
                                    process.value = Math.round((progressEvent.loaded / progressEvent.total) * 100);
                                }
                            }).then(res => {
                                uploading.value = false
                                if (res.data.error == '0') {
                                    insertFn(res.data.url);
                                }
                            }).catch(err => {
                                uploading.value = false;
                                console.log(err);
                            })
                        }
                    }).catch(err => {
                        uploading.value = false;
                        console.log(err);
                    })
                });
            }
        }

        editorConfig.MENU_CONF['uploadVideo'] = {
            maxFileSize: 100 * 1024 * 1024,
            maxNumberOfFiles: 1,
            allowedFileTypes: ['video/mp4', 'video/ogg', 'video/webm'],
            timeout: 500 * 1000, // 5 秒
            async customUpload(file, insertFn) {
                uploading.value = true
                let extension = getFileExtension(file.name);
                calculateMD5(file).then((hash) => {
                    axios.post(props.checkUrl, {
                        path: 'videos/' + hash + '.' + extension,
                    }).then(res => {
                        if (res.data.code === 200) {
                            uploading.value = false;
                            insertFn(res.data.url);
                        } else {
                            let params = new FormData();
                            params.append('video', file, file.name);
                            axios.post(props.uploadVideoUrl, params, {
                                headers: {
                                    'Content-Type': 'multipart/form-data'
                                },
                                onUploadProgress: function (progressEvent) {
                                    process.value = Math.round((progressEvent.loaded / progressEvent.total) * 100);
                                }
                            }).then(res => {
                                uploading.value = false
                                if (res.data.error == '0') {
                                    insertFn(res.data.url);
                                }
                            }).catch(err => {
                                uploading.value = false;
                                console.log(err);
                            })
                        }
                    }).catch(err => {
                        uploading.value = false;
                        console.log(err);
                    })
                });
            }
        }

        editorConfig.MENU_CONF['codeSelectLang'] = {
            // 代码语言
            codeLangs: [
                { text: 'CSS', value: 'css' },
                { text: 'HTML', value: 'html' },
                { text: 'XML', value: 'xml' },
                { text: 'PHP', value: 'php' },
                { text: 'JavaScript', value: 'javascript' },
                { text: 'Java', value: 'java' },
                { text: 'Python', value: 'python' },
                { text: 'C', value: 'c' },
                { text: 'C++', value: 'cpp' },
                { text: 'TypeScript', value: 'typescript' },
                { text: 'Shell', value: 'shell' },
                { text: 'Go', value: 'go' },
                { text: 'Ruby', value: 'ruby' },
                { text: 'JSON', value: 'json' },
                { text: 'YAML', value: 'yaml' },
                { text: 'SQL', value: 'sql' },
                { text: 'Markdown', value: 'markdown' },
                { text: 'Plain Text', value: 'plaintext' },
                { text: '其他', value: 'other' }
                // 其他
            ]
        }

        editorConfig.MENU_CONF['fontFamily'] = {
            fontFamilyList: [
                '黑体',
                '楷体',
                '仿宋',
                '隶书',
                '幼圆',
                { name: '马善政毛笔楷书', value: 'Ma Shan Zheng', style: 'font-family: Ma Shan Zheng, cursive !important;' },
                { name: '龙藏体', value: 'Long Cang', style: 'font-family: Long Cang, cursive !important;'},
                { name: '钟齐志莽行书', value: 'Zhi Mang Xing', style: 'font-family: Zhi Mang Xing, cursive !important;'},
                { name: '站酷快乐体', value: 'ZCOOL KuaiLe', style: 'font-family: ZCOOL KuaiLe, cursive !important;'},
                { name: '站酷庆科黄油体', value: 'ZCOOL QingKe HuangYou', style: 'font-family: ZCOOL QingKe HuangYou, cursive !important;'},
                { name: '站酷小薇体', value: 'ZCOOL XiaoWei', style: 'font-family: ZCOOL XiaoWei, cursive !important;'},
                { name: 'Pacifico', value: 'Pacifico', style: 'font-family: Pacifico, cursive !important;'},
                { name: 'Pushster', value: 'Pushster', style: 'font-family: Pushster, cursive !important;'},
                { name: 'Vujahday Script', value: 'Vujahday Script', style: 'font-family: Vujahday Script, cursive !important;'},
                { name: 'Oooh Baby', value: 'Oooh Baby', style: 'font-family: Oooh Baby, cursive !important;'},
                { name: 'Licorice', value: 'Licorice', style: 'font-family: Licorice, cursive !important;'},
                { name: 'Lobster', value: 'Lobster', style: 'font-family: Lobster, cursive !important;'},
                { name: 'Dancing Script', value: 'Dancing Script', style: 'font-family: Dancing Script, cursive !important;'},
                { name: 'MoonDance', value: 'MoonDance', style: 'font-family: MoonDance, cursive !important;'},
                'Arial',
                'Tahoma',
                'Verdana',
                'Times New Roman',
                'Courier New',
                'Georgia',
                'Impact',
                'Comic Sans MS',
            ]
        }

        // 组件销毁时，也及时销毁编辑器
        onBeforeUnmount(() => {
            const editor = editorRef.value
            if (editor == null) return
            editor.destroy()
        })

        const handleCreated = (editor) => {
            editorRef.value = editor // 记录 editor 实例，重要！
        }

        const handleChanged = debounce((editor) => {
            const updatedContent = editor.getHtml().replace(/<(h[1-6])(.*?)>(.*?)<\/\1>/g, function(match, tag, attributes, innerContent) {
                const id = innerContent.replace(/<[^>]+>/g, '');
                const newTag = `<${tag} id='${id}' ${attributes}>${innerContent}</${tag}>`;
                return newTag;
            });
            const updatedContent2 = updatedContent.replace(/<div\s+data-w-e-type="video"([^>]*)>/g, '<div data-w-e-type="video" class="relative aspect-[16/9]" $1>');
            const updatedContent3 = updatedContent2.replace(/<p><br><\/p>/, '');
            axios.patch(props.url, { content: updatedContent3 })
        }, 3000)

        return {
            editorRef,
            valueHtml,
            uploading,
            process,
            mode: 'default', // 或 'simple'
            toolbarConfig,
            editorConfig,
            handleCreated,
            handleChanged
        };
    }
}
</script>
<style>
#content h1:first-child {
    font-size: 1.8rem;
    border-left: 6px solid lightgreen;
    padding-left: 10px;
    margin-bottom: 1.5rem;
    line-height: 1;
}

#content h1:not(:first-child) {
    font-size: 1.8rem;
    margin-top: 1.5rem;
    border-left: 6px solid lightgreen;
    padding-left: 10px;
    margin-left: 2px;
    margin-bottom: 1.5rem;
    line-height: 1;
}

#content h2 {
    font-size: 1.5rem;
    margin-top: 1.5rem;
    border-left: 5px solid lightcoral;
    padding-left: 8px;
    margin-left: 4px;
    margin-bottom: 1.5rem;
    line-height: 1;
}

#content h3 {
    font-size: 1.27rem;
    margin-top: 1rem;
    border-left: 4px solid lightsalmon;
    padding-left: 8px;
    margin-left: 6px;
    margin-bottom: 1rem;
    line-height: 1;
}

#content h4 {
    font-size: 1.12rem;
    margin-top: 1rem;
    border-left: 3px solid lightskyblue;
    padding-left: 7px;
    margin-left: 8px;
    margin-bottom: 1rem;
    line-height: 1;
}

#content h5 {
    font-size: 1rem;
    margin-top: 1rem;
    border-left: 2px solid lightseagreen;
    padding-left: 6px;
    margin-left: 10px;
    margin-bottom: 1rem;
    line-height: 1;
}

#content h6 {
    font-size: 1rem;
    font-weight: 600;
}

#content p {
    font-size: 16px;
    text-indent: 2rem;
    line-height: 1.75;
}

.hljs {
    margin: 1rem;
    background: rgba(246, 246, 246, 0.75);
    color: rgb(75 85 99);
    border-radius: 0.5rem;
}

#content img {
    margin: 0 auto;
    padding: 0.5rem;
}

.w-e-textarea-video-container {
    position: relative;
    aspect-ratio: 16/9;
}

html.dark {
    --w-e-textarea-color: rgb(229 231 235);
    --w-e-textarea-border-color: #ccc;
    --w-e-textarea-slight-border-color: #e8e8e8;
    --w-e-textarea-slight-color: #d4d4d4;
    --w-e-textarea-slight-bg-color: rgb(39 39 42);
    --w-e-textarea-selected-border-color: #B4D5FF;
    --w-e-textarea-handler-bg-color: #4290f7;
    --w-e-toolbar-color: rgb(229 231 235);
    --w-e-toolbar-bg-color: rgb(24 24 27);
    --w-e-toolbar-active-color: rgb(107 114 128);
    --w-e-toolbar-active-bg-color: rgb(39 39 42);
    --w-e-toolbar-disabled-color: #999;
    --w-e-toolbar-border-color: #e8e8e8;
    --w-e-modal-button-bg-color: #fafafa;
    --w-e-modal-button-border-color: #d9d9d9;
    .w-e-bar-divider {
        background-color: rgb(63 63 70);
    }

    ::-webkit-scrollbar {
        width: 8px;
        height: 10px;
    }

    ::-webkit-scrollbar-thumb {
        background-color: lightgreen;
        border-radius: 5px;
    }

    ::-webkit-scrollbar-thumb:hover {
        background-color: #999;
    }

    ::-webkit-scrollbar-track {
        background-color: rgba(24, 24, 27);
    }

    .hljs {
        margin: 1rem;
        background: rgba(24, 24, 27, 0.75);
        color: rgb(229 231 235);
        border-radius: 0.5rem;
    }
}

:root {
    --w-e-textarea-bg-color: transparent;
}

html {
    ::-webkit-scrollbar {
        width: 8px;
        height: 10px;
    }

    ::-webkit-scrollbar-thumb {
        background-color: lightgreen;
        border-radius: 5px;
    }

    ::-webkit-scrollbar-thumb:hover {
        background-color: #999;
    }

    ::-webkit-scrollbar-track {
        background-color: rgb(209 213 219/0.5);
    }
}
</style>
