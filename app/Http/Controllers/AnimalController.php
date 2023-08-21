<?php

namespace App\Http\Controllers;

use App\Models\Animal;
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
        //
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
        //
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
    public function update(Request $request, Animal $animal)
    {
        //
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
