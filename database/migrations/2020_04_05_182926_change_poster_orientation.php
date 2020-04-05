<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangePosterOrientation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posters', function (Blueprint $table) {
            DB::statement("ALTER TABLE
            `posters`
            MODIFY COLUMN
                `orientation` enum(
                    'portrait',
                    'landscape'
                )
            NOT NULL;");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posters', function (Blueprint $table) {
            DB::statement("ALTER TABLE
            `posters`
            MODIFY COLUMN
                `orientation` enum(
                    'horizontal',
                    'vertical'
                );");
        });
    }
}
