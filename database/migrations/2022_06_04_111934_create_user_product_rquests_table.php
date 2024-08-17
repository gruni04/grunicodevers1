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
        Schema::create('user_product_rquests', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('user_id')->comment('user id');
            $table->text('require_date')->comment('product Request till date ')->nullable();
            $table->text('product_details')->comment('Requested product details')->nullable();
            $table->string('files')->nullable();
            $table->enum('status', ['1', '2', '3'])->default('1')->comment('product Request status: 1=>Pending, 2=>Approved, 3=>Declined ');
            $table->string('status_update_by')->comment('product status update by')->nullable();
            $table->text('status_update_resaon')->comment('product status update reason')->nullable();
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
        Schema::dropIfExists('user_product_rquests');
    }
};
