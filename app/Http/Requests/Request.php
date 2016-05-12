<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

abstract class Request extends FormRequest
{

    public function rules()
    {
        //
    }

    public function authorize()
    {
        //
    }

    public function forbiddenResponse()
    {

        if ($this->ajax() || $this->wantsJson()) {
            return response()->json([
                'exception' => 'RequestValidationException',
                'code'      => 0,
                'level'     => 'warning',
                'message'   => trans('general.form.validation.forbidden'),
                'redirect'  => '',
            ], 403);
        }

        return response('Forbidden', 403);
    }

    public function response(array $errors)
    {
        if ($this->ajax() || $this->wantsJson()) {
            return response()->json([
                'exception' => 'RequestValidationException',
                'code'      => 0,
                'level'     => 'warning',
                'message'   => trans('general.form.validation.fail'),
                'data'      => $errors,
                'redirect'  => '',
            ], 422);
        }

        return $this->redirector->to($this->getRedirectUrl())
            ->withInput($this->except($this->dontFlash))
            ->withErrors($errors, $this->errorBag);
    }
}
