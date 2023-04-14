<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('code')->unique();
            $table->string('title');
            $table->string('amount')->default(0);
            $table->timestamps();
        });

        DB::table('products')->insert([
            [
                'code' => 53634,
                'title' => 'Wi-Fi роутер ASUS RT-N300',
                'amount' => 23,
            ],
            [
                'code' => 10568,
                'title' => 'TP-Link Archer C64',
                'amount' => 4,
            ],
            [
                'code' => 15364,
                'title' => 'TP-LINK TL-WR820N V2',
                'amount' => 11,
            ],
            [
                'code' => 83457,
                'title' => 'Mesh WiFi-система Deco E4',
                'amount' => 7,
            ],
            [
                'code' => 34638,
                'title' => 'Медиаплеер Rombica FLY',
                'amount' => 14,
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
