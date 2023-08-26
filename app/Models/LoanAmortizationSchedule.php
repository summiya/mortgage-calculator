<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 *
 * @property int $id
 * @property int $month_number
 * @property float $starting_balance
 * @property float $monthly_payment
 * @property float $principal_component
 * @property float $interest_component
 * @property float $ending_balance
 * @property DateTime $created_at
 * @property DateTime $updated_at
 *
 * Class LoanAmortizationSchedule
 */
class LoanAmortizationSchedule extends Model {

    use HasFactory;

    public $timestamps = true;
    protected $table = 'loan_amortization_schedule';

    protected $primaryKey = 'id';
    public $incrementing = true;

    public $fillable = [
        'id',
        'month_number',
        'starting_balance',
        'monthly_payment',
        'principal_component',
        'interest_component',
        'ending_balance'
    ];

    protected $visible = [
        'id',
        'month_number',
        'starting_balance',
        'monthly_payment',
        'principal_component',
        'interest_component',
        'ending_balance',
        'created_at',
        'updated_at'
    ];

    protected array $dates = [
        'created_at',
        'updated_at'
    ];

}
