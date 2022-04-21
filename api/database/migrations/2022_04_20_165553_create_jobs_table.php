<?php

use App\Enums\Job\OfferCurrency;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('country');
            $table->string('city');
            $table->string('employment_type');
            $table->text('description')->nullable();
            $table->text('requirement')->nullable();
            $table->text('benefit')->nullable();
            $table->unsignedInteger('min_offer')->nullable();
            $table->unsignedInteger('max_offer')->nullable();
            $table->string('currency')->default(OfferCurrency::VND);
            $table->date('deadline')->nullable();
            $table->string('status');
            $table->unsignedBigInteger('pipeline_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jobs');
    }
};
