<?php namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Groups
 *
 * @property integer $id
 * @property string $invest_group
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Groups whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Groups whereInvestGroup($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Groups whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Groups whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Groups whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Investor[] $invest_x_groups
 */
class Groups extends Model {

	protected $table = 'groups';

    public function invest_x_groups(){
        return $this->belongsToMany('App\Investor','invest_groups','group_id','investor_id');
    }

}
