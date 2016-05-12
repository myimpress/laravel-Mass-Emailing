<?php namespace App\Exceptions;

use Exception;

class SendException extends Exception{
    /**
     * 参数解析
     *
     * NoPhoneArr         为空
     *
     */
    const NoPhoneArr            = 0x01;

    /**
     * @param $code
     * @param array $data
     * @param Exception $previous
     */
    public function __construct($code, array $data = [], Exception $previous = null)
    {
        switch ($code) {
            case self::NoPhoneArr:
                $message = trans('收件人不能为空');
                break;
            default:
                $message = trans('general.unknown_exception');
                break;
        }

        parent::__construct($message, $code, $previous);
    }

}