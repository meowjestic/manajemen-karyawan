<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateDivisi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('divisions', 'id'))
        {
            Schema::table('divisions', function (Blueprint $table)
            {
                $table->dropColumn('id');
            });
        }
        
        Schema::table('divisions', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
    }
}
