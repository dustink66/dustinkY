@props(['label', 'attribute', 'value'])

<div class="pt-3 sm:flex text-base" x-data="{
    {{ $attribute }}: '{{ $value }}',
    patchSuccess: false,
    patchFail: false,
    message:'',
    hideSuccessMessage() {
        this.patchSuccess = false;
    },
    hideFailMessage() {
        this.patchFail = false;
    },
    init() {
        this.$watch('{{ $attribute }}', (value) => {
            axios.patch('{{ route('dashboard.update') }}', { {{ $attribute }}: value})
            .then(response => {
                    if (response.status === 200) {
                        this.message = '{{$label}} ' + response.data.message;
                        this.patchSuccess = true;
                        this.initTimer();
                    } else {
                        this.message = '{{$label}} ' + response.data.message;
                        this.patchFail = true;
                        this.initTimer();
                    }
                })
                .catch(error => {
                    this.message = '{{$label}} ' + error.response.data.message;
                    this.patchFail = true;
                    this.initTimer();
                });
        });
    },
    initTimer() {
        setTimeout(() => {
            this.hideSuccessMessage();
            this.hideFailMessage();
        }, 5000);
    }
}">
    <dt class="font-medium  sm:w-64 sm:flex-none sm:pr-6">{{ $label }}</dt>
    <dd class="mt-1 flex justify-between gap-x-6 sm:mt-0 sm:flex-auto">
        <textarea type="text" x-model.debounce.3000ms="{{ $attribute }}"
                  class="block bg-white bg-opacity-50 w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-400 focus:ring-opacity-50 disabled:opacity-50 dark:bg-zinc-700 dark:bg-opacity-80 dark:border-zinc-400 dark:focus:border-green-500 dark:focus:ring-green-500 dark:focus:ring-opacity-50 dark:text-gray-200"></textarea>
    </dd>
    <div x-show="patchSuccess" aria-live="assertive" class="pointer-events-none fixed inset-0 flex items-end px-4 py-6 sm:items-start sm:p-6 z-40">
        <div class="flex w-full flex-col items-center space-y-4 sm:items-end">
            <div class="p-4 pointer-events-auto border-l-4 shadow-md min-w-[240px] bg-green-50 border-green-400">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3 break-words">
                        <h3 class="text-sm font-medium text-green-800" x-text="message">
                        </h3>
                    </div>

                    <div class="ml-auto pl-3">
                        <div class="-mx-1.5 -my-1.5">
                            <button type="button" x-on:click="hideSuccessMessage()" class="inline-flex rounded-md p-1.5 focus:outline-none focus:ring-2 focus:ring-offset-2 bg-green-50 text-green-500 hover:bg-green-100 focus:ring-offset-green-50 focus:ring-green-600">
                                <span class="sr-only">Dismiss Toast</span>
                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div x-show="patchFail" aria-live="assertive" class="pointer-events-none fixed inset-0 flex items-end px-4 py-6 sm:items-start sm:p-6 z-40">
        <div class="flex w-full flex-col items-center space-y-4 sm:items-end">
            <div class="p-4 pointer-events-auto border-l-4 shadow-md min-w-[240px] bg-red-50 border-red-400">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3 break-words">
                        <h3 class="text-sm font-medium text-red-800" x-text="message">
                        </h3>
                    </div>

                    <div class="ml-auto pl-3">
                        <div class="-mx-1.5 -my-1.5">
                            <button type="button" x-on:click="hideFailMessage()" class="inline-flex rounded-md p-1.5 focus:outline-none focus:ring-2 focus:ring-offset-2 bg-red-50 text-red-500 hover:bg-red-100 focus:ring-offset-red-50 focus:ring-red-600">
                                <span class="sr-only">Dismiss Toast</span>
                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
