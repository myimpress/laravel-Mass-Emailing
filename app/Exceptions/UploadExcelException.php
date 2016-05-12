<?php namespace App\Exceptions;
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/10/22
 * Time: 9:42
 */
use Exception;

class UploadExcelException extends Exception
{
    const FileNull =0x01;
    const FileNotXls = 0x02;
    const FileContent = 0x03;

    function __construct($code,array $data=[],Exception $previous = null)
    {
        switch ($code){
            case self::FileNull:
                $message = trans('不能为空');
                break;
            case self::FileNotXls:
                $message = trans('不是excel文件,请上传正确的文件');
                break;
            case self::FileContent:
                $message = trans('字段名错误,请上传正确的文件');
                break;
            default:
                $message = trans('general.unknown_exception');
                break;
        }
        parent::__construct($message,$code,$previous);
    }
}