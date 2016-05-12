<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('files', function(Blueprint $table)
		{
			$table->increments('id') ;                  //文件id
			$table->string('file_url') ;                //文件地址
			$table ->string('file_name');   //文件名
			$table ->string('file_ext');    //文件扩展名
			$table->string('file_type') ;               //文件类型
			$table->string('file_md5');                 //文件md5
			$table->integer('file_size');               //文件大小
			$table->softDeletes();
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
		Schema::drop('files');
	}

}
