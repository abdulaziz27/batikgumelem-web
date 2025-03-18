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
        // Modify existing carts table to include size information
        Schema::table('carts', function (Blueprint $table) {
            $table->foreignId('product_size_id')->nullable()->after('product_id')->constrained('product_sizes')->nullOnDelete();
        });

        // Modify transaction_items table to include size information
        Schema::table('transaction_items', function (Blueprint $table) {
            $table->foreignId('product_size_id')->nullable()->after('product_id')->constrained('product_sizes')->nullOnDelete();
            $table->string('size_name')->nullable()->after('product_size_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transaction_items', function (Blueprint $table) {
            $table->dropForeign(['product_size_id']);
            $table->dropColumn(['product_size_id', 'size_name']);
        });

        Schema::table('carts', function (Blueprint $table) {
            $table->dropForeign(['product_size_id']);
            $table->dropColumn('product_size_id');
        });
    }
};
