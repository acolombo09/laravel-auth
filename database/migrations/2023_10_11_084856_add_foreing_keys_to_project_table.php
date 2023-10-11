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
        Schema::table('project', function (Blueprint $table) {
            // nullable perchè altrimenti darà errore causa possibile conflitto nel db se già presente la colonna
            // crea una colonna di tipo unsignedBigInteger
            $table->unsignedBigInteger('user_id')->nullable();

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
        Schema::table('project', function (Blueprint $table) {
            // processo inverso, devo rimuovere la foreign tramite nome indice
            $table->dropForeign('posts_user_id_foreign');
            
            // rimuovo la colonna user_id
            $table->dropColumn('user_id');
        });
    }
};
