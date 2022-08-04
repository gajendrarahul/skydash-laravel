<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
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
            return false;
        });
    }
    public function render($request, Throwable $e)
    {

        if ($this->isHttpException($e)) {
            $code = $e->getStatusCode();
            $message = '';
            if ($code == 404) {
                $message = 'Address Not Found';
                return response()->view('interface.errors.' . 'error', compact('code', 'message'));
            }
            if ($code == 400) {
                $message = 'Bad Request';
                return response()->view('interface.errors.' . 'error', compact('code', 'message'));
            }
            if ($code == 401) {
                $message = 'Unauthorized';
                return response()->view('interface.errors.' . 'error', compact('code', 'message'));
            }
            if ($code == 405) {
                $message = 'Method Not Allowed';
                return response()->view('interface.errors.' . 'error', compact('code', 'message'));
            }
            if ($code == 500) {
                $message = 'Internal Server Error';
                return response()->view('interface.errors.' . 'error', compact('code', 'message'));
            }
            if ($code == 502) {
                $message = 'Bad Gateway';
                return response()->view('interface.errors.' . 'error', compact('code', 'message'));
            }
        }

        return parent::render($request, $e);
    }
}
