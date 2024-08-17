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
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('project_name');
            $table->string('from_date')->nullable();
            $table->string('to_date')->nullable();
            $table->string('contact_person')->nullable();
            $table->string('contact_no')->nullable();
            $table->string('email')->nullable();
            $table->string('company')->nullable();
            $table->string('url')->nullable();
            $table->text('address')->nullable();
            $table->string('budget')->nullable();
            $table->text('description')->nullable();
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
        Schema::dropIfExists('projects');
    }
};
