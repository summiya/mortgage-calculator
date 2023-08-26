<div id="content-table">
    <table id="initialAmortizationTable" class="display" style="width:100%">
        <thead>
        <tr>
            <th scope="col">Total Years</th>
            <th scope="col">{{ $data['mortgage_details']['loan_term']}}</th>
            <th scope="col">Interest Rate</th>
            <th scope="col">{{ $data['mortgage_details']['interest_rate']}}%</th>
            <th scope="col">Loan Amount</th>
            <th scope="col">{{ $data['mortgage_details']['loan_amount']}}</th>

        </tr>

        <tr>
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
            <th scope="col">Ending Balance</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data['initial_amortization_schedule'] as $data)
            <tr>
                <td>@isset($data->month_number) {{ $data->month_number }} @endisset </td>
                <td>@isset($data->starting_balance) {{ $data->starting_balance }} @endisset</td>
                <td>@isset($data->monthly_payment) {{ $data->monthly_payment }} @endisset</td>
                <td>@isset($data->principal_component) {{ $data->principal_component }} @endisset</td>
                <td>@isset($data->interest_component) {{ $data->interest_component }} @endisset</td>
                <td>@isset($data->ending_balance) {{ $data->ending_balance }} @endisset</td>
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
            <th scope="col">Ending Balance</th>
        </tr>
        </tfoot>
    </table>
</div>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script>
    $('#initialAmortizationTable').DataTable({
        pagingType: 'full_numbers',
    });
</script>
