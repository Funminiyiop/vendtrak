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
        Schema::create('sys_buyers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('agent');
            $table->string('email');
            $table->string('customer_id');
            $table->string('company');
            $table->integer('h_no');
            $table->string('street');
            $table->string('area1');
            $table->string('area2')->nullable();
            $table->string('city');
            $table->string('state');
            $table->string('country');
            $table->string('phone1');
            $table->string('phone2')->nullable();
            $table->integer('website')->nullable();
            $table->string('cptitle');
            $table->string('cpfname');
            $table->string('cplname');
            $table->string('cpemail');
            $table->string('cpphone1');
            $table->string('cpphone2')->nullable();
            $table->tinyInteger('deleted')->default('0')->nullable();
            $table->string('deleted_by')->nullable();
            $table->datetime('deleted_date')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->useCurrent();
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buyers');
    }
};
