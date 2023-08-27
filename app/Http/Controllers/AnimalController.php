<?php

namespace App\Http\Controllers;

// 宣告使用Animal的model。
use App\Models\Animal;
// 宣告使用Request的功能。可以接收前端表單資料，並且傳送到後端。
use Illuminate\Http\Request;
// 下面這句不知道是要宣告什麼後期再來研究。
use Illuminate\Http\Response;

class AnimalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $animals= Animal::get();
        //這裡是導到index.blade.php的功能。
        return view('animal', compact('animals'));
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
