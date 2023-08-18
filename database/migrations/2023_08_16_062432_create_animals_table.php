<?php
// 新建資料庫表單，並且設定欄位。
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 建立資歷表，並且設定欄位。
     * 可以做版控，如果有人不小心把資料表刪掉，可以用migrate:refresh來重新建立資料表。
     * @return void
     */
    public function up()
    {
        Schema::create('animals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('type_id')->nullable()->comment('動物類型');
            // unsignedBigInteger:這是宣告欄位型態。這裡的nullable()是指可以為空值，comment()是指定註解。
            $table->string('name')->comment('動物名稱');
            $table->date('birthday')->nullable()->comment('生日');
            $table->string('area')->nullable()->comment('所在地');
            $table->boolean('fix')->default(false)->comment('是否絕育');
            $table->text('descripiton')->nullable()->comment('簡單描述');
            $table->text('personality')->nullable()->comment('個性');
            $table->unsignedBigInteger('user_id')->comment('使用者ID');
            $table->timestamps();
            // 紀錄時間戳記，會自動產生created_at和updated_at兩個欄位。
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('animals');
    }
};
