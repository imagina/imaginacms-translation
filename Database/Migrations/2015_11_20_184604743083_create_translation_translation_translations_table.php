<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('translation__translation_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->text('value');

            $table->integer('translation_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['translation_id', 'locale'], 'translations_trans_id_locale_unique');
            $table->foreign('translation_id')->references('id')->on('translation__translations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::drop('translation__translation_translations');
    }
};
