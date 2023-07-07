<?php

use App\Models\Article;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $list = Article::query()->where("state", 1)->orderByDesc("created_at")
        ->get()->map(function ($item) {
            return [
                'avatar' => $item->UserBind->avatar,
                'name' => $item->UserBind->name,
                'email' => $item->UserBind->email,
                'type' => $item['type'],
                'subject' => $item['subject'],
                'cost' => $item['cost'],
                'count' => $item['count'],
                'registered' => $item['registered'],
                'students_avatar' => json_decode($item['students_avatar'], true),
                'details' => $item['details'],
            ];
        });

    return view('dashboard', ['list' => $list]);
})->name('dashboard');


Route::get('/index/{type?}/{subject?}/{details?}', function ($type = 0, $subject = 0, $details = 0) {
    $list = Article::query()->where("state", 1)
        ->where(function (Builder $query) use ($type, $subject, $details) {
            if(!empty($type)) {
                $query->where("type", $type);
            }
            if(!empty($subject)) {
                $query->where("subject", "like", "%" . $subject . "%");
            }
            if(!empty($details)) {
                $query->where("details", "like", "%" . $details . "%");
            }
        })->orderByDesc("created_at")
        ->get()->map(function ($item) {
            return [
                'avatar' => $item->UserBind->avatar,
                'name' => $item->UserBind->name,
                'email' => $item->UserBind->email,
                'type' => $item['type'],
                'subject' => $item['subject'],
                'cost' => $item['cost'],
                'count' => $item['count'],
                'registered' => $item['registered'],
                'students_avatar' => json_decode($item['students_avatar'], true),
                'details' => $item['details'],
            ];
        });

    return view('dashboard', ['list' => $list]);
});

require __DIR__.'/auth.php';
