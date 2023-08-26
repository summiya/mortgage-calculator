<?php

namespace App\Traits;

trait EffectiveInterestRateCalculatorTrait {

    /**
     * Calculate the effective annual interest rate based on mortgage parameters.
     *
     * @param float $loanAmount The initial loan amount.
     * @param float $monthlyPayments The fixed monthly payments.
     * @param int $loanTermMonths The loan term in months.
     * @param float $extraRepaymentAmount The additional repayment amount per month.
     * @param float $monthlyInterestRate The monthly interest rate.
     * @return float The calculated effective annual interest rate.
     */
    public function calculateEffectiveInterestRate(float $loanAmount, float $monthlyPayments, int $loanTermMonths, float $extraRepaymentAmount, float $monthlyInterestRate): float {

        $remainingBalance = $loanAmount;
        $totalInterestPaid = 0;

        for ($month = 1; $month <= $loanTermMonths; $month++) {
            $interest = $remainingBalance * $monthlyInterestRate;
            $principal = $monthlyPayments - $interest + $extraRepaymentAmount;

            $remainingBalance -= $principal;
            $totalInterestPaid += $interest;

            if ($remainingBalance <= 0) {
                break;
            }
        }

        // Calculate and return the effective annual interest rate
        return ($totalInterestPaid / $loanAmount) * 12 * 100;
    }
}
