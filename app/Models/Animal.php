<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Animal extends Model
{
    // 軟刪除功能。
    use SoftDeletes;
    use HasFactory;
    /**
     *  可以被批量寫入的屬性。
     * @var array
     */
    protected $fillable = [
        // 限制那些數值可以被批量寫入。
        'type_id',
        'name',
        'birthday',
        'area',
        'fix',
        'description',
        'persinality',
        'user_id',//不建議與允許批量寫入，將在後續身分驗證章節修改這邊的設定。
    ];
}
