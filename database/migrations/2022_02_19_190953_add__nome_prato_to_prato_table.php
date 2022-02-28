<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNomePratoToPratoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pratos', function (Blueprint $table) {
            $table->string('Nome prato')->nullable();
            $table->string('Ingredientes')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pratos', function (Blueprint $table) {
            $table->dropColumn('Nome prato');
            $table->dropColumn('Ingredientes');
        });
    }
}
