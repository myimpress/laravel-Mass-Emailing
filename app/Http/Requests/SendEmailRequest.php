<?php namespace App\Http\Requests;

class SendEmailRequest extends Request
{
    /**
     * 验证邮箱获取验证码的邮箱格式
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function attributes()
    {
        return [
            'email' => 'Email',
        ];
    }

    public function rules()
    {
        return [
            'email' => 'required|email',
        ];
    }
}