<?php

namespace Tests\Unit;

use App\Services\MortgageCalculator\MortgageComposer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;
use Tests\TestCase;

class MortgageCalculatorControllerTest extends TestCase {

    use RefreshDatabase;

    // Reset database after each test

    public function testFormValidationRequiredFields() {

        $response = $this->post('/store-form', []);

        $response->assertStatus(302)
            ->assertSessionHasErrors(['loan_amount', 'loan_term', 'interest_rate']);
    }

    /**
     * Test form validation for Valid Company Symbol.
     *
     * @return void
     */
    public function testInValidLoanAmount() {
        $data = [
            'loan_amount' => '1000',  // Invalid loan amount
            'loan_term' => '5',
            'interest_rate' => '5'
        ];

        $response = $this->post('/store-form', $data);

        $response->assertStatus(302)
            ->assertSessionHasErrors(['loan_amount']);
    }

    /**
     * Test form validation for valid email format.
     *
     * @return void
     */
    public function testInValidLoanTerm() {
        $data = [
            'loan_amount' => '1000000',
            'loan_term' => '0',
            'interest_rate' => '5'
        ];

        $response = $this->post('/store-form', $data);

        $response->assertStatus(302)
            ->assertSessionHasErrors(['loan_term']);
    }

    /**
     * Test form validation for date format.
     *
     * @return void
     */
    public function testInValidInterestRate() {
        $data = [
            'loan_amount' => '1000000',
            'loan_term' => '5',
            'interest_rate' => '0'
        ];

        $response = $this->post('/store-form', $data);

        $response->assertStatus(302)
            ->assertSessionHasErrors(['interest_rate']);
    }


    /**
     * Test form validation for start date less than End Date.
     *
     * @return void
     */
    public function testInValidExtraRepayment() {
        $data = [
            'loan_amount' => '1000000',
            'loan_term' => '5',
            'interest_rate' => '5',
            'monthly_extra_payment' => '500'
        ];

        $response = $this->post('/store-form', $data);

        $response->assertStatus(302)
            ->assertSessionHasErrors(['monthly_extra_payment']);
    }

    /**
     * Test form validation Required Dates
     *
     * @return void
     */
    public function testInValidMaxLoanTenure() {
        $data = [
            'loan_amount' => '1000000',
            'loan_term' => '30',
            'interest_rate' => '5',
            'monthly_extra_payment' => '1000'
        ];

        $response = $this->post('/store-form', $data);

        $response->assertStatus(302)
            ->assertSessionHasErrors(['loan_term']);
    }

    /**
     * Test form for Valid Input
     *
     * @return void
     */
    public function testFormValidationValidFormWithoutExtraPayment() {

        $data = [
            'loan_amount' => '1000000',
            'loan_term' => '1',
            'interest_rate' => '5',
        ];

        // Mock the FormSubmissionService
        $loanAmortizationScheduleServiceMock = Mockery::mock(MortgageComposer::class);
        $loanAmortizationScheduleServiceMock
            ->shouldReceive('compose')
            ->once()
            ->andReturn([])
            ->with($data);

        $this->app->instance(MortgageComposer::class, $loanAmortizationScheduleServiceMock);

        $loanAmortizationScheduleServiceMock->shouldReceive('compose')->once(); // Ensure it's called once.
    }

    public function testFormValidationValidFormWithExtraPayment() {

        $data = [
            'loan_amount' => '1000000',
            'loan_term' => '1',
            'interest_rate' => '5',
            'monthly_extra_payment' => '1000'
        ];

        // Mock the FormSubmissionService
        $loanAmortizationScheduleServiceMock = Mockery::mock(MortgageComposer::class);

        $loanAmortizationScheduleServiceMock
            ->shouldReceive('compose')
            ->times(1)
            ->andReturn([])
            ->with($data);

        $this->app->instance(MortgageComposer::class, $loanAmortizationScheduleServiceMock);

        $loanAmortizationScheduleServiceMock->shouldReceive('compose')->times(1); // Ensure it's called once.

    }

}
