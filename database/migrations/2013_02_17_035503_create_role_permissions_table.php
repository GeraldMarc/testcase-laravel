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
        Schema::create('role_permission', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('role_id')->unsigned();
            $table->foreign('role_id')
            ->references('id')->on('roles')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->bigInteger('permission_id')->unsigned();
            $table->foreign('permission_id')
            ->references('id')->on('permissions')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('role_permission');
    }
};
