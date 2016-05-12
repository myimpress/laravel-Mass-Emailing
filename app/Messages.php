<?php namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Messages
 *
 * @property integer $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Messages whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Messages whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Messages whereUpdatedAt($value)
 * @property string $theme
 * @property integer $file_id
 * @property integer $investor_group_id
 * @property string $text
 * @property integer $user_id
 * @property integer $investor_id
 * @property integer $state
 * @property string $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\Messages whereTheme($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Messages whereFileId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Messages whereInvestorGroupId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Messages whereText($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Messages whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Messages whereInvestorId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Messages whereState($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Messages whereDeletedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\File[] $file
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Investor[] $investor
 */
class Messages extends Model {

	protected $table = 'messages';

    public function file(){
        return $this->hasMany('App\File','file_id');
    }

    public function investor(){
        return $this->hasMany('App\Investor','investor_id');
    }

}
