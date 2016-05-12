<?php namespace App\Services;

use League\Flysystem\Exception;
use Requests;
use Requests_Exception;

class SendSms
{
    private $apiKey    = '';
    private $apiId     = '';
    private $project   = '';
    private $sign_type = '';
    private $baseUrl = 'https://api.submail.cn';
    private $sendSmsUrl = '/message/xsend.json';

    /**
     * @param $phone
     * @param $code
     * @return bool
     */
    public function  sendSms($phone,$code)
    {
        $result = self::doPost($this->sendSmsUrl,[
            'appid'   => $this->apiId,
            'to'      => trim($phone),
            'project' => $this->project,
            'vars'    => json_encode(self::vars($code)),
            'sign_type' => $this->sign_type,
            'signature' => $this->apiKey,
        ]);
        return $result;
    }

    /**
     * @param $code
     * @return array
     */
    public function vars($code)
    {
        return array(
            'code' =>$code
        );
    }

    /**
     * @param $url
     * @param array $param
     * @return mixed
     * @throws SendSmsException
     */
    public function doPost($url,array $param)
    {
        $response = null;
        try{
            $response = Requests::post($this->baseUrl.$url,[
                'Accept'       => 'text/plain;charset=utf-8',
                'Content-Type' => 'application/x-www-form-urlencoded;charset=utf-8',
            ],$param);
        }catch (Requests_Exception $ex)
        {
            throw new SendSmsException(SendSmsException::RequestsException,['message' => $ex->getMessage()]);
        }

        if(!$response->success){
            switch($response->status_code){
                default:
                    throw new SendSmsException(SendSmsException::HttpException);
            }
        }

        $res = json_decode($response->body);
        if(is_null($res))
            throw new SendSmsException(SendSmsException::NotJson);

        if($res->status == 'error'){
            throw new SendSmsException(SendSmsException::OutOfService,['msg' => $res->msg]);
        }
    }
}

/**
 * Class SendSmsException
 * @package App\Services
 */
class SendSmsException extends Exception
{
    const RequestsException = 0x01;
    const HttpException = 0x02;
    const OutOfService = 0x03;
    const NotJson = 0x04;

    /**
     * @param string $code
     * @param array $data
     * @param Exception $previous
     */
    public function __construct($code, array $data = [], Exception $previous = null)
    {
        switch ($code) {
            case self::RequestsException:
                $message = trans('exception.SendSms.requests_exception', []);
                break;
            case self::OutOfService:
            case self::NotJson:
                $message = trans('exception.SendSms.out_of_service', []) . ' ' . $data['msg'];
                break;
            default:
                $message = trans('general.unknown_exception');
                break;
        }

        parent::__construct($message, $code, $previous);
    }
}