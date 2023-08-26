<?php
// 宣告一個新的namespace，以後有人要使用他就需要宣告這個namespace。
namespace App\Traits;

// trait一種封裝機制，可以快速重複使用這段apiResponser的程式碼。
trait ApiResponserTrait
{
    /**
     * 定義統一例外回應方法
     * mixed是指可以是任何資料。可以輸入任何東西。
     * @param mixed $message  訊息。
     * @param mixed $status Http狀態碼。
     * @param mixed|null $code 選填自訂議錯誤編號。
     * @return \Illuminate\Http\Response
     */
    public function errorResponse($message,$status,$code=null){
        // ??是指如果沒有輸入$code的話，就會使用$status的值。
        $code = $code ?? $status;
        return response()->json([
            'message' => $message,
            'code' => $code,
        ],
        $status
    );
    }
}