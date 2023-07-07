<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{


    public function Publish(Request $request)
    {

        if(!$request->has("type") || empty($request['type'])) {
            return $this->ajax_output(500000, [], "Please select a level");
        }
        if(!$request->has("subject") || empty($request['subject'])) {
            return $this->ajax_output(500000, [], "Please fill in the subject");
        }
        if(!$request->has("cost") || empty($request['cost'])) {
            return $this->ajax_output(500000, [], "Please fill in the fee");
        }
        if(!is_numeric($request['cost'])) {
            return $this->ajax_output(500000, [], "The fee format is incorrect");
        }
        if(!$request->has("count") || empty($request['count'])) {
            return $this->ajax_output(500000, [], "Please fill in the maximum number of tutors");
        }
        if(!$request->has("details") || empty($request['details'])) {
            return $this->ajax_output(500000, [], "Please fill in the details");
        }

        Article::query()->create([
            "user" => Auth::id(),
            "type" => $request['type'],
            "subject" => $request['subject'],
            "cost" => $request['cost'],
            "count" => $request['count'],
            "registered" => $request['registered'],
            "students_avatar" => json_encode($request['avatarList'] ?? []),
            "details" => $request['details'],
        ]);


        return $this->ajax_output(200000, [], "Published successfully");

    }


    public function EditState(Request $request)
    {

        if(!$request->has("article") || empty($request['article'])) {
            return $this->ajax_output(500000, [], "Please select a post");
        }

        if(!$request->has("state") || !in_array($request['state'], [0, 1])) {
            return $this->ajax_output(500000, [], "Please select a status");
        }

        $articleInfoSql = Article::query()->where("id", $request["article"])
            ->where("user", Auth::id());

        $articleInfo = (clone $articleInfoSql)->first();

        if(!$articleInfo) {
            return $this->ajax_output(500000, [], "Post does not exist");
        }

        (clone $articleInfoSql)->update([
            "state" => $request['state'],
        ]);


        return $this->ajax_output(200000, [], "Operation successful");


    }


    public function GetInfo(Request $request)
    {

        if(!$request->has("article") || empty($request['article'])) {
            return $this->ajax_output(500000, [], "Please select a post");
        }

        $articleInfoSql = Article::query()->where("id", $request["article"])
            ->where("user", Auth::id());

        $articleInfo = (clone $articleInfoSql)->first()->makeHidden([
            'id', 'user', 'state', 'created_at', 'updated_at'
        ]);

        if(!$articleInfo) {
            return $this->ajax_output(500000, [], "Post does not exist");
        }

        $info = $articleInfo->toArray();

        $info['students_avatar'] = json_decode($info['students_avatar'], true);

        return $this->ajax_output(200000, ['info' => $info], "Get success");

    }


    public function EditInfo(Request $request)
    {
        if(!$request->has("article") || empty($request['article'])) {
            return $this->ajax_output(500000, [], "Please select a post");
        }

        if(!$request->has("type") || empty($request['type'])) {
            return $this->ajax_output(500000, [], "Please select a level");
        }
        if(!$request->has("subject") || empty($request['subject'])) {
            return $this->ajax_output(500000, [], "Please fill in the subject");
        }
        if(!$request->has("cost") || empty($request['cost'])) {
            return $this->ajax_output(500000, [], "Please fill in the fee");
        }
        if(!is_numeric($request['cost'])) {
            return $this->ajax_output(500000, [], "The fee format is incorrect");
        }
        if(!$request->has("count") || empty($request['count'])) {
            return $this->ajax_output(500000, [], "Please fill in the maximum number of tutors");
        }
        if(!$request->has("details") || empty($request['details'])) {
            return $this->ajax_output(500000, [], "Please fill in the details");
        }

        $articleInfoSql = Article::query()->where("id", $request["article"])->where("user", Auth::id());

        if(!(clone $articleInfoSql)->exists()) {
            return $this->ajax_output(500000, [], "Post does not exist");
        }

        (clone $articleInfoSql)->update([
            "type" => $request['type'],
            "subject" => $request['subject'],
            "cost" => $request['cost'],
            "count" => $request['count'],
            "details" => $request['details'],
            "registered" => $request['registered'],
            "students_avatar" => json_encode($request['avatarList'] ?? []),
        ]);

        return $this->ajax_output(200000, [], "Modified successfully");

    }


    public function Delete(Request $request)
    {

        if(!$request->has("article") || empty($request['article'])) {
            return $this->ajax_output(500000, [], "Please select a post");
        }

        $articleInfoSql = Article::query()->where("id", $request["article"])
            ->where("user", Auth::id());

        $articleInfo = (clone $articleInfoSql)->first();

        if(!$articleInfo) {
            return $this->ajax_output(500000, [], "Post does not exist");
        }

        (clone $articleInfoSql)->delete();

        return $this->ajax_output(200000, [], "Operation successful");

    }


}
