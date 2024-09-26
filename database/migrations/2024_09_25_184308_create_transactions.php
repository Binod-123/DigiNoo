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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('trans_id');
            $table->unsignedBigInteger('trans_user_id');
            $table->string('trans_plaid_trans_id');
            $table->string('trans_plaid_categories');
            $table->decimal('trans_plaid_amount', 10, 2);
            $table->unsignedBigInteger('trans_plaid_category_id');
            $table->date('trans_plaid_date');
            $table->string('trans_plaid_name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
