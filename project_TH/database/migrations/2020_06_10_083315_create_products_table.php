<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->comment('Tên sản phẩm');
            $table->string('slug')->nullable()->default(null);
            $table->string('image')->nullable()->default(null)->comment('ảnh đại diện sản phẩm');
            $table->bigInteger('origin_price')->comment('Giá ban đầu')->default(null);
            $table->bigInteger('sale_price')->comment('Giá sản phẩm bán ra');
            $table->tinyInteger('discount_percent')->comment('Phần trăm giảm giá')->nullable();
            $table->string('content')->comment('Nội dung mô tả sản phẩm')->default(null);
            $table->json('config')->comment('Thông số sản phẩm')->nullable()->default(null);
            $table->tinyInteger('user_id')->comment('User tạo ra sản phẩm')->default(null);
            $table->tinyInteger('category_id')->comment('Danh mục sản phẩm')->default(null);
            $table->integer('brandname_id')->default(null)->comment('id thương hiệu');
            $table->tinyInteger('status')->comment('Trạng Thái sản phẩm')->default(null);
            $table->string('guarantee')->comment('Thời gian bảo hành')->default(null);
            $table->string('policy')->comment('chính sách sản phẩm')->nullable();
            $table->timestamp('deleted_at')->comment('Thời gian đánh dấu xóa(Xóa mềm)')->nullable()->default(null);
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
        Schema::dropIfExists('products');
    }
}
