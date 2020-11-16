<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

use App\Exceptions\UserNotFoundException;
use App\Exceptions\BadRequestException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        //
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->renderable(function (UserNotFoundException $e, $request) {
            return response()->json(['message' => 'User not found'])->setStatusCode(404);
        });

        $this->renderable(function (BadRequestException $e, $request) {
            return response()->json(['message' => "Some fields are invalid or missing"])->setStatusCode(400);
        });
    }
}
