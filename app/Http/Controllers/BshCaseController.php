<?php

namespace App\Http\Controllers;

use App\BshCase;
use Illuminate\Http\Request;
use JWTAuth;
use JWTAuthException;
use App\User;

class BshCaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BshCase  $bshCase
     * @return \Illuminate\Http\Response
     */
    public function show(BshCase $bshCase)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BshCase  $bshCase
     * @return \Illuminate\Http\Response
     */
    public function edit(BshCase $bshCase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BshCase  $bshCase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BshCase $bshCase)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BshCase  $bshCase
     * @return \Illuminate\Http\Response
     */
    public function destroy(BshCase $bshCase)
    {
        //
    }

    protected $bshCase;

    public function __construct(BshCase $bshCase) {
        $this->bshCase = $bshCase;
    }

    public function getCase(Request $request) {     
        $bshCase = BshCase::where('customer_phone', $request->input('customer_phone'))->orderBy('created_at', 'desc')->first();

        return response()->json(['result' => $bshCase]);
    }

    public function postCase(Request $request) {
        $user = User::where('gdv_id', $request->input('gdv_id'))->orderBy('created_at', 'desc')->first();

        $result = $this->bshCase->create([
            'customer_name' => $request->input('name'),
            'customer_phone' => $request->input('phone'),
            'user_id' => $user->id,
            'case_id' => $request->input('case_id'),
            'lat1' => $request->input('lat1'),
            'lng1' => $request->input('lng1'),
            'address1' => $request->input('address1'),
            'lat2' => $request->input('lat2'),
            'lng2' => $request->input('lng2'),
            'address2' => $request->input('address2'),
        ]);
        
        return response()->json(['result' => $result]);
    }
}
