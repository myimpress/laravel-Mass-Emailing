<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('messages', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('theme');		//标题
			$table->integer('file_id');		//附件
			$table->integer('investor_group_id');		//组名id
			$table->string('text');			//正文
			$table->integer('user_id');		//用户id
			$table->integer('investor_id');	//投资这id
			$table->integer('state');		//状态
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
		Schema::drop('messages');
	}

}
