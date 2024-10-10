<template>
    <div>
        <HCalendar
            backgroundText
            completion
            class-name="select-mode"
            :lunar="lunar"
            language="cn"
            style="width: 100%;"
            :select-date="selectModeDate"
            @selectYear="selectYear"
            @selectMonth="selectMonth"
            @next="next"
            @prev="prev"
            @onSelect="onSelect"
        />
    </div>
    <div v-if="postsTotal > 0" class="mx-2">
        <div v-for="post in selectDateList" :key="post.id" class="rounded-xl my-2 text-green-800 dark:text-gray-100 px-2 py-1 bg-opacity-50 bg-green-100">
            <Link :href="'/posts/' + post.slug" class="text-lg hover:text-green-500">{{ post.title }}</Link>
        </div>
    </div>
    <div class="dark:text-gray-100 text-center pb-3">
        <Link :href="'/timeline/' + selectY + selectM" class="text-lg hover:text-green-500">{{ text }}</Link>
    </div>
</template>
<script>
import { ref } from 'vue'
import axios from 'axios'
import HCalendar from 'mpvue-calendar'
import lunar from 'mpvue-calendar/dist/lunar'

export default {
    components: {
        HCalendar,
    },
    props: {
        text: {
            type: String,
            default: 'View articles published this month'
        },
    },
    setup() {
        const selectY = ref(new Date().getFullYear())
        const selectM = ref(new Date().getMonth() + 1)
        const selectD = ref(new Date().getDate())
        const selectDateList = ref([])
        const postsTotal = ref(0)
        const selectModeDate = ref(selectY.value + '-' + selectM.value + '-' + selectD.value)

        getPostsByDate(selectY.value + '-' + selectM.value + '-' + selectD.value)

        function selectYear(y, m) {
            selectY.value = y
            selectM.value = m
            selectModeDate.value = y + '-' + m + '-' + selectD.value
        }

        function selectMonth(y, m) {
            selectY.value = y
            selectM.value = m
            selectModeDate.value = y + '-' + m + '-' + selectD.value
        }

        function next(y, m) {
            selectY.value = y
            selectM.value = m
            selectModeDate.value = y + '-' + m + '-' + selectD.value
            getPostsByDate(selectModeDate.value)
        }

        function prev(y, m) {
            selectY.value = y
            selectM.value = m
            selectModeDate.value = y + '-' + m + '-' + selectD.value
            getPostsByDate(selectModeDate.value)
        }

        function getPostsByDate(selectDate) {
            axios.get('/getPostsByDate/' + selectDate).then(response => {
                selectDateList.value = response.data.results;
                postsTotal.value = response.data.total;
                selectModeDate.value = selectDate
            })
        }

        function onSelect(selectDate) {
            selectY.value = selectDate.split('-')[0]
            selectM.value = selectDate.split('-')[1]
            selectD.value = selectDate.split('-')[2]
            selectModeDate.value = selectDate
            getPostsByDate(selectDate)
        }

        return {
            lunar,
            next,
            prev,
            selectMonth,
            selectYear,
            onSelect,
            selectY,
            selectM,
            selectD,
            selectDateList,
            postsTotal,
            selectModeDate,
        }
    }
}
</script>

<style lang="less" >
.mpvue-calendar {
    border-radius: 1rem;
    .vc-calendar-tools {
        margin: auto;
        width: 100%;
        background: transparent;
        .vc-calendar-picker {
            border-radius: 1rem;
        }
        .vc-calendar-tools-container{
            color: #000000;
            border-top: 0px solid #000000;
            .vc-calendar-info {
                color: #000000;
                .vc-calendar-year {
                    color: #000000;
                    font-size: 18pt;
                }
                .vc-calendar-month {
                    color: #000000;
                    font-size: 18pt;
                }
            }
        }
        .vc-calendar-week-head {
            color: #000000;
            .vc-calendar-week-head-container {
                color: #000000;
                .vc-calendar-week-item {
                    color: #000000;
                }
            }
        }
    }
    .vc-calendar-timetable {
        background: transparent;
    }
    .vc-calendar-timetable .vc-calendar-timetable-wrap .vc-calendar-body .vc-calendar-row .vc-calendar-day {
        width: 53px;
        font-size: 16pt;
        color: #000000;
    }
    .vc-calendar-timetable .vc-calendar-timetable-wrap .vc-calendar-body .vc-calendar-row .vc-calendar-day.vc-day-selected:before {
        background: lightgreen;
        border-radius: 0.5rem;
    }
    .vc-calendar-timetable .vc-calendar-timetable-wrap .vc-calendar-body .vc-calendar-row .vc-calendar-day .vc-calendar-almanac {
        display: block;
        position: absolute;
        bottom: 4%;
        font-size: 8px;
        width: 100%;
        text-align: center;
    }
    .vc-calendar-timetable .vc-calendar-timetable-wrap .vc-calendar-body .vc-calendar-content .vc-calendar-month-background-text {
        position: absolute;
        top: 50%;
        text-align: center;
        width: 100%;
        font-size: 200px;
        transform: translateY(-50%);
        font-weight: 900;
        color: #FFFFFF;
    }
}
html.dark {
    .mpvue-calendar {
        .vc-calendar-tools {
            .vc-calendar-tools-container{
                color: #FFFFFF;
                .vc-calendar-info {
                    color: #FFFFFF;
                    .vc-calendar-year {
                        color: #FFFFFF;
                    }
                    .vc-calendar-month {
                        color: #FFFFFF;
                    }
                }
            }
            .vc-calendar-week-head {
                color: #FFFFFF;
                .vc-calendar-week-head-container {
                    color: #FFFFFF;
                    .vc-calendar-week-item {
                        color: #FFFFFF;
                    }
                }
            }
        }
        .vc-calendar-timetable .vc-calendar-timetable-wrap .vc-calendar-body .vc-calendar-row .vc-calendar-day {
            color: #FFFFFF;
        }
        .vc-calendar-timetable .vc-calendar-timetable-wrap .vc-calendar-body .vc-calendar-row .vc-calendar-day.vc-day-selected:before {
            background: lightgreen;
        }
        .vc-calendar-timetable .vc-calendar-timetable-wrap .vc-calendar-body .vc-calendar-row .vc-calendar-day .vc-calendar-almanac {
            color: #FFFFFF;
        }
        .vc-calendar-timetable .vc-calendar-timetable-wrap .vc-calendar-body .vc-calendar-content .vc-calendar-month-background-text {
            color: rgba(skyblue, 0.5);
        }
        .vc-calendar-timetable .vc-calendar-timetable-wrap .vc-calendar-body .vc-calendar-row .vc-calendar-day.vc-calendar-disabled .vc-calendar-day-container .vc-calendar-almanac, .vc-calendar-timetable .vc-calendar-timetable-wrap .vc-calendar-body .vc-calendar-row .vc-calendar-day.vc-calendar-disabled .vc-calendar-day-container .vc-calendar-date {
            color: rgb(55 65 81);
        }
    }
}
</style>
