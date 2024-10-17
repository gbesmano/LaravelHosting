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
        Schema::create('destinations', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->string('company_address');
            $table->longText('about');
            $table->string('company_permit');
            $table->string('location_clearance');
            $table->string('barangay_clearance');
            $table->string('philhealth');
            $table->string('corporate_bank_account');
            $table->string('sec_registration');
            $table->string('tin');
            $table->string('sss');

            $table->string('destination_name');
            $table->enum('category', ['1', '2']);
            $table->string('operating_hours');
            $table->string('destination_address');
            $table->string('nearest_landmark1')->nullable();
            $table->string('nearest_landmark2')->nullable();
            $table->string('nearest_landmark3')->nullable();
            $table->string('amenities');
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->enum('status', ['pending', 'approved', 'rejected']);
            $table->string('coverphoto')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('destinations');
    }
};
