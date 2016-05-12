<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class PhoneRequest extends Request {

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
            'investor_id'=>'投资人id',
            'phone'=>'电话',
            'text'=>'内容',
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
//            'investor_id'=>'required',
//            'phone'=>'required',
//            'text'=>'required',

        ];
    }

}
