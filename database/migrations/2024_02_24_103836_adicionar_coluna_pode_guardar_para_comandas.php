<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('comandas', function (Blueprint $table) {
            $table->integer('pode_guardar')->default(0);
        });
    }

    public function down()
    {
        Schema::table('comandas', function (Blueprint $table) {
            $table->dropColumn('pode_guardar');
        });
    }
};
