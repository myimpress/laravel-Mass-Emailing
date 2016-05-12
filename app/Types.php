<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Types
 *
 * @property integer $id
 * @property integer $type_name
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Types whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Types whereTypeName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Types whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Types whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Types whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Investor[] $invest_x_types
 */
class Types extends Model {

	protected $table = 'types';
    use SoftDeletes;
    protected $fillable  = ['id', 'type_name'];

    public function invest_x_types(){
        return $this->belongsToMany('App\Investor','invest_types','type_id','investor_id');
    }
}
