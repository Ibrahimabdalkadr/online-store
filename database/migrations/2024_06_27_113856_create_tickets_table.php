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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('ticket_no')->unique();
            $table->foreignId('user_id')->index();
            $table->string('subject');
            $table->text('description');
            $table->string('attachment')->nullable();
            $table->tinyInteger('ticket_status')->default(0);
            $table->foreignId('resolved_by')->nullable()->index();
            $table->foreignId('closed_by')->nullable()->index();
            $table->text('note')->nullable();
            $table->foreignId('assigned_to')->nullable()->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
