<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiyFormTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diy_form', function (Blueprint $table) {
            $table->id();
            $table->string('name')->default('')->nullable(false)->comment('表单名称');
            $table->tinyInteger('is_solid')->default(0)->nullable(false)->comment('是否固定模板 0否 1是');
            $table->tinyInteger('is_have_admin')->default(0)->nullable(false)->comment('是否包含管理员信息 0否 1是');
            $table->string('prefix_uri')->default('')->nullable(false)->comment('固定模板表单前缀');
            $table->text('field_data')->default('')->nullable(false)->comment('表单字段');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('diy_form');
    }
}
