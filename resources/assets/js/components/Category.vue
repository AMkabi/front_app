<template>
    <div class="container">
        <h1>カテゴリ管理</h1>
        <div class="row">
            <div class="col-12">
                <br>
                <router-link to="/" class="btn btn-primary rounded-pill">戻る</router-link><br>
                <br>
            </div>
            <div class="col-6">
                <table class="table" style="table-layout:fixed;">
                    <thead>
                        <tr>
                            <th style="width:200px;">ID</th>
                            <th style="width:200px;">カテゴリ名</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(category, index) in categorys" v-bind:key="category.id">
                            <td>{{ category.id }}</td>
                            <td>
                                <span v-show="!editing[category.id]" v-on:click="showInput(category.id, index)">
                                    {{ category.name }}
                                </span>
                                <input v-show="editing[category.id]" type="text"
                                       ref="input" :value="category.name"
                                       @blur="hideInput(category.id)" @keydown.enter="changeCategory(category.id , $event.target.value)">
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-6">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="カテゴリを入力してください" v-model="new_category">
                    <span class="input-group-btn">
                        <button class="btn btn-success" type="button" v-on:click="addCategory" >登録</button>
                    </span>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Head from '../Mixin.js'
    export default {
        mixins: [Head],
        data() {
            return {
                new_category: '',
                editing: {},
                categorys: []
            }
        },
        
        // 初回読込
        created() {
            this.fetchCategorys()
        },
        
        methods: {
            // 表示
            fetchCategorys(){
                this.$http.get('/api/getCategorys')
                .then(res => {
                    this.categorys = res.data
                })
            },
            
            // 追加
            addCategory() {
                var param = {
                    'name' : this.new_category
                };
                this.$http.post('/api/addCategorys', param)
                .then(res => {
                    this.categorys = res.data
                    this.new_category = ''
                })
            },
            
            // 追加表示
            showInput(id, index) {
                this.$set(this.editing, id, true)
                this.$nextTick(() => {
                    this.$refs.input[index].focus()
                })
            },
            
            // 制御
            hideInput(id) {
                this.editing[id] = false
            },
            
            // 更新
            changeCategory(id, value) {
                this.hideInput(id)
                var param = {
                    'id': id,
                    'name': value
                }
                 this.$http.post('/api/updateCategorys', param)
                 .then(res => {
                     this.categorys = res.data
                     this.new_category = ''
                 })
            },
        },
    };
</script>
