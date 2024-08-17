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
        Schema::create('working_locations', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('location_name');
            $table->string('location_address')->nullable();
            $table->string('lat');
            $table->string('lang');
            $table->string('data')->nullable();
            $table->text('description')->nullable()->comment('description');
            $table->enum('status', ['1', '2'])->default('1')->comment(' 1=>Active, 2=>Inactive');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('working_locations');
    }
};
