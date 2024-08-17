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
        Schema::create('attendances', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('user_id');
            $table->string('user_name')->nullable();
            $table->text('user_selfi')->nullable();
            $table->string('lat');
            $table->string('lng');
            $table->text('address_in')->nullable();
            $table->string('distance')->nullable();
            $table->string('project_id')->nullable();
            $table->timestamp('date')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('attendance date');
            
            $table->string('lat_day_out')->nullable();
            $table->string('lng_day_out')->nullable();
            $table->text('address_day_out')->nullable();
            $table->string('distance_day_out')->nullable();
            $table->string('project_id_day_out')->nullable();
            $table->string('date_day_out')->nullable();
            $table->text('comment')->nullable();
            
            $table->string('mark_by')->nullable();
            $table->string('data')->nullable();
            $table->text('description')->nullable()->comment('description');
            $table->enum('status', ['1', '2', '3'])->default('1')->comment(' 1=>Mark as Present, 2=>Mark as Absent, 3->Mark as Half Day');
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
        Schema::dropIfExists('attendances');
    }
};
