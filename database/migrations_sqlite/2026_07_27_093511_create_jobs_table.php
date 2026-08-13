<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function getConnection(): string
    {
        return 'sqlite';
    }

    public function up(): void
    {
        Schema::connection('sqlite')->create('jobs', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('job');
            $table->json('payload')->nullable();
            $table->enum(
                'status',
                array_column(\App\Enums\JobStatus::cases(), 'value')
            )->index();
            $table->json('metadata')->nullable();

            $table->timestamps();
        });

        Schema::connection('sqlite')->create('user_jobs', function (Blueprint $table) {
            $table->bigInteger('user_id')->index();
            $table->bigInteger('job_id');
        });
    }

    public function down(): void
    {
        Schema::connection('sqlite')->dropIfExists('jobs');
        Schema::connection('sqlite')->dropIfExists('user_jobs');
    }
};
