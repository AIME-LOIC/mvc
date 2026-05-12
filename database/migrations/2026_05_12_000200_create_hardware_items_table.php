<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hardware_items', function (Blueprint $table): void {
            $table->id();

            $table->foreignId('hardware_category_id')
                ->constrained('hardware_categories')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->string('name');
            $table->string('asset_tag')->unique();
            $table->string('serial_number')->nullable()->index();
            $table->string('status')->default('available')->index();
            $table->string('location')->nullable()->index();

            $table->foreignId('assigned_to_user_id')
                ->nullable()
                ->constrained('users')
                ->cascadeOnUpdate()
                ->nullOnDelete();

            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hardware_items');
    }
};

