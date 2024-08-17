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
        Schema::create('project_users', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->enum('board_type', ['1', '2'])->default('1')->comment(' 1=>Project, 2=>Task ');
            $table->string('board_id')->comment(' Project Id/Task Id ');
            $table->string('user_id')->comment(' User Id ');
            $table->string('added_by');
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
        Schema::dropIfExists('project_users');
    }
};
