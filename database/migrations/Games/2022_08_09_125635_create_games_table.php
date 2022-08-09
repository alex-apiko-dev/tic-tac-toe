<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Game\Domain\Game\Game;

return new class extends Migration
{
    public function up()
    {
        Schema::create(Game::TABLE_NAME, function (Blueprint $table) {
            $table->id();
            $table->json(Game::BOARD);
            $table->unsignedInteger(Game::FIRST_PLAYER_SCORE)->default(0);
            $table->unsignedInteger(Game::SECOND_PLAYER_SCORE)->default(0);
            $table->string(Game::CURRENT_TURN, 1)->default(Game::FIRST_PLAYER_SIGN);
            $table->string(Game::VICTORY, 16)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists(Game::TABLE_NAME);
    }
};
