<?php namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Phones
 *
 * @property integer $id
 * @property string $investor_id
 * @property string $phone
 * @property string $text
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Phones whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Phones whereInvestorId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Phones wherePhone($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Phones whereText($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Phones whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Phones whereUpdatedAt($value)
 */
class Phones extends Model {

	protected $table = 'phones';

}
