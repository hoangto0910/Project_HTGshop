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
            $table->string('name')->comment('Họ tên đầy đủ')->nullable()->default(null);
            $table->integer('phone')->comment('Số điện thoại')->nullable()->default(null);
            $table->string('address')->comment('Địa chỉ')->nullable()->default(null);
            $table->string('email')->nullable()->default(null);
            $table->string('password')->default(null);
            $table->integer('role')->comment('Phân quyền')->nullable()->default(null);
            $table->string('remember_token')->comment('Token để nhớ đăng nhập')->nullable()->default(null);     
            $table->timestamp('email_verified_at')->nullable()->nullable()->default(null)->comment('time email xác nhận tài khoản');
            $table->timestamp('deleted_at')->nullable()->nullable()->default(null)->comment('Thời gian đánh dấu xóa(Xóa mềm)');
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
