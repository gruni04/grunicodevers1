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
        Schema::create('user_details', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('user_id');
            $table->string('image')->nullable();
            $table->string('father_name')->nullable();
            $table->string('dob')->nullable();
            $table->enum('gender', ['1', '2', '3'])->nullable()->default('1')->comment(' 1=>Male, 2=>Female, 2=>Other');
            
            $table->string('phone')->nullable();
            $table->text('localaddress')->nullable();
            $table->text('premanent_address')->nullable();

            $table->string('employe_id')->nullable();
            $table->string('department')->nullable();
            $table->string('designation')->nullable();
            $table->string('credit_leaves')->nullable();
            $table->string('doj')->nullable();
            $table->string('basic_salary')->nullable();
            $table->string('hourly_salary')->nullable();

            $table->string('ac_holder_name')->nullable();
            $table->string('ac_number')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('ifsc_code')->nullable();
            $table->string('branch_location')->nullable();
            $table->string('tax_payer_id')->nullable();

            $table->string('resume')->nullable();
            $table->string('offer_letter')->nullable();
            $table->string('joining_letter')->nullable();
            $table->string('agreement')->nullable();
            $table->string('id_proof')->nullable();
            
            $table->string('high_school')->nullable();
            $table->string('intermediate')->nullable();
            $table->string('graduation')->nullable();
            $table->string('post_graduation')->nullable();
            $table->string('other_certificates')->nullable();

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
        Schema::dropIfExists('user_details');
    }
};
