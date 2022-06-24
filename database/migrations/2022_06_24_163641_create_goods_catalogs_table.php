<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods_catalogs', function (Blueprint $table) {
            $table->id();

            $table->string('item');
            $table->string('code');
            $table->string('denomination');

            $table->foreignId('goods_group_id')
                ->nullable()
                ->unsigned()
                ->constrained('goods_groups')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignId('goods_class_id')
                ->nullable()
                ->unsigned()
                ->constrained('goods_classes')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->string('resolution');
            $table->boolean('is_active')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('goods_catalogs');
    }
};
