<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('campaign_id')
                ->references('id')->on('campaigns');

            $table->double('amount');
            
            $table->foreignId('payment_id')
                ->references('id')->on('payment');

            $table->enum('status', [
                'waiting_transfer', 'success', 'cancel'
            ]);

            $table->text('comment')->nullable();
            $table->boolean('anonym')->default(false);
            $table->foreignId('user_id')
                ->references('id')->on('users');

            $table->timestamp('confirm_at')->nullable();

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
        Schema::dropIfExists('donations');
    }
}
