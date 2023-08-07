<template>
    <div class="font-selector">
        <div class="dropdown w-full">
            <button @click="toggleDropdown" class="dropdown-toggle text-left text-base block bg-white bg-opacity-50 w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-400 focus:ring-opacity-50 disabled:opacity-50 dark:bg-zinc-700 dark:bg-opacity-80 dark:border-zinc-400 dark:focus:border-green-500 dark:focus:ring-green-500 dark:focus:ring-opacity-50 dark:text-gray-200" :class="selectedFont">
                <span class="pl-1">{{ selectedFont ? fonts.find(font => font.value === selectedFont).name : buttonText }}</span>
            </button>

            <div v-if="showDropdown" class="dropdown-menu bg-white rounded-b-lg ring-2 ring-green-500 w-full dark:bg-zinc-900 dark:text-gray-100">
                <div
                    v-for="(font, index) in fonts"
                    :key="index"
                    @click="selectFont(font)"
                    class="dropdown-item w-full hover:text-3xl"
                    :class="font.value"
                >
                    {{ font.name }}
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        value: {
            type: String,
            default: '',
        },
        inputKey: {
            type: String
        },
        saveUrl: {
            type: String
        },
        buttonText: {
            type: String,
            default: 'Select Font'
        }
    },
    data() {
        return {
            fonts: [
                { name: '系统字体', value: 'Normal-Font'},
                { name: '马善政毛笔楷书', value: 'MaShanZheng'},
                { name: '邯郸康熙字典体内府简', value: 'HDKXZDTNFJ-GB1'},
                { name: '邯郸康熙字典体内府繁', value: 'HDKXZDTNFF-GB1'},
                { name: '龙藏体', value: 'LongCang'},
                { name: '钟齐志莽行书', value: 'ZhiMangXing'},
                { name: '站酷快乐体', value: 'ZCOOL-KuaiLe'},
                { name: '站酷庆科黄油体', value: 'ZCOOL-QingKe-HuangYou'},
                { name: '站酷小薇体', value: 'ZCOOL-XiaoWei'},
                { name: '站酷酷黑体', value: 'ZCOOL-KuHei'},
                { name: '站酷文艺体', value: 'ZCOOL-WenYi'},
                { name: '站酷仓耳渔阳体', value: 'ZCOOL-TsangerYuYang'},
                { name: 'ZCOOL Addict Italic 01', value: 'ZCOOL-Addict-Italic-01'},
                { name: 'ZCOOL Addict Italic 02', value: 'ZCOOL-Addict-Italic-02'},
                { name: 'Pacifico', value: 'Pacifico'},
                { name: 'Pushster', value: 'Pushster'},
                { name: 'Vujahday Script', value: 'VujahdayScript'},
                { name: 'Oooh Baby', value: 'OoohBaby'},
                { name: 'Licorice', value: 'Licorice'},
                { name: 'Lobster', value: 'Lobster'},
                { name: 'Dancing Script', value: 'DancingScript'},
                { name: 'MoonDance', value: 'MoonDance'}
            ],
            selectedFont: this.value,
            showDropdown: false,
        };
    },
    methods: {
        selectFont(font) {
            this.selectedFont = font.value;
            axios.patch(this.saveUrl, {
                [this.inputKey]: font.value,
            })
            this.toggleDropdown();
            setTimeout(() => {
                window.location.reload();
            }, 3000);
        },
        toggleDropdown() {
            this.showDropdown = !this.showDropdown;
        },
    },
};
</script>

<style>
.font-selector {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 10px;
}

.dropdown {
    position: relative;
}

.dropdown-toggle {
    cursor: pointer;
    padding: 8px;
    border-radius: 4px;
    border: 1px solid rgb(209 213 219);
}

.dropdown-menu {
    max-height: 200px; /* Set a maximum height for the dropdown menu */
    overflow-y: auto; /* Allow the dropdown to be scrollable */
    position: absolute;
    top: 100%;
    left: 0;
    z-index: 1;
}

.dropdown-item {
    cursor: pointer;
    padding: 8px;
    border-bottom: 1px solid #ccc;
    transition: background-color 0.2s;
}

.dropdown-item:last-child {
    border-bottom: none;
}

</style>
