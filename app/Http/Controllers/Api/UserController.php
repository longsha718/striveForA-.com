<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{


    /**
     * 修改头像
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function EditAvatar(Request $request)
    {

        if(!$request->has("avatar")) {
            return $this->ajax_output(500000, [], "Please upload your avatar.");
        }

        if ($request->file('avatar')->isValid()) {
            $path = $request->file('avatar')->store('images/avatar');

            $savePath = config("app.url") . "/storage/" . $path;

            User::query()->where("id", Auth::id())->update([
                "avatar" => $savePath,
            ]);

            return $this->ajax_output(200000);
        } else {
            return $this->ajax_output(500000, [], "Avatar upload failed");
        }

    }


    /**
     * 修改个人信息
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function EditInfo(Request $request)
    {

        $data = [];

        if(!$request->has("name") || empty($request['name'])) {
            return $this->ajax_output(500000, [], "Please fill in the name");
        }

        if($request->has("name")) {
            $data['name'] = $request['name'];
        }
        if($request->has("nickname")) {
            $data['nickname'] = $request['nickname'];
        }
        if($request->has("slogan")) {
            $data['slogan'] = $request['slogan'];
        }

        User::query()->where("id", Auth::id())->update($data);

        return $this->ajax_output(200000);

    }


    /**
     * 修改密码
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function EditPassword(Request $request)
    {

        if(!$request->has("oldPassword") || empty($request['oldPassword'])) {
            return $this->ajax_output(500000, [], "Please enter the original password");
        }
        if(!$request->has("password") || empty($request['password'])) {
            return $this->ajax_output(500000, [], "Please enter a new password");
        }
        if(!$request->has("rePassword") || empty($request['rePassword'])) {
            return $this->ajax_output(500000, [], "Please confirm the new password");
        }
        if(trim($request['password']) !== trim($request['rePassword'])) {
            return $this->ajax_output(500000, [], "The two password entries are inconsistent");
        }
        if(trim($request['password']) === trim($request['oldPassword'])) {
            return $this->ajax_output(500000, [], "The new password is the same as the original password");
        }

        if (!Hash::check($request['oldPassword'], Auth::user()->password)) {
            return $this->ajax_output(500000, [], "Incorrect original password");
        }

        User::query()->where("id", Auth::id())->update([
            "password" => Hash::make($request->password),
        ]);

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return $this->ajax_output(200000);

    }

}
