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
        Schema::create('sys_book_supplieds', function (Blueprint $table) {
            $table->increments('id');
            $table->string('bsupplied_id');
            $table->foreignId('invoice_id');
            $table->date('supply_date');
            $table->integer('qty_supplied');
            $table->string('supply_status');
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
        Schema::dropIfExists('book_supplieds');
    }
};
