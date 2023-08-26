<?php

namespace App\Http\Controllers;

use App\Services\MortgageCalculator\MortgageComposer;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Validation\ValidationException;

class MortgageCalculatorController extends Controller {

    protected MortgageComposer $mortgageComposer;

    public function __construct(MortgageComposer $mortgageComposer) {
        $this->mortgageComposer = $mortgageComposer;
    }

    /**
     * Display a listing of the resource.
     */
    public function index() {
        return view('main');
    }

    /**
     * Store a newly created resource in storage.
     * @throws ValidationException
     */
    public function store(Request $request) {

        $mortgageDetails = $this->mortgageComposer->compose($request->request);;
        return redirect()->route('list')->with('mortgage_details', $mortgageDetails);

    }

    public function show(Request $request) {

        $mortgageDetails = $request->session()->get('mortgage_details');
        return view('main', ['data' => $mortgageDetails]);

    }

}
