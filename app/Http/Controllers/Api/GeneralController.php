<?php namespace App\Http\Controllers\Api;

class GeneralController extends ApiController
{
    /**
     * 获取当前token
     * @return \Illuminate\View\View|\Symfony\Component\HttpFoundation\Response
     */
    public function getCsrfToken()
    {
        return $this->buildResponse(trans('api.csrf_token.get.success'),csrf_token());
    }
}