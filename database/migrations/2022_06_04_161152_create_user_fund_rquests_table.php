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
        Schema::create('user_fund_rquests', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('user_id')->comment('user id');
            $table->string('project_id')->comment('fund for project')->nullable();
            $table->string('require_date')->comment('fund Request till date ')->nullable();
            $table->string('fund_amount')->comment('Requested fund amount')->nullable();
            $table->text('fund_details')->comment('Requested fund details')->nullable();
            $table->string('files')->nullable();
            $table->enum('status', ['1', '2', '3', '4', '5'])->default('1')->comment('fund Request status: 1=>Pending, 2=>Approved by User, 3=>Approved by Admin, 4=>Approved by Finance, 5=>Declined ');
            $table->text('status_update_by')->comment('fund status update by user')->nullable();
            $table->text('status_update_by_admin')->comment('fund status update by admin')->nullable();
            $table->text('status_update_by_finance')->comment('fund status update by finance')->nullable();
            $table->string('approved_fund')->comment('approved fund')->nullable();
            $table->text('status_update_resaon')->comment('fund status update reason')->nullable();
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
        Schema::dropIfExists('user_fund_rquests');
    }
};
