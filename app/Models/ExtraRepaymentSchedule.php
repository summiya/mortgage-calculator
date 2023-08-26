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
 * @property int $extra_repayment
 * @property float $ending_balance
 * @property int $remaining_loan_term
 * @property DateTime $created_at
 * @property DateTime $updated_at
 *
 * Class LoanAmortizationSchedule
 */
class ExtraRepaymentSchedule extends Model {

    use HasFactory;

    public $timestamps = true;
    protected $table = 'extra_repayment_schedules';

    protected $primaryKey = 'id';
    public $incrementing = true;

    protected $fillable = [
        'id',
        'month_number',
        'starting_balance',
        'monthly_payment',
        'principal_component',
        'interest_component',
        'extra_repayment',
        'ending_balance',
        'remaining_loan_term'
    ];

    protected $visible = [
        'id',
        'month_number',
        'starting_balance',
        'monthly_payment',
        'principal_component',
        'interest_component',
        'extra_repayment',
        'ending_balance',
        'remaining_loan_term',
        'created_at',
        'updated_at'
    ];

    protected array $dates = [
        'created_at',
        'updated_at'
    ];

}
