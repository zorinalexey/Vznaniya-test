<?php

use App\Models\AuthToken;
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
        Schema::create((new AuthToken())->getTable(), static function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unique();
            $table->string('token')->unique();
            $table->timestamps();

            $table->foreign('user_id')->on((new User())->getTable())->references('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists((new AuthToken())->getTable());
    }
};
