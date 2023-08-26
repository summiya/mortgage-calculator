<?php

namespace App\Services\MortgageCalculator;

/**
 * Class MortgageParameters
 * @package MortgageParameters
 */
class MortgageParameters {
    /**
     * The period when the debtor
     * must pay off the debt
     *
     * @var integer
     */
    protected int $loanTerm;

    /**
     * Customer loan amount
     *
     * @var integer
     */
    protected int $loanAmount;

    /**
     * Interest rate - provided by creditor
     *
     * @var float
     */
    protected float $annualInterestRate;

    /**
     * EXtra Repayments every month
     *
     * @var int
     */
    protected int $extraRepayment = 0;

    /**
     * set loan term
     *
     * @param $loanTerm
     * @return void
     */
    public function setLoanTerm($loanTerm): void {
        $this->loanTerm = $loanTerm;
    }

    /**
     * Retrieves loan term
     *
     * @return integer
     */
    public function getLoanTerm(): int {
        return $this->loanTerm;
    }

    /**
     * set loan Amount
     *
     * @param $loanAmount
     * @return void
     */
    public function setLoanAmount($loanAmount): void {
        $this->loanAmount = $loanAmount;
    }

    /**
     * Retrieves loan Amount
     *
     * @return integer
     */
    public function getLoanAmount(): int {
        return $this->loanAmount;
    }

    /**
     * set Annual Interest Rate
     *
     * @param $annualInterestRate
     * @return void
     */
    public function setAnnualInterestRate($annualInterestRate): void {
        $this->annualInterestRate = $annualInterestRate;
    }

    /**
     * Retrieves Annual interest rate
     *
     * @return mixed [integer/float]
     */
    public function getAnnualInterestRate(): float {
        return $this->annualInterestRate;
    }

    /**
     * set Extra Repayment
     *
     * @param $extraRepayment
     * @return void
     */
    public function setExtraRepayment($extraRepayment): void {
        $this->extraRepayment = $extraRepayment;
    }

    /**
     * Retrieves Extra Repayment
     *
     * @return integer
     */
    public function getExtraRepayment(): int {
        return $this->extraRepayment;
    }

    /**
     * Calculate Monthly Interest Rate
     *
     * @return float
     */
    public function getMonthlyInterestRate(): float {
        return ($this->annualInterestRate / 12) / 100; // Calculate monthly interest rate
    }

    /**
     * Calculate loan term in Months
     *
     * @return int
     */
    public function getLoanTermMonths(): int {
        return $this->getLoanTerm() * 12;
    }

    /**
     * Calculate monthly Payment
     *
     * @return float
     */
    public function getMonthlyPayments(): float {
        $monthlyInterestRate = $this->getMonthlyInterestRate();
        $loanTermMonths = $this->getLoanTermMonths();
        return ($this->loanAmount * $this->getMonthlyInterestRate()) / (1 - pow(1 + $monthlyInterestRate, -$loanTermMonths));
    }

    public function mortgageDetails(): array {
        return [
            'loan_term' => $this->getLoanTerm(),
            'loan_amount' => $this->getLoanAmount(),
            'interest_rate' => $this->getAnnualInterestRate()
        ];
    }
}
