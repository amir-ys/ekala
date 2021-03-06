<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('media', function (Blueprint $table) {
            $table->id();
            $table->string('files');
            $table->string('type');
            $table->foreignId('user_id');
            $table->foreignId('mediable_id');
            $table->string('mediable_type');
            $table->string('client_file_name')->nullable();
            $table->tinyInteger('is_primary')->default(0)->nullable();
            $table->tinyInteger('is_private')->default(0)->nullable();
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
        Schema::dropIfExists('media');
    }
}
