<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up() {
        Schema::create('extra_repayment_schedules', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('month_number');
            $table->decimal('starting_balance', 10, 2);
            $table->decimal('monthly_payment', 10, 2);
            $table->decimal('principal_component', 10, 2);
            $table->decimal('interest_component', 10, 2);
            $table->decimal('extra_repayment', 10, 2)->default(0);
            $table->decimal('ending_balance', 10, 2);
            $table->unsignedInteger('remaining_loan_term');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('extra_repayment_schedules');
    }
};
