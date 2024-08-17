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
        Schema::create('leads', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->text('company_name')->nullable()->comment('Company name');
            $table->string('added_by')->nullable();
            $table->string('category')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->nullable();
            $table->string('email1')->nullable();
            $table->string('email2')->nullable();
            $table->string('email3')->nullable();
            $table->string('contact')->nullable();
            $table->string('contact1')->nullable();
            $table->string('contact2')->nullable();
            $table->string('contact_whatsapp')->nullable();
            $table->string('requirement')->nullable()->comment('enquiry related to topic');
            $table->text('message')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->text('address')->nullable();
            $table->text('utm_term')->nullable()->comment('enquiry source keyword, Identifies the paid search term associated with an ad');
            $table->text('utm_source')->nullable()->comment('Identifies the source of your traffic ex. googleads, fb, instagram etc');
            $table->text('utm_medium')->nullable()->comment('Identifies the marketing medium where the link was shared');
            $table->text('utm_campaign')->nullable()->comment('identify a specific product promotion or a strategic campaign');
            $table->text('utm_content')->nullable()->comment('click link name like image/logo/title etc.');
            $table->text('utm_creative')->nullable();
            
            $table->text('description')->nullable()->comment('description');
            $table->string('owner')->nullable()->comment('currently lead by user id');
            $table->string('stage')->nullable()->comment('current stage id, null for new lead');
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
        Schema::dropIfExists('leads');
    }
};
