<?php

namespace App\Services\MortgageCalculator\Implementations;

use App\Models\ExtraRepaymentSchedule;
use App\Services\MortgageCalculator\AmortizationScheduleServiceInterface;
use App\Services\MortgageCalculator\MortgageParameters;
use App\Traits\EffectiveInterestRateCalculatorTrait;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class ExtraRepaymentScheduleService implements AmortizationScheduleServiceInterface {

    use EffectiveInterestRateCalculatorTrait;

    public function calculateSchedule(MortgageParameters $mortgageParameters): array {

        $amortizationSchedule = [];

        $loanAmount = $mortgageParameters->getLoanAmount();
        $monthlyPayment = $mortgageParameters->getMonthlyPayments();
        $monthlyInterestRate = $mortgageParameters->getMonthlyInterestRate();
        $loanTermMonths = $mortgageParameters->getLoanTermMonths();
        $extraRepayment = $mortgageParameters->getExtraRepayment();

        $startingBalance = $loanAmount;
        $remainingLoanTerm = $loanTermMonths;

        $month = 1;

        // Continue the loop while there is still a remaining balance to amortize
        while ($startingBalance > 0) {

            // Calculate the interest component for the current month
            $interestComponent = $startingBalance * $monthlyInterestRate;

            // Check if the sum of interest, starting balance, and extra repayment is less than or equal to the monthly payment
            if (($interestComponent + $startingBalance + $extraRepayment) <= $monthlyPayment) {
                // If the condition is met, adjust the monthly payment to match the sum of interest, starting balance, and extra repayment
                $monthlyPayment = $startingBalance + $interestComponent - $extraRepayment;
            }

            // Calculate the principal component of the payment for the current month
            $principalComponent = $monthlyPayment - $interestComponent;

            // Calculate the ending balance after deducting the principal payment
            $endingBalance = $startingBalance - $principalComponent;

            // Deduct the extra repayment from the ending balance
            $endingBalance -= $extraRepayment;

            // Decrement the remaining loan term (number of months remaining in the loan)
            $remainingLoanTerm--;

            $amortizationSchedule[] = [
                'month_number' => $month,
                'starting_balance' => $startingBalance,
                'monthly_payment' => $monthlyPayment,
                'principal_component' => $principalComponent,
                'interest_component' => $interestComponent,
                'extra_repayment' => $extraRepayment,
                'ending_balance' => $endingBalance,
                'remaining_loan_term' => $remainingLoanTerm,
            ];

            $startingBalance = $endingBalance;
            $month++;
        }

        return $amortizationSchedule;
    }

    public function saveAmortizationSchedule($amortizationSchedule): void {

        ExtraRepaymentSchedule::truncate();
        DB::table((new ExtraRepaymentSchedule)->getTable())->insert($amortizationSchedule);
    }

    public function getMortgagePlan(MortgageParameters $mortgageParameters, array $amortizationSchedule): array {

        return [
            'mortgage_details' => $mortgageParameters->mortgageDetails(),
            'shorten_length' => $this->calculateLoanShortenPeriod($mortgageParameters, end($amortizationSchedule)['month_number']),
            'effective_interest_rate' => $this->getEffectiveInterestRate($mortgageParameters),
            'updated_amortization_schedule' => $this->retrieveAllExtraRepaymentSchedules()
        ];

    }

    private function retrieveAllExtraRepaymentSchedules(): Collection {
        return ExtraRepaymentSchedule::all();
    }

    /**
     * Calculate the remaining loan period in months.
     */
    private function calculateLoanShortenPeriod(MortgageParameters $mortgageParameters, int $monthNumber): int {
        $totalMonths = $mortgageParameters->getLoanTermMonths();
        return $totalMonths - $monthNumber;
    }

    /**
     * Calculate and return the effective interest rate based on mortgage parameters.
     *
     * @param MortgageParameters $mortgageParameters The mortgage parameters.
     * @return float|int The calculated effective interest rate.
     */
    private function getEffectiveInterestRate(MortgageParameters $mortgageParameters): float|int {

        // Extract mortgage parameters for clarity
        $loanAmount = $mortgageParameters->getLoanAmount();
        $monthlyPayments = $mortgageParameters->getMonthlyPayments();
        $loanTermMonths = $mortgageParameters->getLoanTermMonths();
        $extraRepayment = $mortgageParameters->getExtraRepayment();
        $monthlyInterestRate = $mortgageParameters->getMonthlyInterestRate();

        // Calculate and return the effective interest rate
        return $this->calculateEffectiveInterestRate($loanAmount, $monthlyPayments, $loanTermMonths, $extraRepayment, $monthlyInterestRate);
    }

}
