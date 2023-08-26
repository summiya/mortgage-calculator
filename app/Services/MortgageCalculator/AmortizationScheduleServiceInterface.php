<?php

namespace App\Services\MortgageCalculator;

/**
 * Interface AmortizationScheduleServiceInterface
 * Provides methods for calculating amortization schedules, saving them, and getting mortgage plans.
 */
interface AmortizationScheduleServiceInterface {

    /**
     * Calculate an amortization schedule based on given mortgage parameters.
     *
     * @param MortgageParameters $mortgageParameters The mortgage parameters for the calculation.
     * @return array An array representing the calculated amortization schedule.
     */
    public function calculateSchedule(MortgageParameters $mortgageParameters): array;

    /**
     * Save an amortization schedule.
     *
     * @param array $amortizationSchedule The amortization schedule to be saved.
     * @return void
     */
    public function saveAmortizationSchedule(array $amortizationSchedule): void;

    /**
     * Get a mortgage plan based on mortgage parameters and an amortization schedule.
     *
     * @param MortgageParameters $mortgageParameters The mortgage parameters for the plan.
     * @param array $amortizationSchedule The amortization schedule to be used for the plan.
     * @return array An array representing the mortgage plan.
     */
    public function getMortgagePlan(MortgageParameters $mortgageParameters, array $amortizationSchedule): array;

}
