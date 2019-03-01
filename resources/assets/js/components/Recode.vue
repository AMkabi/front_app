<template>
    <div class="container">
        <h1>記録一覧</h1>
        <div class="row">
            <div class="col-12">
                <br>
                <router-link to="/" class="btn btn-primary rounded-pill">戻る</router-link><br>
                <br>
            </div>
            <div class="col-12" v-for="(record, index) in records">
                <p>
                    <button class="btn btn-success" type="button" v-on:click="showDetail(record.date, index)" >{{ record.date }}</button>
                    <br>
                    <div class="col-6">
                        <span v-show="editing[record.date]">
                            <table class="table" style="table-layout:fixed;">
                                <thead>
                                    <tr>
                                        <th style="width:200px;">この日に食べたもの</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="value in records_detail[record.date]">
                                        <td>{{ value }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </span>
                    </div>
                </p>
            </div>
            <div class="col-12">
                <p>
                    <button v-on:click="addRecord()" type="button" class="btn btn-primary rounded-circle p-0" style="width:2rem;height:2rem;">記録</button>
                </p>
                <div class="col-8">
                    <span v-show="add_flg">
                        <p><label>日付:</label><input type="text" ref="input" placeholder="yyyy-mm-dd" v-model="form"></p>
                        <p v-for="category in categorys">
                            <input type="checkbox" ref="checkbox" :value="category.id" v-model="checklist">{{ category.name }}
                        </p>
                        <button class="btn btn-success" type="button" v-on:click="registRecord()" >登録</button>
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
                editing: {},
                categorys: [],
                records: [],
                records_detail: [],
                add_flg: false,
                checklist: [],
                form: [],
                result: [],
            }
        },
        
        // 初回読込
        created() {
            this.allCategorys()
            this.fetchRecords()
        },
        
        methods: {
            // 初期値セット
            allCategorys() {
                this.$http.get('/api/getCategorys')
                .then(res => {
                    this.categorys = res.data
                })
            },
            
            // 表示
            fetchRecords(){
                this.$http.get('/api/getRecords')
                .then(res => {
                    this.records = res.data
                })
            },
            
            // 詳細表示
            showDetail(date, index) {
                if(this.editing[date]) {
                    this.editing[date] = false
                } else {
                    var param = {
                        'date': date
                    }
                    this.$http.post('/api/getRecordsDetail', param)
                    .then(res => {
                        this.records_detail[date] = res.data
                        this.$set(this.editing, date, true)
                    })
                }
            },
            
            // 追加
            addRecord() {
                this.add_flg = true
            },
            
            registRecord() {
                var param = {
                    'form': this.form,
                    'check': this.checklist
                    }
                this.$http.post('/api/registRecord', param)
                .then(res => {
                    this.result = res.data
                    this.add_flg = false
                    this.fetchRecords()
                })
            },
        },
    }
</script>
