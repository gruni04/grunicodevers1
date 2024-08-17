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
        Schema::create('project_task_client_responses', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('project_task_id');
            $table->integer('response')->comment(' 1=>Approved, 2=>Disapproved, 3=>Pending');
            $table->string('grade')->nullable();
            $table->text('comment')->nullable();
            $table->string('update_by');
            $table->string('time');
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
        Schema::dropIfExists('project_task_client_responses');
    }
};
