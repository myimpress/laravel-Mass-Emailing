<?php namespace App\Http\Requests;

use App\Investor;

class InvestorRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	public function attributes()
	{
		return [
			'name'=>'投资人名',
			'company'=>'公司名字',
			'title'=>'职位',
			'telephone'=>'座机',
			'mobile'=>'电话',
			'past_case'=>'电话',
			'status'=>'电话',
			'flag'=>'市',
			'wechat'=>'市',
			'referrer'=>'市',
			'email'=>'邮件',
			'addr'=>'省',
			'field'=>'市',
			'invest_min'=>'最小值',
			'invest_max'=>'最大值',
			'kpi'=>'kpi',
		];
	}
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
//			'name'=>'required',
//			'company'=>'required',
//			'title'=>'required',
//			'telephone'=>'required',
//			'mobile'  =>'required',
//			'past_case'=>'required',
//			'status'=>'required',
//			'flag'=>'required',
//			'wechat'=>'required',
//			'referrer'=>'required',
//			'email'=>'required',
//			'addr'=>'required',
//			'field'=>'required',
//			'invest_min'=>'required',
//			'invest_max'=>'required',
//			'kpi'=>'required',
		];
	}

	/**
	 * @param $investorEmail      邮件名字已经存在
	 * @return bool
	 */
	public static function InvestorEmailExists($investorEmail)
	{
		if(Investor::whereEmail($investorEmail)->exists()){
			return true;
		}
		return false;
	}
}
