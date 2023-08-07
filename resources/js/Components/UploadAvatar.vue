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
            <span v-if="avatar" class="relative">
                <img :src="avatar" alt="Uploaded Avatar" class="w-28 h-28 rounded-full border-2 border-zinc-500 dark:border-gray-100"/>
                <button class="absolute top-1 right-1 bg-red-600 text-white p-1 rounded-full hover:text-red-600 hover:bg-gray-100" @click="removeAvatar()">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path clip-rule="evenodd" d="M17 3.414a2 2 0 00-2.828 0L10 7.172 5.828 3a2 2 0 00-2.828 2.828L7.172 10 3 14.172a2 2 0 002.828 2.828L10 12.828l4.172 4.172a2 2 0 002.828-2.828L12.828 10l4.172-4.172a2 2 0 000-2.828z" fill-rule="evenodd"/>
                    </svg>
                </button>
            </span>
            <span v-else class="text-gray-900">
                <label class="w-28 h-28 flex flex-col items-center justify-center justify-items-center rounded-full border-2 border-zinc-500 dark:border-gray-100 hover:bg-gray-800 hover:bg-opacity-75 dark:hover:bg-gray-100 dark:hover:text-gray-900 dark:text-gray-100 hover:text-gray-200" for="file-upload">
                    <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 6v6m0 0v6m0-6h6m-6 0H6" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                    </svg>
                    <span class="-mt-2">{{ buttonText }}</span>
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
        avatar: {type: String},
        inputKey: {type: String},
        checkUrl: {type: String},
        uploadUrl: {type: String},
        saveUrl: {type: String},
        buttonText: {type: String, default: '上传头像'}
    },
    data() {
        return {
            avatar: this.avatar ? this.avatar : '',
            uploading: false,
            process: 0,
        }
    },
    methods: {
        onFileChange(event) {
            this.uploading = true;
            const file = event.target.files[0];
            const extension = this.getFileExtension(file.name);
            this.calculateMD5(file).then(hash => {
                axios.post(this.checkUrl, {
                    path: 'images/' + hash + '.' + extension
                }).then(res => {
                    if (res.data.code === 200) {
                        this.uploading = false;
                        this.avatar = res.data.url;
                        this.postAvatar(this.inputKey, res.data.url)
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
                            this.avatar = res.data.url;
                            this.postAvatar(this.inputKey, res.data.url)
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
                return ''; // No extension found
            }
            const extension = fileName.substr(lastDotIndex + 1).toLowerCase();
            return extension;
        },
        postAvatar(key, value) {
            axios.patch(this.saveUrl, {
                [key]: value
            })
        },
        removeAvatar() {
            this.avatar = null;
            this.postAvatar(this.inputKey, null)
        }
    }
} </script>
