<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('students', function (Blueprint $table) {
            // Drop the existing foreign key constraint
            $table->dropForeign(['houseId']);

            // Add the new foreign key constraint with onDelete('set null')
            $table->foreign('houseId')
                ->references('id')
                ->on('houses')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('students', function (Blueprint $table) {
            // Drop the foreign key constraint with onDelete('set null')
            $table->dropForeign(['houseId']);

            // Restore the original foreign key constraint with onDelete('restrict')
            $table->foreign('houseId')
                ->references('id')
                ->on('houses')
                ->onDelete('restrict');
        });
    }
};
