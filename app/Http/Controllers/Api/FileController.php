<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{

    /**
     * 上传图片
     *
     * @param Request $request
     * @return JsonResponse
     * @throws Exception
     */
    public function Upload(Request $request)
    {

        if ($request->file('file')->isValid()) {
            try {
                $savePath = Storage::put("article/student-avatar", $request->file("file"));
                $path = config('app.url') . '/storage/' . $savePath;

                return $this->ajax_output(200000, [
                    "avatar" => $path,
                ]);
            } catch (Exception $e) {
                return $this->ajax_output(500000, [], "File upload failed");
            }
        } else {
            return $this->ajax_output(500000, [], "File upload failed");
        }

    }

}
