<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Logic\TranslationRepostory;

class CreateTranslationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('translation', function (Blueprint $table) {
            $table->increments('id');
            $table->text('en');
            $table->text('ar');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $translationRepostory = new TranslationRepostory;

        if($translationRepostory->storeData())
            Schema::drop('translation');
    }
}
