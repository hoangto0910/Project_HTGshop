<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->mediumText('email');
            $table->mediumText('name')->comment('Họ tên đầy đủ');
            $table->integer('phone')->comment('Số điện thoại');
            $table->mediumText('address')->comment('Địa chỉ');
            $table->tinyInteger('role')->comment('Phân quyền');
            $table->mediumText('remember_token')->comment('Token để nhớ đăng nhập');     
            $table->timestamp('email_verified_at')->nullable()->default(null);
            $table->timestamp('deleted_at')->nullable()->default(null)->comment('Thời gian đánh dấu xóa(Xóa mềm)');
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
        Schema::dropIfExists('users');
    }
}
