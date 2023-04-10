<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiyFormDataCountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diy_form_data_count', function (Blueprint $table) {
            $table->id();
            $table->integer('form_id')->nullable(false)->default(0)->comment('表单id');
            $table->string('channel')->nullable(false)->default('')->comment('渠道');
            $table->integer('data_count')->nullable(false)->default(0)->comment('信息数量');
            $table->timestamps();

            $table->index(['channel'], 'IDX_CHANNEL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('diy_form_data_count');
    }
}
