<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\DB;
use App\Models\Record;
use App\Models\Category;

class RecordController extends Controller
{
    private $category_list;
    
    // コンストラクタ
    public function __construct() {
        $list = array();
        
        // カテゴリデータ取得
        $categorys = Category::select('id','name')->get();
        foreach($categorys as $value) {
            $list[$value->id] = $value->name; 
        }
        $this->category_list = $list;
    }
    
    
    // 全日付取得
    public function getRecords(){
        $records = Record::select('date')->groupBy('date')->get();
        return $records;
    }
    
    // 詳細取得
    public function getRecordsDetail(Request $request){
        // 一旦朝食分を一日分として出力
        $records = Record::select('category')->where('date', $request->date)->where('timezone', 1)->get();
        
        $category_ids = explode("," , $records[0]->category); // array(1, 3, 4, ...);
        
        $list = array();
        foreach($this->category_list as $key => $value) {
            $result = array_search($key, $category_ids);
            if($result !== FALSE) $list[$category_ids[$result]] = $value;
        }
        
        return $list;
    }
    
    // 追加更新
    public function registRecord(Request $request) {
        //バリデーションなどが必要
        $ids = implode(",", $request->check);
        $result = Record::updateOrCreate(['date' => $request->form, 'timezone' => 1],['category' => $ids]);
        return $result;
    }
}
