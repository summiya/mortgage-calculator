<?php

namespace App\Services\MortgageCalculator;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * Class MortgageComposer
 *
 * This class is responsible for composing a mortgage plan based on input parameters.
 *
 * @package App\Services\MortgageCalculator
 */
class MortgageComposer {

    protected AmortizationScheduleServiceInterface $amortizationScheduleService;

    public function __construct(AmortizationScheduleServiceInterface $amortizationScheduleService) {
        $this->amortizationScheduleService = $amortizationScheduleService;
    }

    /**
     * Compose a mortgage plan based on input parameters.
     *
     * @param ParameterBag $inputParameters The input parameters for composing the mortgage plan.
     * @return array An array representing the composed mortgage plan.
     * @throws ValidationException
     */
    public function compose(ParameterBag $inputParameters): array {

        // Prepare mortgage parameters from the input
        $mortgageParameters = $this->prepareMortgageParameters($inputParameters);

        // Calculate amortization schedule
        $amortizationSchedule = $this->amortizationScheduleService->calculateSchedule($mortgageParameters);

        // Save the amortization schedule
        $this->amortizationScheduleService->saveAmortizationSchedule($amortizationSchedule);

        // Get the mortgage plan using the amortization schedule and mortgage parameters
        return $this->amortizationScheduleService->getMortgagePlan($mortgageParameters, $amortizationSchedule);
    }

    /**
     * Prepare mortgage parameters based on input parameters.
     *
     * @param ParameterBag $inputParameters The input parameters for preparing mortgage parameters.
     * @return MortgageParameters The prepared mortgage parameters.
     * @throws ValidationException
     */
    protected function prepareMortgageParameters(ParameterBag $inputParameters): MortgageParameters {

        // Validate the input parameters
        $this->validateInput($inputParameters);

        // Compose mortgage parameters based on validated input
        return $this->composeMortgageParameters($inputParameters);
    }

    /**
     * Validate the input parameters and throw errors if validation fails.
     *
     * @param ParameterBag $inputParameters The input parameters to be validated.
     * @return void
     * @throws ValidationException If validation fails, an exception is thrown with validation errors.
     */
    protected function validateInput(ParameterBag $inputParameters) {

        // Define validation rules for input parameters
        $validationRules = [
            'loan_amount' => 'required|numeric|min:50000',
            'interest_rate' => 'required|numeric|min:0.1',
            'loan_term' => 'required|integer|min:1|max:25',
            'monthly_extra_payment' => 'nullable|numeric|min:1000',
        ];

        // Perform validation using Laravel Validator
        Validator::make(
            $inputParameters->all(),
            $validationRules
        )->validate();
    }

    /**
     * Compose mortgage parameters based on input parameters.
     *
     * @param ParameterBag $inputParameters The input parameters for composing mortgage parameters.
     * @return MortgageParameters The composed mortgage parameters.
     */
    public function composeMortgageParameters(ParameterBag $inputParameters): MortgageParameters {

        // Extract input parameters
        $loanAmount = $inputParameters->get('loan_amount');
        $loanTerm = $inputParameters->get('loan_term');
        $interestRate = $inputParameters->get('interest_rate');
        $monthlyExtraPayment = $inputParameters->get('monthly_extra_payment');

        // Create a new instance of MortgageParameters
        $mortgageParameters = new MortgageParameters();

        // Set properties
        $mortgageParameters->setLoanAmount($loanAmount);
        $mortgageParameters->setLoanTerm($loanTerm);
        $mortgageParameters->setAnnualInterestRate($interestRate);

        // Set extra repayment if provided in input parameters
        if ($monthlyExtraPayment !== null) {
            $mortgageParameters->setExtraRepayment($monthlyExtraPayment);
        }

        // Return the composed mortgage parameters
        return $mortgageParameters;
    }
}
