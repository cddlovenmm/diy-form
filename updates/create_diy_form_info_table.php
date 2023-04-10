<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiyFormInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diy_form_info', function (Blueprint $table) {
            $table->id();
            $table->integer('form_id')->nullable(false)->default(0)->comment('表单id');
            $table->string('channel')->nullable(false)->default('')->comment('渠道');
            $table->string('images')->nullable(false)->default('')->comment('图片');
            $table->string('admin_name')->nullable(false)->default('')->comment('管理员姓名');
            $table->string('admin_avater')->nullable(false)->default('')->comment('管理员头像');
            $table->string('admin_job')->nullable(false)->default('')->comment('管理员职位');
            $table->string('admin_message')->nullable(false)->default('')->comment('管理员信息');

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
        Schema::dropIfExists('diy_form_info');
    }
}
