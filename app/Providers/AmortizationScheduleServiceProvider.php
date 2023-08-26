<?php

namespace App\Providers;

use App\Services\MortgageCalculator\AmortizationScheduleServiceInterface;
use App\Services\MortgageCalculator\Implementations\ExtraRepaymentScheduleService;
use App\Services\MortgageCalculator\Implementations\LoanAmortizationScheduleService;
use Illuminate\Support\ServiceProvider;

class AmortizationScheduleServiceProvider extends ServiceProvider {

    public function register() {
        $this->app->bind(AmortizationScheduleServiceInterface::class, function ($app) {
            $requestData = $app['request']->all(); // Access request data

            if (isset($requestData['monthly_extra_payment'])) {
                // If monthly_extra_payment is set in the request data, use ExtraRepaymentScheduleService
                return new ExtraRepaymentScheduleService();
            } else {
                // If monthly_extra_payment is not set, use LoanAmortizationScheduleService
                return new LoanAmortizationScheduleService();
            }
        });
    }
}
