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
        Schema::table('product_categories', function (Blueprint $table) {
            $table->integer('order')->default(0)->after('has_intermediate_page');
        });
        
        // Set initial order values based on existing IDs
        $categories = \App\Models\ProductCategory::all();
        foreach ($categories as $index => $category) {
            $category->order = $index + 1;
            $category->save();
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_categories', function (Blueprint $table) {
            $table->dropColumn('order');
        });
    }
};
