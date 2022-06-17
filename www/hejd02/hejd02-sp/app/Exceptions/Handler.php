<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Throwable;

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
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param Exception|Throwable $e
     * @return void
     * @throws Throwable
     */
    public function report(Exception|Throwable $e)
    {
        parent::report($e);
    }

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->renderable(function (NotFoundHttpException $e, $request) {
            if ($request->is('api/*')) {
                return response()->json(['error' => 'Data not found.'], 404);
            }
        });
        $this->renderable(function (MethodNotAllowedHttpException $e, $request) {
            if ($request->is('api/*')) {
                return response()->json(['error' => 'Method is not allowed.'], 405);
            }
        });
        $this->renderable(function (AccessDeniedHttpException $e, $request) {
            if ($request->is('api/*')) {
                return response()->json(['error' => 'Unauthorized.'], 401);
            }
        });
        $this->renderable(function (RouteNotFoundException $e, $request) {
            if ($request->is('api/*')) {
                return response()->json(['error' => 'Log in with the correct permissions.'], 401);
            }
        });
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param Request $request
     * @param Exception|Throwable $e
     * @throws Throwable
     */
    public function render($request, Exception|Throwable $e)
    {
        if ($e instanceof ModelNotFoundException) {
            return response()->json(['error' => 'Data not found.']);
        }

        return parent::render($request, $e);
    }
}



//
//namespace App\Exceptions;
//
//use Illuminate\Auth\AuthenticationException;
//use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
//use Illuminate\Http\Exceptions\HttpResponseException;
//use Illuminate\Validation\ValidationException;
//use Throwable;
//use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
//
//class Handler extends ExceptionHandler
//{
//    /**
//     * A list of exception types with their corresponding custom log levels.
//     *
//     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
//     */
//    protected $levels = [
//        //
//    ];
//
//    /**
//     * A list of the exception types that are not reported.
//     *
//     * @var array<int, class-string<\Throwable>>
//     */
//    protected $dontReport = [
//        //
//    ];
//
//    /**
//     * A list of the inputs that are never flashed for validation exceptions.
//     *
//     * @var array<int, string>
//     */
//    protected $dontFlash = [
//        'current_password',
//        'password',
//        'password_confirmation',
//    ];
//
//    /**
//     * Register the exception handling callbacks for the application.
//     *
//     * @return void
//     */
//    public function register()
//    {
//        $this->renderable(function (NotFoundHttpException $e, $request) {
//            if ($request->is('api/*')) {
//                return response()->json('Record not found',404);
//            }
//        });
//    }
//    private function handleApiException($request, Throwable $exception)
//    {
//        $exception = $this->prepareException($exception);
//
//        if ($exception instanceof HttpResponseException) {
//            $exception = $exception->getResponse();
//        }
//
//        if ($exception instanceof AuthenticationException) {
//            $exception = $this->unauthenticated($request, $exception);
//        }
//
//        if ($exception instanceof ValidationException) {
//            $exception = $this->convertValidationExceptionToResponse($exception, $request);
//        }
//
//        return $this->customApiResponse($exception);
//    }
//    public function render($request, Throwable $exception)
//    {
//        if ($request->wantsJson()) {   //add Accept: application/json in request
//            return $this->handleApiException($request, $exception);
//        } else {
//            $retval = parent::render($request, $exception);
//        }
//
//        return $retval;
//    }
//
//    private function customApiResponse($exception)
//    {
//        if (method_exists($exception, 'getStatusCode')) {
//            $statusCode = $exception->getStatusCode();
//        } else {
//            $statusCode = 500;
//        }
//
//        $response = [];
//
//        switch ($statusCode) {
//            case 401:
//                $response['message'] = 'Unauthorized';
//                break;
//            case 403:
//                $response['message'] = 'Forbidden';
//                break;
//            case 404:
//                $response['message'] = 'Record not found';
//            case 405:
//                $response['message'] = 'Method Not Allowed';
//                break;
//            case 422:
//                $response['message'] = $exception->original['message'];
//                $response['errors'] = $exception->original['errors'];
//                break;
//            default:
//                $response['message'] = ($statusCode == 500) ? 'Whoops, looks like something went wrong' : $exception->getMessage();
//                break;
//        }
//
//        if (config('app.debug')) {
//            $response['trace'] = $exception->getTrace();
//            $response['code'] = $exception->getCode();
//        }
//
//        $response['status'] = $statusCode;
//        return response()->json(['message' => $response['message'], 'trace' => $response['trace']], $response['status']);
//    }
//
//
//}
