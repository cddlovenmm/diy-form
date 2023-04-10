<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiyFormDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diy_form_data', function (Blueprint $table) {
            $table->id();
            $table->integer('form_id')->nullable(false)->default(0)->comment('表单id');
            $table->text('data')->comment('表单数据');
            $table->timestamps();

            $table->index(['form_id'], 'IDX_FID');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('diy_form_data');
    }
}
