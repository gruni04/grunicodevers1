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
        Schema::create('project_tasks', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('project');
            $table->string('task_name');
            $table->string('from_date');
            $table->string('to_date');
            $table->string('from_time');
            $table->string('to_time');
            $table->string('task_points')->nullable();
            $table->string('lable')->comment(' lable id ');
            $table->string('note')->nullable();
            $table->string('added_by');
            $table->string('client_id')->nullable();
            $table->enum('client_status', ['1', '2', '3'])->default('3')->comment(' 1=>Approved, 2=>Disapproved, 3=>Pending ');
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
        Schema::dropIfExists('project_tasks');
    }
};
