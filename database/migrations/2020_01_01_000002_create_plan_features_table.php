<?php

declare(strict_types=1);

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlanFeaturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(config('rinvex.subscriptions.tables.plan_features'), function (Blueprint $table) {
            // Columns
            $table->bigIncrements('id');
            $table->bigInteger('plan_id')->unsigned();
            $table->string('slug');
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('value');
            $table->smallInteger('resettable_period')->unsigned()->default(0);
            $table->string('resettable_interval')->default('month');
            $table->mediumInteger('sort_order')->unsigned()->default(0);
            $table->timestamps();
            $table->softDeletes();

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
        Schema::dropIfExists(config('rinvex.subscriptions.tables.plan_features'));
    }
}
