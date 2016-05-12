<?php namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Files
 *
 * @property integer $id
 * @property string $file_url
 * @property string $file_name
 * @property string $file_ext
 * @property string $file_md5
 * @property string $file_size
 * @property integer $file_type
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Files whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Files whereFileUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Files whereFileName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Files whereFileExt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Files whereFileMd5($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Files whereFileSize($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Files whereFileType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Files whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Files whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Files whereUpdatedAt($value)
 * @property-read \App\Messages $messages
 */


class Files extends Model {

    protected $table = 'files';
    public function messages(){
        return $this->belongsTo('App\Messages','file_id');
    }
	//路径
    public function getLocalPath(){
        return storage_path().'/app/'.$this->file_url.'/'.$this->file_md5;
    }

}
