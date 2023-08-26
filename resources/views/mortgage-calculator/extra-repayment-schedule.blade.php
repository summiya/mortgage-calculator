<div id="content-table">
        <div class="alert alert-success">
            Wow!!! Loan Term Shorten by {{ $data['shorten_length'] }} Months
        </div>

    <table id="updatedAmortizationTable" class="display" style="width:100%">
        <thead>
        <tr>
            <th scope="col">Total Years</th>
            <th scope="col">{{ $data['mortgage_details']['loan_term']}}</th>
            <th scope="col">Interest Rate</th>
            <th scope="col">{{ $data['mortgage_details']['interest_rate']}}%</th>
            <th scope="col">Loan Amount</th>
            <th scope="col">{{ $data['mortgage_details']['loan_amount']}}</th>
            <th scope="col">Effective Interest Rate due to Extra Payment </th>
            <th scope="col">{{ round($data['effective_interest_rate'])}}%</th>
        </tr>

        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <th scope="col">Month</th>
            <th scope="col">Starting Balance</th>
            <th scope="col">Monthly payment</th>
            <th scope="col">Principal Component</th>
            <th scope="col">Interest Component</th>
            <th scope="col">Extra Payment</th>
            <th scope="col">Ending Balance</th>
            <th scope="col">Remaining Loan Term</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data['updated_amortization_schedule'] as $data)
            <tr>
                <td>@isset($data->month_number) {{ $data->month_number }} @endisset </td>
                <td>@isset($data->starting_balance) {{ $data->starting_balance }} @endisset</td>
                <td>@isset($data->monthly_payment) {{ $data->monthly_payment }} @endisset</td>
                <td>@isset($data->principal_component) {{ $data->principal_component }} @endisset</td>
                <td>@isset($data->interest_component) {{ $data->interest_component }} @endisset</td>
                <td>@isset($data->extra_repayment) {{ $data->extra_repayment }} @endisset</td>
                <td>@isset($data->ending_balance) {{ $data->ending_balance }} @endisset</td>
                <td>@isset($data->remaining_loan_term) {{ $data->remaining_loan_term }} @endisset</td>
            </tr>
        @endforeach
        </tbody>
        <tfoot>
        <tr>
            <th scope="col">Month</th>
            <th scope="col">Starting Balance</th>
            <th scope="col">Monthly payment</th>
            <th scope="col">Principal Component</th>
            <th scope="col">Interest Component</th>
            <th scope="col">Extra Payment</th>
            <th scope="col">Ending Balance</th>
            <th scope="col">Remaining Loan Term</th>
        </tr>
        </tfoot>
    </table>
</div>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script>
    $('#updatedAmortizationTable').DataTable({
        pagingType: 'full_numbers',
    });
</script>
