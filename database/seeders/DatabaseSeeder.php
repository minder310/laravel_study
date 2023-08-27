<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Animal;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // 關閉外建檢查。
        Schema::disableForeignKeyConstraints();//關閉外鍵檢查。
        // 清空資料庫。
        Animal::truncate();
        User::truncate();

        // 創建假資料。
        User::factory(5)->create();
        Animal::factory(10000)->create();
    }
}
