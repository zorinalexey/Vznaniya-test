<?php

use App\Models\User;
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
        Schema::create((new User())->getTable(), static function (Blueprint $table) {
            $table->id();
            $table->string('surname')->nullable()->default(null);
            $table->string('name');
            $table->string('middlename')->nullable()->default(null);
            $table->date('birth_date')->nullable()->default(null);
            $table->string('city')->nullable()->default(null);
            $table->string('email')->unique();
            $table->string('password')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists((new User())->getTable());
    }
};
