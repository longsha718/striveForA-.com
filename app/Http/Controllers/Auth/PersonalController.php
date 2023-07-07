<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;

class PersonalController extends Controller
{


    public function index()
    {

        $list = Article::query()->where("user", Auth::id())->orderByDesc("created_at")
            ->get()->map(function ($item) {
                return [
                    'avatar' => $item->UserBind->avatar,
                    'id' => $item['id'],
                    'type' => $item['type'],
                    'subject' => $item['subject'],
                    'cost' => $item['cost'],
                    'count' => $item['count'],
                    'details' => $item['details'],
                    'registered' => $item['registered'],
                    'students_avatar' => json_decode($item['students_avatar'], true),
                    'state' => $item['state'],
                ];
            });

        return view("personal", ['list' => $list]);
    }


}
