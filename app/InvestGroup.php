<?php namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\InvestGroup
 *
 * @property integer $id
 * @property integer $invest_name_id
 * @property integer $invest_group_id
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\InvestGroup whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\InvestGroup whereInvestNameId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\InvestGroup whereInvestGroupId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\InvestGroup whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\InvestGroup whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\InvestGroup whereUpdatedAt($value)
 * @property integer $investor_id
 * @property integer $group_id
 * @method static \Illuminate\Database\Query\Builder|\App\InvestGroup whereInvestorId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\InvestGroup whereGroupId($value)
 */
class InvestGroup extends Model {

	//

}
