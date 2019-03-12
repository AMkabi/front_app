<template>
    <div class="container">
        <h1>メニューTOP</h1>
        <div class="row">
            <div class="col-12">
                <router-link to="/recode" tag="p" class="btn btn-primary btn-clock center-block">記録</router-link>
            </div>
            <div class="col-12">
                <router-link to="/category" tag="p" class="btn btn-primary btn-clock center-block">カテゴリ</router-link>
            </div>
        </div>
        <br>
        
    </div>
</template>

<script>
    import Head from '../Mixin.js'
    export default {
        mixins: [Head],
    };
</script>