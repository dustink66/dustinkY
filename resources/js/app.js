import "./bootstrap";
import "../css/app.css";
import "@protonemedia/laravel-splade/dist/style.css";
import tool from "./utils/tool";

import { createApp } from "vue/dist/vue.esm-bundler.js";
import { renderSpladeApp, SpladePlugin } from "@protonemedia/laravel-splade";
import WangEditor from "./Components/WangEditor.vue";
import ThemeSwitch from "./Components/ThemeSwitch.vue";
import UploadMultipleImage from "./Components/UploadMultipleImage.vue";
import UploadImage from "./Components/UploadImage.vue";
import TagSearch from "./Components/TagSearch.vue";
import HomeGlide from "./Components/HomeGlide.vue";
import Motto from "./Components/Motto.vue";
import Comment from "./Components/Comment.vue";
import Search from "./Components/Search.vue";
import OnThisPage from "./Components/OnThisPage.vue";
import IncredibleTitle from "./Components/IncredibleTitle.vue";
import Avatar from "./Components/Avatar.vue";
import SvgLogo from "./Components/SvgLogo.vue";
import Switch from "./Components/Switch.vue";
import Footer from "./Components/Footer.vue";
import UploadVideo from "./Components/UploadVideo.vue";
import HomeCalendar from "./Components/HomeCalendar.vue";
import TagCloud from "./Components/TagCloud.vue";
import FontSelect from "./Components/FontSelect.vue";
import Weather from "./Components/Weather.vue";
import Empty from "./Components/Lotties/Empty.vue";
import time from './time.js'


const el = document.getElementById("app");

createApp({
    render: renderSpladeApp({ el })
})
    .use(SpladePlugin, {
        "max_keep_alive": 10,
        "transform_anchors": false,
        "progress_bar": true
    })
    .use(tool)
    .component('WangEditor', WangEditor)
    .component('ThemeSwitch', ThemeSwitch)
    .component('UploadMultipleImage', UploadMultipleImage)
    .component('UploadImage', UploadImage)
    .component('TagSearch', TagSearch)
    .component('HomeGlide', HomeGlide)
    .component('Motto', Motto)
    .component('Comment', Comment)
    .component('Search', Search)
    .component('OnThisPage', OnThisPage)
    .component('IncredibleTitle', IncredibleTitle)
    .component('Avatar', Avatar)
    .component('SvgLogo', SvgLogo)
    .component('Switch', Switch)
    .component('Footer', Footer)
    .component('UploadVideo', UploadVideo)
    .component('HomeCalendar', HomeCalendar)
    .component('TagCloud', TagCloud)
    .component('FontSelect', FontSelect)
    .component('Weather', Weather)
    .component('Empty', Empty)
    .directive('time', time)
    .mount(el);
