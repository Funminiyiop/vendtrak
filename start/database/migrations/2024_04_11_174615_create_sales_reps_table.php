<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sys_sales_reps', function (Blueprint $table) {
            //$table->id();
            $table->increments('id');
            $table->string('email');
            $table->string('fname');
            $table->string('lname');
            $table->string('sex');
            $table->integer('houseno');
            $table->string('streetname');
            $table->string('area1');
            $table->string('area2')->nullable();
            $table->string('city');
            $table->string('state');
            $table->string('country');
            $table->biginteger('phone1');
            $table->biginteger('phone2')->nullable();
            $table->string('contract_type');
            $table->tinyInteger('deleted')->default('0')->nullable();
            $table->string('deleted_by')->nullable();
            $table->datetime('deleted_date')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->useCurrent();
            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales_reps');
    }
};
