<?php

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
        // Schema::table('orders', function (Blueprint $table) {
            
        // });

        DB::statement("ALTER TABLE orders AUTO_INCREMENT = 5000;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('orders', function (Blueprint $table) {
        //     //
        // });
    }
};
