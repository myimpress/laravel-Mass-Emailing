<?php namespace App\Exceptions;

use Exception;

class InvestorException extends Exception
{
    /**
     * InvestorException        邮件名字已经存在
     */

    const InvestorNameNUll        = 0x01 ;
    const InvestorEmailExists     = 0x02 ;
    const InvestorEmailNull       = 0x03 ;

    public function __construct($code, array $data = [], Exception $previous = null)
    {
        switch ($code) {
            case self::InvestorNameNUll:
                $message = trans("投资人不能为空");
                break;
            case self::InvestorEmailExists:
                $message = trans('邮箱已存在');
                break;
            case self::InvestorEmailNull:
                $message = trans('邮箱不能为空');
                break;
            default:
                $message = trans('general.unknown_exception');
                break;
        }


        parent::__construct($message, $code, $previous);
    }
}