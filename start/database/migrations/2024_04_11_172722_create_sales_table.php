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
        Schema::create('sys_sales', function (Blueprint $table) {
            //$table->id();
            $table->increments('id');
            $table->string('order_id');
            $table->foreignId('rep_id');
            $table->foreignId('buyer_id');
            $table->foreignId('invoice_id');
            //$table->foreignId('book_id');
            $table->longText('items');
            $table->date('sales_date');
            $table->string('status')->nullable();
            //$table->tinyInteger('qty')->default('0');
            //$table->tinyInteger('deleted')->default('0')->nullable();
            //$table->string('deleted_by')->nullable();
            //$table->datetime('deleted_date')->nullable();
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
        Schema::dropIfExists('sales');
    }
};
