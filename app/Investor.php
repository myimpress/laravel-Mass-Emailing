<?php namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;


/**
 * App\Investor
 *
 * @property integer $id
 * @property string $name
 * @property string $company
 * @property string $title
 * @property string $telephone
 * @property string $mobile
 * @property string $past_case
 * @property string $status
 * @property string $flag
 * @property string $wechat
 * @property string $addr
 * @property string $referrer
 * @property string $email
 * @property string $field
 * @property string $invest_min
 * @property string $invest_max
 * @property integer $kpi
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Messages $messages
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Groups[] $invest_x_groups
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Types[] $invest_x_types
 * @method static \Illuminate\Database\Query\Builder|\App\Investor whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Investor whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Investor whereCompany($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Investor whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Investor whereTelephone($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Investor whereMobile($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Investor wherePastCase($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Investor whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Investor whereFlag($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Investor whereWechat($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Investor whereAddr($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Investor whereReferrer($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Investor whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Investor whereField($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Investor whereInvestMin($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Investor whereInvestMax($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Investor whereKpi($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Investor whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Investor whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Investor whereUpdatedAt($value)
 * @property integer $role
 * @method static \Illuminate\Database\Query\Builder|\App\Investor whereRole($value)
 */
class Investor extends Model {

	protected $table = 'investors';

    public function messages(){
        return $this->belongsTo('App\Messages','investor_id');
    }

    public function invest_x_groups(){
        return $this->belongsToMany('App\Groups','invest_groups','investor_id','group_id');
    }


    public function invest_x_types(){
        return $this->belongsToMany('App\Types','invest_types','investor_id','type_id');
    }

}
