<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
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

    function render($request, Throwable $exception)
    {

        // array messagem
         $message1 = [
            'exception' =>$exception->getMessage(),
            'req' =>$request
        ];

        //dd($message1);

        if($exception->getCode() == 0) {

           return parent::render($request, $exception);
                
        // Acesso das mineradoras
        }elseif (($message1['exception'] == "Unauthenticated.") && ($request->getRequestUri('/pae/mineradora'))) {
            //dd('acesso mineradora');
            return response()->view('auth.login', ['message' => $message1['exception']], 404);
            
        } else if ($message1['exception'] == "Unauthenticated.") {
        
            //return response()->view('errors/noAuth', ['message' => $message1['exception']], 500);
            return response()->view('errors/noAuth', ['message' => "Usuario não Autenticado"], 500);
        
        } else if($message1['exception'] == "CSRF token mismatch.") {
            
            return response()->view('auth.login', ['message' => $message1['exception']], 404);
            
        }else {

            if ($this->isHttpException($exception)) {
                
                if ($exception->getStatusCode() == 404) {

                    return response()->view('errors/404', ['message' => $message1['exception']], 404);
                
                }elseif($exception->getStatusCode() == 402){
                    dd($message1['exception']);
                }
                if ($exception->getStatusCode() == 500) {

                    if (true) {
                        dd('o');
                    } else {
                        return response()->view('errors/500', ['message' => $message1['exception']], 500);
                    }
                }
            } else {

//                dd($exception)->getCode();
                return response()->view('errors.500', ['message' => $message1['exception']], 500);
            }
        }

//         dd('opa');
        return parent::render($request, $exception);
    }
}
