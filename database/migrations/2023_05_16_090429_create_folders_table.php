<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateFoldersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            Schema::create('folders', function (Blueprint $table) {
                $table->id()->autoIncrement()->unsigned();
                $table->string('title', 20);
                $table->timestamps();
                $table->unsignedBigInteger('user_id')->unsigned();
                // 外部キーを設定する
                $table->foreign('user_id')->references('id')->on('users');
            });

    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('folders');
    }
}






