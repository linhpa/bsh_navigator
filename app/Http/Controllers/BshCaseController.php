<?php

namespace App\Http\Controllers;

use App\BshCase;
use Illuminate\Http\Request;
use JWTAuth;
use JWTAuthException;
use App\User;
use Auth;
use \DB;

class BshCaseController extends Controller
{
    protected $bshCase;

    public function __construct(BshCase $bshCase) {
        $this->middleware('auth');
        $this->bshCase = $bshCase;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->role == 'admin') {
            $cases = BshCase::all();
        } else {
            $cases = BshCase::where('user_id', Auth::user()->id)->get();            
        }
        

        return view('bshcase.index', compact('cases'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BshCase  $bshCase
     * @return \Illuminate\Http\Response
     */
    public function show(BshCase $bshCase)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BshCase  $bshCase
     * @return \Illuminate\Http\Response
     */
    public function edit(BshCase $bshCase)
    {        
        
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

    public function getCase(Request $request) {     
        $bshCase = BshCase::where('customer_phone', $request->input('customer_phone'))->orderBy('created_at', 'desc')->first();

        return response()->json(['result' => $bshCase]);
    }

    public function postCase(Request $request) {
        $user = User::where('gdv_id', $request->input('gdv_id'))->orderBy('created_at', 'desc')->first();

        $case = BshCase::where('case_id', $request->case_id)->first();

        if ($case != null) {
            $case->customer_name = $request->input('name');
            $case->customer_phone = $request->input('phone');
            $case->user_id = $user == null ? null : $user->id;
            // $case->case_id = $request->input('name');
            $case->lat1 = $request->input('lat1');
            $case->lng1 = $request->input('lng1');
            $case->address1 = $request->input('address1');
            $case->lat2 = $request->input('lat2');
            $case->lng2 = $request->input('lng2');
            $case->address2 = $request->input('address2');

            $case->save();        
        } else {
            $result = $this->bshCase->create([
                'customer_name' => $request->input('name'),
                'customer_phone' => $request->input('phone'),
                'user_id' => $user == null ? null : $user->id,
                'case_id' => $request->input('case_id'),
                'lat1' => $request->input('lat1'),
                'lng1' => $request->input('lng1'),
                'address1' => $request->input('address1'),
                'lat2' => $request->input('lat2'),
                'lng2' => $request->input('lng2'),
                'address2' => $request->input('address2'),
            ]);    
        }
        
        return response()->json(['result' => $result]);
    }

    public function showHandleCase($id) {
        $case = BshCase::where('id', $id)->first();

        $photos = DB::table('case_photos')->where('case_id', $case->id)->get();

        return view('bshcase.handle', compact('case', 'photos'));
    }

    public function handleCase(Request $request) {

    }
    
    public function uploadPhotos(Request $request) {
        if($request->hasFile('files')){                       
            $files = $request->file('files');
            
            $case = BshCase::where('id', $request->case_id)->first();
            $saveToCase = [];
            foreach ($files as $file) {            
                $newFileName = time() . '-' . $file->getClientOriginalName();    
                $file->move('uploads', $newFileName);    
                
                $saveToCase[] = [
                    'case_id' => $case->id,
                    'photo_url' => $newFileName
                ];
            }

            

            if ($case != null) {                
                DB::table('case_photos')->insert($saveToCase);
            }

            return redirect()->back()->with("success","Photos Uploaded Successfully!")->withInput(['tab'=>'step2']);
        }

        return redirect()->back()->with("error","Photo Uploaded Failed...")->withInput(['tab'=>'step2']);
    }
}
