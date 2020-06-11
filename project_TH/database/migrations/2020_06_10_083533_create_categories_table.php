<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->mediumText('name')->comment('Tên danh mục');
            $table->mediumText('slug');
            $table->tinyInteger('parent_id')->comment('id cha của danh mục hiện tại, nếu là cấp 1 thì parent null');
            $table->tinyInteger('depth')->comment('Độ sâu của danh mục');
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
        Schema::dropIfExists('categories');
    }
}
