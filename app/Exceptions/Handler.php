<?php namespace App\Exceptions;

use Exception;
use GuzzleHttp\Message\Response;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler {

	/**
	 * A list of the exception types that should not be reported.
	 *
	 * @var array
	 */
	protected $dontReport = [
		'Symfony\Component\HttpKernel\Exception\HttpException'
	];

	/**
	 * Report or log an exception.
	 *
	 * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
	 *
	 * @param  \Exception  $e
	 * @return void
	 */
	public function report(Exception $e)
	{
		return parent::report($e);
	}

	/**
	 * Render an exception into an HTTP response.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Exception  $e
	 * @return \Illuminate\Http\Response
	 */
	public function render($request, Exception $e)
	{
		$view = parent::render($request, $e);
		if (!$request->ajax() && !$request->wantsJson())
			return $view;

		$level      = 'error';
		$statusCode = $view->getStatusCode();

		switch (get_class($e)) {
			case 'App\Exceptions\NotFoundException':
			case 'App\Exceptions\SignUpException':
			case 'App\Exceptions\SignInException':
			case 'App\Exceptions\FileUploadException':
			case 'App\Exceptions\DataException':
				$level = 'warning';
				break;
		}

		$message = $e->getMessage();
		if (!$message) {
			switch (get_class($e)) {
				case 'Illuminate\Session\TokenMismatchException':
					$message = 'TokenMismatchException';
					break;
				default:
					$message = class_basename($e);
			}
		}

		if (config('app.debug'))
			return \Response::json([
				'exception' => class_basename($e),
				'code'      => $e->getCode(),
				'level'     => $level,
				'message'   => $message,
				'trace'     => $e->getTraceAsString(),
			], $statusCode);

		return \Response::json([
			'exception' => class_basename($e),
			'code'      => $e->getCode(),
			'level'     => $level,
			'message'   => $message,
		], $statusCode);
	}
}
