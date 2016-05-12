<?php namespace App\Http\Controllers\Api;


use App\Files;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\File;
use App\Services\FileManager;

class FileController extends ApiController
{
	public function uploadFile(Request $request){

		$uploadFile = $request->file('file');
		$fileName = $uploadFile->getClientOriginalName();
		$fileModel = FileManager::UploadFile($uploadFile,$fileName);

		Session::put('FileId',$fileModel->id);
		if($fileModel)
			return $this->buildResponse(trans('api.bp_upload.success'),$fileModel);

	}

	public function getFileAsDownloadById($id = 0){

		/** @var Files $files */
		$files = Files::find($id);



		return \Response::download($files->getLocalPath(),urldecode($files->file_name),[],'inline');
	}
}