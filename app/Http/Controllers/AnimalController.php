<?php

namespace App\Http\Controllers;

// 宣告使用Animal的model。
use App\Models\Animal;
// 宣告使用Request的功能。可以接收前端表單資料，並且傳送到後端。
use Illuminate\Http\Request;
// 下面這句不知道是要宣告什麼後期再來研究。
use Illuminate\Http\Response;
// 宣告使用Cache的功能。可以使用快取的功能。
use Illuminate\Support\Facades\Cache;

class AnimalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // 獲取所有資料的function。
    public function index(Request $request)
    {
        // 使用前台網址當快取資料的寫法
        $url=$request->url();
        // 取用前台網址的資料，並且把資料儲存在$url裡面。
        $queryParams=$request->query();
        // 取用前台所有資料$request下面的query資料，並且把資料儲存在$queryParams裡面。
        ksort($queryParams);
        // 每個人所請求的query參數順序可能不同，使用第一個參數一個英文字母排序。
        $queryString=http_build_query($queryParams);
        // 把$queryParams的資料，並且把資料儲存在$queryString裡面。
        $fullurl="{$url}?{$queryString}";

        // 使用laravel的快取方法檢查是否有快取紀錄。
        if(Cache::has($fullurl)){
            // 如果有快取紀錄，就回傳快取紀錄。
            return Cache::get($fullurl);
        }
        
        // 取用前台所有資料$request下面的limit資料，如果沒有就是10。
        $limit = $request->limit ?? 10;

        $query=Animal::query();
        // 創建一個query的物件，並且使用Animal的model後面的query方法。可以在後面使用sql語法。
        
        // 如果前端書入資料有sort的話就執行下面的程式碼，功能是依照前端的資料進行排序。
        if(isset($request->sorts)){
            $sorts=explode(',',$request->sorts);
            foreach($sorts as $key => $sort){
                list($key,$value)=explode(':',$sort);
                $query->orderBy($key,$value);
            }
        }else{
            // 如果沒有上述條件，就依照id的大小進行排序。
            $query->orderBy('id','asc');
        }

        if(isset($request->filters)){
            $filters =explode(',',$request->filters);
            // explode是把字串變成陣列，$request->filters是前端傳來的資料，並且用,分開。
            foreach($filters as $key => $filter){
                list($key,$value)=explode(':',$filter);
                // list是把陣列的值，分別指定給變數，$key是欄位名稱，$value是欄位的值，後面的export是把字串變成陣列，$filter是前端傳來的資料，並且用:分開。
                // list功能是把陣列的值，分別給上另外一個代名詞，例如list($a,$b)=[1,2]，$a=1,$b=2。
                $query->where($key,'like',"%$value%");
                // 使用sql語法where，$key是欄位名稱，$value是欄位的值，%$value%是模糊搜尋，%是任意字元。
            }
        }



        // anumals = Model Animal的所有資料，並且依照id的大小排序，並且分頁，並且把前端的資料傳送到後端。
        // asc是由小到大排序，desc是由大到小排序。
        // $animals=Animal::orderBy('id', 'asc')

        $animals=$query
        // 分配每個頁面顯示的資料依照$limit的數值，進行分頁。
        ->paginate($limit)
        // 這是用來保存前端傳進來的資料，並且將資料儲存在url中。
        ->appends($request->query());
        return Cache::remember($fullurl,60,function() use($animals){
            return response($animals, Response::HTTP_OK);
        });

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     * 新建動物的功能。輸入動物進資料庫的function。
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 宣告一個物件是取用Animal的所有資料，並且存在$animal裡面。
        $animal= Animal::create($request->all());
        // 更新物件$animal的資料。
        $animal= $animal->refresh();
        // 回傳$animal的資料，並且回傳HTTP_CREATED的狀態碼。
        return response($animal, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Animal  $animal
     * @return \Illuminate\Http\Response
     */
    // show(資料庫名稱，資料庫的ID)
    public function show(Animal $animal)
    {
        //顯示單獨動物的資料。
        return response($animal, Response::HTTP_OK);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Animal  $animal
     * @return \Illuminate\Http\Response
     */
    public function edit(Animal $animal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Animal  $animal
     * @return \Illuminate\Http\Response
     */
                            // 前端傳入的資料，後面宣告資料庫宣告成的物件，後面指的是要修改哪一ID的資料。
    public function update(Request $request, Animal $animal)
    {
        //因為$animal是物件，所以可以使用update的方法，並且把前端傳入的資料全部更新到資料庫，後面更新全部前端傳來的資料。
        $animal->update($request->all());
        // 回傳$animal的資料，並且回傳HTTP_OK的狀態碼。
        return response($animal, Response::HTTP_OK);

        /**
         * 有兩種方式可以更新資料庫。
         * put是全部更新，patch是部分更新。
         */
    }

    /**
     * Remove the specified resource from storage.
     * 刪除動物的功能。刪除資料庫的動物。
     * @param  \App\Models\Animal  $animal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Animal $animal)
    {
        // 刪除$animal的資料。
        $animal->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
