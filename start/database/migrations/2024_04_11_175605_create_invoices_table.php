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
        Schema::create('sys_invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->string('invoice_id');
            $table->foreignId('rep_id');
            $table->foreignId('buyer_id');
            $table->foreignId('order_id');
            $table->decimal('amount', 15, 2);
            $table->string('pay_option');
            $table->string('status');
            $table->decimal('pay_amount', 15, 2)->nullable();
            $table->date('pay_date')->nullable();
            $table->string('pay_ref')->nullable();
            $table->date('invoice_date');
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
        Schema::dropIfExists('invoices');
    }
};
