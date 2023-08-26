<?php

namespace App\Services\MortgageCalculator\Implementations;

use App\Models\LoanAmortizationSchedule;
use App\Services\MortgageCalculator\AmortizationScheduleServiceInterface;
use App\Services\MortgageCalculator\MortgageParameters;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class LoanAmortizationScheduleService implements AmortizationScheduleServiceInterface {

    public function calculateSchedule(MortgageParameters $mortgageParameters): array {

        $amortizationSchedule = [];

        $loanAmount = $mortgageParameters->getLoanAmount();
        $monthlyPayment = $mortgageParameters->getMonthlyPayments();
        $monthlyInterestRate = $mortgageParameters->getMonthlyInterestRate();
        $loanTermMonths = $mortgageParameters->getLoanTermMonths();

        $remainingBalance = $loanAmount;

        // Loop through each month of the loan term
        for ($month = 1; $month <= $loanTermMonths; $month++) {

            // Calculate the interest payment for the current month based on the remaining balance
            $interestPayment = $remainingBalance * $monthlyInterestRate;

            // Calculate the principal payment for the current month by subtracting interest payment from the monthly payment
            $principalPayment = $monthlyPayment - $interestPayment;

            // Calculate the ending balance after deducting the principal payment
            $endingBalance = $remainingBalance - $principalPayment;

            // Build an array representing the details of this month's amortization
            $amortizationSchedule[] = [
                'month_number' => $month,
                'starting_balance' => $remainingBalance,
                'monthly_payment' => $monthlyPayment,
                'principal_component' => $principalPayment,
                'interest_component' => $interestPayment,
                'ending_balance' => $endingBalance,
            ];

            // Update the remaining balance to the ending balance for the next iteration
            $remainingBalance = $endingBalance;
        }

        return $amortizationSchedule;
    }

    public function saveAmortizationSchedule($amortizationSchedule): void {
        LoanAmortizationSchedule::truncate();
        DB::table((new LoanAmortizationSchedule)->getTable())->insert($amortizationSchedule);
    }

    public function getMortgagePlan(MortgageParameters $mortgageParameters, array $amortizationSchedule): array {

        return [
            'mortgage_details' => $mortgageParameters->mortgageDetails(),
            'initial_amortization_schedule' => $this->retrieveAllLoanAmortizationSchedules()
        ];
    }

    private function retrieveAllLoanAmortizationSchedules(): Collection {
        return LoanAmortizationSchedule::all();
    }

}
