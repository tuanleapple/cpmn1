<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('print_histories', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('factory_number');
            $table->string('name_file');
            $table->string('paper');
            $table->string('copy');
            $table->string('printer');
            $table->string('kind_paper');
            $table->string('comment');
            $table->string('profile_code');
            $table->timestamp('date')->nullable();
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
        Schema::dropIfExists('print_histories');
    }
};
