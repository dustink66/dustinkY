<template>
    <img class="post-avatar" :src="src">
</template>

<script>
export default {
    name: "Avatar",
    props: {
        src: {
            type: String,
            default: ""
        }
    }
}
</script>

<style>
:root {
    /* 图片大小 */
    --s: 240px;
    /* 边框大小 */
    --b: 8px;
    /* 边框颜色 */
    --c: #fff;
    /* 背景颜色 */
    --bg: lightgray;
    /* 默认缩放比例 */
    --f: 1;
}
.post-avatar {
    box-sizing: content-box;
    width: var(--s);
    aspect-ratio: 1;
    object-fit: contain;
    padding-top: calc(var(--s) / 7);
    cursor: pointer;
    transform: scale(var(--f));
    transition: 0.5s;
    border-radius: 0 0 999px 999px;
    --o: calc((1 / var(--f) - 1) * var(--s) / 2 - var(--b));
    outline: var(--b) solid var(--c);
    outline-offset: var(--o);
    --g: 50% / calc(100% / var(--f)) 100% no-repeat content-box;
    background: radial-gradient(
        circle closest-side,
        var(--bg) calc(99% - var(--b)),
        var(--c) calc(100% - var(--b)) 99%,
        #0000
    )
    var(--g);
    -webkit-mask: linear-gradient(#000 0 0) no-repeat 50% calc(1px - var(--o)) /
          calc(100% / var(--f) - 2 * var(--b) - 2px) 50%,
    radial-gradient(circle closest-side, #000 99%, #0000) var(--g);
    mask: linear-gradient(#000 0 0) no-repeat 50% calc(1px - var(--o)) /
          calc(100% / var(--f) - 2 * var(--b) - 2px) 50%,
    radial-gradient(circle closest-side, #000 99%, #0000) var(--g);
}
.post-avatar:hover {
    /* 缩放比例 */
    --f: 1.25;
}
</style>
