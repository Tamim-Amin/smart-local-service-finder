<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->text('bio')->nullable();
            $table->integer('years_of_experience')->default(0);
            $table->decimal('hourly_rate', 8, 2);
            $table->string('location');
            $table->json('skills')->nullable();
            $table->enum('availability_status', ['available', 'busy', 'offline'])->default('available');
            $table->enum('verification_status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->decimal('average_rating', 3, 2)->default(0);
            $table->integer('total_reviews')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('services');
    }
};