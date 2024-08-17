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
        Schema::create('user_leaves', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('user_id')->comment('user id');
            $table->string('from_date')->comment('Leave from date');
            $table->string('to_date')->comment(' Leave to date');
            $table->integer('leave_days')->comment('Total Leave days');
            $table->text('reason')->comment('Reason of Leave')->nullable();
            $table->string('files')->nullable();
            $table->enum('status', ['1', '2', '3'])->default('1')->comment('Leave status: 1=>Pending, 2=>Approved,  3=>Declined ');
            $table->string('status_update_by')->comment('Leave status update by')->nullable();
            $table->text('status_update_resaon')->comment('Leave status update reason')->nullable();
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
        Schema::dropIfExists('user_leaves');
    }
};
