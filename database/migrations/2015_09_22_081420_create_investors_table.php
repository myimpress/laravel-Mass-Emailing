<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvestorsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('investors', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name')->nullable();			//投资人姓名
			$table->string('company')->nullable();		//公司
			$table->string('title')->nullable();		//职位
			$table->string('telephone')->nullable();			//座机
			$table->string('mobile')->nullable();		//电话
			$table->string('past_case')->nullable();		//领投人\
			$table->string('status')->nullable();		//领投人\
			$table->string('flag')->nullable();					//认证
			$table->string('wechat')->nullable();				//微信
			$table->string('addr')->nullable();			//地址
			$table->string('referrer')->nullable();			//推荐人
			$table->string('email')->nullable();		//邮件
			$table->string('field')->nullable();		//领域
			$table->string('invest_min')->nullable();
			$table->string('invest_max')->nullable();
			$table->integer('kpi')->nullable();
			$table->integer('role')->nullable();
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
		Schema::drop('investors');
	}

}
