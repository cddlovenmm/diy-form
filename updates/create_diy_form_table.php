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
            $table->text('field_data')->comment('表单字段');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('diy_form_redirect_uri', function (Blueprint $table) {
            $table->id();
            $table->string('uri')->default('')->nullable(false)->default('跳转地址');
            $table->timestamps();
        });

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

        Schema::create('diy_form_data', function (Blueprint $table) {
            $table->id();
            $table->integer('form_id')->nullable(false)->default(0)->comment('表单id');
            $table->text('data')->comment('表单数据');
            $table->timestamps();

            $table->index(['form_id'], 'IDX_FID');
        });
        
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
        Schema::dropIfExists('diy_form');
        Schema::dropIfExists('diy_form_data_count');
        Schema::dropIfExists('diy_form_data');
        Schema::dropIfExists('diy_form_info');
        Schema::dropIfExists('diy_form_redirect_uri');
    }
}
