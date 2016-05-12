<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class MessageRequest extends Request {

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
        return[
            'theme'=>'主题',
            'file_id'=>'附件id',
            'investor_group_id'=>'分组id',
            'text'=>'正文',
            'user_id'=>'用户id',
            'investor_id'=>'投资id',
            'state'=>'发送状态',
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
//            'theme'=>'required',
//			'file_id'=>'required',
//			'investor_group_id'=>'required',
//			'text'=>'required',
//			'user_id'=>'required',
//			'investor_id'=>'required',
//			'state'=>'required',
        ];
    }

}
