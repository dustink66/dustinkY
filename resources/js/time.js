// 封装自定义指令
export default {
    mounted(el, binding) {
        const { value } = binding
        const releaseTime = +new Date(value);
        const currentTime = +new Date();
        const diffTime = (currentTime - releaseTime) / 1000;
        const second = 1, minute = 60, hour = minute * 60, day = hour * 24, month = day * 30, year = month * 12;
        function addZero(num) {
            return num < 10 ? '0' + num : num;
        }
        function formatDateTime(date) {
            const time = new Date(Date.parse(date));
            time.setTime(time.setHours(time.getHours()));
            const Y = time.getFullYear() + '-';
            const M = addZero(time.getMonth() + 1) + '-';
            const D = addZero(time.getDate()) + ' ';
            const h = addZero(time.getHours()) + ':';
            const m = addZero(time.getMinutes()) + ':';
            const s = addZero(time.getSeconds());
            return Y + M + D + h + m + s;
        }

        el.innerHTML = ''
        el.setAttribute('datetime', value)
        el.setAttribute('pubdate', value);
        el.setAttribute('title', value);
        if(diffTime < 0){
            console.log("传入时间数据错误！");
            return
        }
        switch(true){
            case diffTime < second * 5:
                el.innerHTML  = "刚刚";
                break;
            case diffTime < minute:
                el.innerHTML += `${Math.round(diffTime)}秒前`;
                break;
            case diffTime < hour:
                el.innerHTML +=  `${Math.round(diffTime / minute)}分钟前`;
                break;
            case diffTime < day:
                el.innerHTML += `${Math.round(diffTime / hour)}小时前`;
                break;
            case diffTime < month:
                el.innerHTML += `${Math.round(diffTime / day)}天前`;
                break;
            case diffTime < year:
                el.innerHTML += `${Math.round(diffTime / month)}个月前`;
                break;
            default:
                el.innerHTML = formatDateTime(value);
        }
    }
}

