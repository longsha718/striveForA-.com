<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    function ajax_output(int $code, array $data = [], string $message = "请求成功"): JsonResponse
    {
        if (is_object($data)) {
            $data = $data->toArray();
        }
        return response()->json([
            'c' => $code,
            'm' => $message,
            'd' => $data,
        ], 200, [], JSON_UNESCAPED_UNICODE);
    }

}
