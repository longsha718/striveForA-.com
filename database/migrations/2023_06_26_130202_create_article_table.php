<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article', function (Blueprint $table) {
            $table->bigIncrements("id")->comment("ID");
            $table->unsignedBigInteger("user")->comment("User");
            $table->char("type", 20)->comment("Type");
            $table->char("subject", 30)->comment("Subject");
            $table->decimal("cost", 10, 2)->comment("Cost");
            $table->unsignedInteger("count")->comment("Maximum number of people");
            $table->unsignedTinyInteger('registered')->comment("Number of people registered");
            $table->longText('students_avatar')->nullable()->comment("students");
            $table->string("details")->comment("Details");
            $table->unsignedTinyInteger("state")->default(1)->comment("State");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('article');
    }
}
