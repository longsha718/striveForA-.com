<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table("users", function (Blueprint $table) {
           $table->char("avatar", 200)->default( config("app.url") . "/uploads/images/default-avatar.jpg")->comment("avatar")->after("name");
           $table->char("nickname", 200)->default("")->nullable()->after("id");
           $table->char("slogan", 200)->default("")->nullable()->after("password");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
