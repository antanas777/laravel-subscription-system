<?php

declare(strict_types=1);

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlanSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(config('rinvex.subscriptions.tables.plan_subscriptions'), function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->morphs('user');
            $table->bigInteger('plan_id')->unsigned();
            $table->string('slug');
            $table->string('name');
            $table->string('description')->nullable();
            $table->dateTime('trial_ends_at')->nullable();
            $table->dateTime('starts_at')->nullable();
            $table->dateTime('ends_at')->nullable();
            $table->dateTime('cancels_at')->nullable();
            $table->dateTime('canceled_at')->nullable();
            $table->string('timezone')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // Indexes
            $table->foreign('plan_id')->references('id')->on(config('rinvex.subscriptions.tables.plans'))
                  ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists(config('rinvex.subscriptions.tables.plan_subscriptions'));
    }
}
