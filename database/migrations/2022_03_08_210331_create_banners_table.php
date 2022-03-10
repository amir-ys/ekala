<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('body');
            $table->tinyInteger('priority')->nullable();
            $table->tinyInteger('status')->default(\App\Models\Banner::STATUS_ACTIVE);
            $table->string('type')->nullable();
            $table->string('btn_link');
            $table->string('btn_text')->nullable();
            $table->string('btn_icon')->nullable();
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
        Schema::dropIfExists('banners');
    }
}
