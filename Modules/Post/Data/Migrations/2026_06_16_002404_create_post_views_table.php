<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('post_views', function (Blueprint $table) {
            $table->id();

            $table->foreignId('post_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->ipAddress('ip_address');

            $table->text('user_agent')
                ->nullable();

            //enforcing unique view per day
            $table->date('view_date');

            $table->timestamp('viewed_at');

            $table->timestamps();

            $table->unique(
                ['post_id', 'user_id', 'view_date'],
                'post_views_unique_user_daily_view'
            );

            $table->index(['post_id', 'view_date']);
            $table->index('user_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('post_views');
    }
};
