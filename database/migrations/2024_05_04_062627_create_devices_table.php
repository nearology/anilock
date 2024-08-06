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
        Schema::create('devices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->boolean("status")->default(false);
            $table->text("name");
            $table->text("ssid");
            $table->text("password");
            $table->text("imei");
            $table->boolean("ups_status")->default(false);
            $table->boolean("door_status")->default(false);
            $table->boolean("relay_module")->default(false);
            $table->unsignedTinyInteger("relay_module_terminal")->default(0);
            $table->boolean("lock_status1")->nullable();
            $table->boolean("lock_status2")->nullable();
            $table->integer("bat_status");
            $table->integer("rssi");
            $table->boolean("alarm_status");
            $table->float("temperature");
            $table->datetime("alive_at")->default("1970-01-01 00:00:00");
            $table->boolean("door_status_updated")->default(false);
            $table->boolean("alarm_status_updated")->default(false);
            $table->char("terminal1_title", 255)->default("ماژول 1");
            $table->char("terminal2_title", 255)->default("ماژول 2");
            $table->char("terminal3_title", 255)->default("ماژول 3");
            $table->char("terminal4_title", 255)->default("ماژول 4");
            $table->char("terminal5_title", 255)->default("ماژول 5");
            $table->char("terminal6_title", 255)->default("ماژول 6");
            $table->char("terminal7_title", 255)->default("ماژول 7");
            $table->char("terminal8_title", 255)->default("ماژول 8");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('devices');
    }
};
