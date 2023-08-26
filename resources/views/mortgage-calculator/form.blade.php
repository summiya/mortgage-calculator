<div id="content-form">
    <div class="card-header text-center font-weight-bold">
        Mortgage Calculator
    </div>
    <div class="card-body">
        <form name="add-post-form" id="add-post-form" method="post" action="{{url('store-form')}}">
            @csrf
            <div class="form-group">
                <label for="">Loan Amount:</label>
                <input type="number" id="loan_amount" name="loan_amount" class="form-control" required=""
                       value="{{ old('loan_amount') }}">
                <small id="exampleInputStartDate" class="form-text text-muted"> </small>
                @error('loan_amount')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Annual Interest Rate (%)</label>
                <input type="number" id="interest_rate" name="interest_rate" class="form-control" required=""
                       value="{{ old('interest_rate') }}">
                <small id="exampleInputEndDate" class="form-text text-muted"></small>
                @error('interest_rate')
                <div class="text-danger">{{ $message }}</div>
                @enderror
                <p id="date_error" style="color: red; display: none;"></p>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail">Loan Term (years):</label>
                <input type="number" id="loan_term" name="loan_term" class="form-control" required=""
                       value="{{ old('loan_term') }}" min="1">
                <small id="exampleInputEndDate" class="form-text text-muted">Max 25 years allowed</small>
                @error('loan_term')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="exampleInputEmail">Monthly Fixed Extra Payment</label>
                <input type="number" id="monthly_extra_payment" name="monthly_extra_payment" class="form-control"
                       value="{{ old('monthly_extra_payment') }}">
                @error('monthly_extra_payment')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Calculate</button>
        </form>
    </div>

</div>
