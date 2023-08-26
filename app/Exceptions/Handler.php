<?php

namespace App\Exceptions;

// 宣告自己新作的trait，這個trait是用來回傳錯誤訊息的。
use App\Traits\ApiResponserTrait;

//使用laravel裡面已經做好的handler功能 as 市縮寫的意思。
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
// 這是宣告使用內建錯誤碼的地方讓，錯誤碼可以正常運行使用。
use Throwable;
// 新增加的使用功能。
use Illuminate\Http\Response;
// 這是回傳錯誤訊息的內建宣告。

// 找不到資源的錯誤訊息。功能宣告處。
use Illuminate\Database\Eloquent\ModelNotFoundException;
// 找不到此方法的錯誤訊息。功能宣告處。
use Symfony\Component\HttpKernel\Exception\MothodNotFoundHttpException;
// 找不到此網址的錯誤訊息。功能宣告處。
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    // 宣告使用trait的功能。
    use ApiResponserTrait;
    public function render($request, Throwable $exception)
    {

        /** 
         * 
         * //這裡是判斷傳過來的request是否為json格式，如果是的話就回傳json格式的錯誤訊息。       
         * if($request->expectsJson()){
         *    // $exception這個物件，如果是繼承，或是宣告於，ModelNotFoundException這個class的話就回傳下面的錯誤訊息。
         *   // instaneof是判斷物件是否繼承或是宣告於某個class。
         *     if($exception instanceof ModelNotFoundException){
         *         // 如果是的話執行下面的指令。
         *         // 回傳response的json格式的錯誤訊息，並且回傳HTTP_NOT_FOUND的錯誤碼。
         *         return response()->json([
         *             'error' => '找不到資源'
         *         ],Response::HTTP_NOT_FOUND);
         *     }
         * }
         * 
         */
        // 找不到資源的錯誤訊息。的判斷處。
        if ($request->expectsJson()) {
            if ($exception instanceof ModelNotFoundException) {
                // 下面這句是取用ApiResponserTrait.php裡面的errorResponse方法。
                return $this->errorResponse('找不到資源。', Response::HTTP_NOT_FOUND);
            }
            if ($exception instanceof NotFoundHttpException) {
                // 下面這句是取用ApiResponserTrait.php裡面的errorResponse方法。
                return $this->errorResponse('找不到此網頁。', Response::HTTP_NOT_FOUND);
            }
            if ($exception instanceof MothodNotFoundHttpException) {
                // 下面這句是取用ApiResponserTrait.php裡面的errorResponse方法。
                return $this->errorResponse(
                    $exception->getMessage(),
                    Response::HTTP_METHOD_NOT_ALLOWED
                );
            }
        }


        // dd($exception);
        // 執行父類別，
        return parent::render($request,$exception);
    }
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }
}
