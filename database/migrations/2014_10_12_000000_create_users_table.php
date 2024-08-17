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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('reporting_role')->nullable()->comment('Reporting Role Name');
            $table->integer('reporting_to')->nullable()->comment('Reporting to User Id');
            $table->enum('is_anyuser_report_me', ['1', '2'])->default('2')->comment('1=>Yes, 2=>No');
            $table->enum('status', ['1', '2'])->default('1')->comment('1=>Active, 2=>Inactive');
            $table->integer('added_by')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
