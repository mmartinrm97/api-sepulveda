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
        Schema::create('goods', function (Blueprint $table) {
            $table->id();

            $table->string('code');
            $table->string('description');
            $table->string('trademark')->nullable();
            $table->string('model')->nullable();
            $table->string('type')->nullable();
            $table->string('color')->nullable();
            $table->string('series')->nullable();
            $table->string('state_of_conservation')->nullable();
            $table->date('date_acquired')->nullable();
            $table->float('value',16,2)->nullable();
            $table->string('observations')->nullable();
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
        Schema::dropIfExists('goods');
    }
};
