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
        Schema::create('sys_books', function (Blueprint $table) {
            $table->increments('id');
            $table->string('book_id');
            $table->string('title');
            $table->longText('description')->nullable();
            $table->string('author');
            $table->string('genre');
            $table->decimal('price', 15, 2);
            $table->integer('availableQty');
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
        Schema::dropIfExists('books');
    }
};
