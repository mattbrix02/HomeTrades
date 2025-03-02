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
        Schema::table('listings', function (Blueprint $table) {
            $table->UnsignedTinyInteger('beds');
            $table->UnsignedTinyInteger('baths');
            $table->UnsignedSmallInteger('area');
            $table->TinyText('city');
            $table->TinyText('code');
            $table->TinyText('street');
            $table->TinyText('street_nr');

            $table->unsignedInteger('price');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        /*
        Schema::table('listings', function (Blueprint $table) {
            $table->dropColumn();
        });
        */
        schema::dropColumns('listings', [
            'beds', 'baths', 'area', 'city', 'code', 'street', 'street_nr', 'price'
        ]);
    }
};
