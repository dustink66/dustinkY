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
    <div class="flex flex-col h-full">
        <div class="flex flex-row flex-wrap">
            <span v-if="imageUrl" class="group relative" :class="isAvatar ? 'w-40 h-40 hover:rounded-full rounded-full bg-white bg-opacity-50' : 'w-64 h-full hover:rounded-lg rounded-lg bg-white bg-opacity-50'" @mouseover="showButtons = true" @mouseout="showButtons = false">
                <img :src="imageUrl" alt="Uploaded image" class="p-2 pointer-events-none object-cover group-hover:opacity-50" :class="isAvatar ? 'w-40 h-40 rounded-full' : 'w-64 h-full rounded-lg'"/>
                <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 flex" v-show="showButtons">
                    <label class="text-green-500 px-3" for="change-upload">
                        <span class="antd icon-edit text-2xl bg-black rounded-full p-2 bg-opacity-75 hover:bg-green-500 hover:text-gray-200"></span>
                        <input id="change-upload" class="sr-only" name="change-upload" type="file" @change="onFileChange"/>
                    </label>
                    <label class="text-red-500 px-3" @click="removeImage()">
                        <span class="antd icon-delete text-2xl bg-black rounded-full p-2 bg-opacity-75 hover:bg-red-500 hover:text-gray-200"></span>
                    </label>
                </div>
            </span>
            <span v-else>
                <label class="h-40 flex flex-col items-center justify-center justify-items-center border-2 border-zinc-500 dark:border-gray-100 hover:bg-gray-800 hover:bg-opacity-75 dark:hover:bg-gray-100 dark:hover:text-gray-900 dark:text-gray-100 hover:text-gray-200" :class="isAvatar ? 'w-40 rounded-full' : 'w-64 rounded-lg'" for="file-upload">
                    <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 6v6m0 0v6m0-6h6m-6 0H6" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                    </svg>
                    <span>{{ buttonText }}</span>
                    <input id="file-upload" class="sr-only" name="file-upload" type="file" @change="onFileChange"/>
                </label>
            </span>
        </div>
    </div>
</template>
<script>
import SparkMD5 from "spark-md5";

export default {
    props: {
        isAvatar: {type: Boolean, default: false},
        imageUrl: {type: String},
        inputKey: {type: String},
        checkUrl: {type: String},
        uploadUrl: {type: String},
        saveUrl: {type: String},
        buttonText: {type: String, default: 'Drag your file here'}
    },
    data() {
        return {
            imageUrl: this.imageUrl ? this.imageUrl : '',
            uploading: false,
            process: 0,
            showButtons: false,
        }
    },
    methods: {
        onFileChange(event) {
            this.uploading = true;
            const file = event.target.files[0];
            const extension = this.getFileExtension(file.name);
            this.calculateMD5(file).then((hash) => {
                axios.post(this.checkUrl, {
                    path: 'images/' + hash + '.' + extension,
                }).then(res => {
                    if (res.data.code === 200) {
                        this.uploading = false;
                        this.imageUrl = res.data.url;
                        this.postImage(this.inputKey, res.data.url);
                    } else {
                        let params = new FormData();
                        params.append('image', file, file.name);
                        axios.post(this.uploadUrl, params, {
                            headers: {'Content-Type': 'multipart/form-data'},
                            onUploadProgress: (progressEvent) => {
                                this.process = Math.round((progressEvent.loaded * 100) / progressEvent.total);
                            }
                        }).then(res => {
                            this.uploading = false;
                            this.imageUrl = res.data.url;
                            this.postImage(this.inputKey, res.data.url);
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
                return '';
            }
            return fileName.substr(lastDotIndex + 1).toLowerCase();
        },
        postImage(key, value) {
            axios.patch(this.saveUrl, {
                [key]: value,
            })
        },
        removeImage() {
            this.imageUrl = null;
            axios.patch(this.saveUrl, {
                [this.inputKey]: null,
            })
        }
    }
} </script>
