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
    <div class="flex flex-col w-full h-full">
        <div class="flex flex-row flex-wrap">
            <ul role="list" class="grid grid-cols-2 gap-x-4 gap-y-8 sm:grid-cols-3 sm:gap-x-6 lg:grid-cols-3 xl:gap-x-8">
                <li v-for="(image, index) in images" :key="index" class="relative" @mouseenter="showDeleteButton(index)" @mouseleave="hideDeleteButton(index)">
                    <div class="group aspect-h-7 aspect-w-10 block h-full w-full overflow-hidden rounded-lg bg-gray-100 focus-within:ring-2 focus-within:ring-green-500 focus-within:ring-offset-2 focus-within:ring-offset-gray-100">
                        <img :src="image.url" alt="" class="pointer-events-none object-cover group-hover:opacity-75 h-full">
                    </div>
                    <button
                        v-show="image.showDeleteButton"
                        @click="removeImages(index)"
                        class="absolute top-2 right-2 p-2 bg-red-500 rounded-full"
                    >
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"
                            ></path>
                        </svg>
                    </button>
                </li>
                <li class="relative">
                    <div class="group aspect-h-7 aspect-w-10 h-full block w-full">
                        <label class="h-40 min-w-[266px] flex flex-col items-center justify-center justify-items-center rounded border-2 border-zinc-500 dark:border-gray-100 hover:bg-gray-800 hover:bg-opacity-75 dark:hover:bg-gray-100 dark:hover:text-gray-900 dark:text-gray-100 hover:text-gray-200" for="file-upload">
                            <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 6v6m0 0v6m0-6h6m-6 0H6" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                            </svg>
                            <span>{{ buttonText }}</span>
                            <input id="file-upload" class="sr-only" multiple name="file-upload" type="file" @change="onFileChange"/>
                        </label>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
import SparkMD5 from "spark-md5";

export default {
    props: {
        imageList: {
            type: String
        },
        inputKey: {
            type: String
        },
        checkUrl: {
            type: String
        },
        uploadUrl: {
            type: String
        },
        saveUrl: {
            type: String
        },
        buttonText: {
            type: String,
            default: 'Drag your files here'
        }
    },
    data() {
        return {
            images: this.imageList ? JSON.parse(this.imageList) : [],
            uploading: false,
            process: 0
        }
    },
    methods: {
        onFileChange(event) {
            const files = event.target.files;
            for (let i = 0; i < files.length; i++) {
                this.uploading = true;
                const file = files[i];
                const extension = this.getFileExtension(file.name);
                this.calculateMD5(file).then((hash) => {
                    axios.post(this.checkUrl, {
                        path: 'images/' + hash + '.' + extension
                    }).then(res => {
                        if (res.data.code === 200) {
                            this.uploading = false;
                            this.images.push({
                                url: res.data.url
                            });
                            this.postImages(this.inputKey, JSON.stringify(this.images));
                        } else {
                            let params = new FormData();
                            params.append('image', file, file.name);
                            axios.post(this.uploadUrl, params, {
                                headers: {
                                    'Content-Type': 'multipart/form-data'
                                },
                                onUploadProgress: (progressEvent) => {
                                    this.process = parseInt(Math.round((progressEvent.loaded * 100) / progressEvent.total));
                                }
                            }).then(res => {
                                this.uploading = false;
                                this.images.push({
                                    url: res.data.url
                                });
                                this.postImages(this.inputKey, JSON.stringify(this.images));
                            }).catch(err => {
                                this.uploading = false;
                                console.log(err);
                            })
                        }
                    }).catch(err => {
                        this.uploading = false;
                        console.log(err);
                    })
                });
            }
        },
        calculateMD5(file) {
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
        },
        getFileExtension(fileName) {
            const lastDotIndex = fileName.lastIndexOf('.');
            if (lastDotIndex === -1) {
                return ''; // No extension found
            }
            return fileName.substr(lastDotIndex + 1).toLowerCase();
        },
        postImages(key, value) {
            axios.patch(this.saveUrl, {
                [key]: value,
            })
        },
        removeImages(index) {
            this.images.splice(index, 1);
            this.postImages(this.inputKey, JSON.stringify(this.images));
        },
        showDeleteButton(index) {
            this.images[index].showDeleteButton = true;
        },
        hideDeleteButton(index) {
            this.images[index].showDeleteButton = false;
        },
    }
}
</script>
