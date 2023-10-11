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
        Schema::create('user_details', function (Blueprint $table) {
            $table->id();

            $table->string("phone")->nullable();
            $table->string("address")->nullable();
            $table->string("avatar")->nullable();
            $table->unsignedBigInteger("user_id");

            $table->timestamps();

            // rendo la colonna user_id una foreign key
            $table->foreign('user_id')
                // riferimento colonna id
                ->references('id')
                // nella tabella users
                ->on('users')
                // invocare funzione delete per cancellare i post utente cancellato
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_details');
    }
};
