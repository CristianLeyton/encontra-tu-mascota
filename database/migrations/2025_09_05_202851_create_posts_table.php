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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_published')->default(true);
            $table->boolean('is_missing')->default(true);
            $table->boolean('is_resolved')->default(false);
            $table->string('title');
            $table->string('slug');
            $table->text('description');
            $table->date('date');
            $table->string('location');
            $table->foreignId('species_id')->constrained()->onDelete('restrict');
            $table->foreignId('breed_id')->nullable()->constrained()->onDelete('set null');
            $table->string('color')->nullable();
            $table->string('size')->nullable();
            $table->text('images')->nullable();
            
            $table->string('name_contact')->nullable();
            $table->string('email_contact')->nullable();
            $table->string('phone_contact')->nullable();

            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
