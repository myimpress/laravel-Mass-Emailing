<?php namespace App\Services;

use App\Files;
use Carbon\Carbon;
use File;
use Storage;

class FileManager
{
    public static function UploadFile($filePath,$fileName)
    {
        $fileMd5 = md5($filePath);
        $now = Carbon::now();
        $toDirPath = $now->year.'/'.$now->month.'/'.$now->day;
        $toFilePath = $toDirPath.'/'.$fileMd5;

        Storage::disk()->makeDirectory($toDirPath);
        if(!Storage::disk()->exists($toFilePath)){
            Storage::disk()->put($toFilePath,File::get($filePath));
        }

        File::delete($filePath);

        $fileSize = Storage::disk()->size($toFilePath);
        $fileType = File::extension($fileName);
        $mimeType = Storage::disk()->mimeType($toFilePath);
        $files = Files::whereFileMd5($fileMd5)->whereFileSize($fileSize)->first();

        if(!$files){
            $files = new Files();
            $files->file_name = $fileName;
            $files->file_url = $toDirPath;
            $files->file_type = ".".$fileType;
            $files->file_md5 = $fileMd5;
            $files->file_size = $fileSize;
            $files->file_ext = $mimeType;
            $files->save();
        }

        return $files;
    }
}