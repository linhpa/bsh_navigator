<?php

namespace App\Http\Controllers;

use App\BshCase;
use Illuminate\Http\Request;
use JWTAuth;
use JWTAuthException;
use App\User;
use Auth;
use \DB;
use GuzzleHttp;
use GuzzleHttp\Client;
use App\Http\Config;

class BshCaseController extends Controller
{
    protected $bshCase;

    protected $STATUSES = [
        1 => 'New',
        2 => 'Pending',
        3 => 'Done'
    ];

    public function __construct(BshCase $bshCase) {        
        $this->bshCase = $bshCase;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {        
        if (Auth::user()->role == 'admin') {
            if (isset($request->new) && $request->new == 1) {
                $cases = BshCase::where('status', 1)->orWhere('status', null)->orWhere('status', 0)->orderBy('status', 'asc')->orderBy('updated_at', 'desc')->paginate(10);
            } else {
                $cases = BshCase::find(1)->orderBy('status', 'asc')->orderBy('updated_at', 'desc')->paginate(10);    
            }
        } else {
            if (isset($request->new) && $request->new == 1) {
                $cases = BshCase::where('user_id', Auth::user()->id)->where('status', 1)->orWhere('status', null)->orWhere('status', 0)->orderBy('status', 'asc')->orderBy('updated_at', 'desc')->paginate(10);
            } else {
                $cases = BshCase::where('user_id', Auth::user()->id)->orderBy('status', 'asc')->orderBy('updated_at', 'desc')->paginate(10);
            }
        }
        
        $statuses = $this->STATUSES;

        return view('bshcase.index', compact('cases', 'statuses'));
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
            $case->description = $request->input('description');

            $result = $case->save();        
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
                'description' => $request->input('description')
            ]);    
        }

        $notiData = [
            'secret_key' => Config::getSecretKey(),
            'gdv_id' => $request->input('gdv_id'),
            'body' => $request->input('address1')
        ];

        $this->pushNoti($notiData);
        
        return response()->json(['result' => $result]);
    }

    public function showHandleCase($id) {
        $case = BshCase::where('id', $id)->first();

        $photos1 = DB::table('case_photos')->where(['case_id' => $case->id, 'type' => 1])->get();
        $photos2 = DB::table('case_photos')->where(['case_id' => $case->id, 'type' => 2])->get();
        $photos3 = DB::table('case_photos')->where(['case_id' => $case->id, 'type' => 3])->get();

        $statuses = $this->STATUSES;

        return view('bshcase.handle', compact('case', 'photos1', 'photos2', 'photos3', 'statuses'));
    }

    public function handleCase(Request $request) {
        $case = BshCase::where('id', $request->id)->first();

        $case_time = date_create_from_format('d/m/Y H:i', $request->case_time);

        if ($request->case_time == 0) {
            unset($case_time);
        }

        if ($case != null) {
            $case->case_time = isset($case_time) ? $case_time : null;
            $case->case_location = $request->case_location;
            $case->driver_info = $request->driver_info;
            $case->case_detail_info = $request->case_detail_info;
            $case->damage_level = $request->damage_level;
            $case->done_jobs = $request->done_jobs;
            $case->note = $request->note;

            $result = $case->save();

            return response()->json(['result' => $result]);
        }

        return response()->json(['result' => false]);
    }

    public function completeCase(Request $request) {
        $case = BshCase::where('id', $request->id)->first();

        $this->saveDoneCase($case);

        if ($case != null) {
            $case->status = (int)$request->status;

            $result = $case->save();

            return response()->json(['result' => $result]);
        }

        return response()->json(['result' => false]);
    }
    
    public function uploadPhotos(Request $request) {        
        if($request->hasFile('files' . $request->type)){                       
            $files = $request->file('files' . $request->type);
            
            $case = BshCase::where('id', $request->case_id)->first();
            $saveToCase = [];
            foreach ($files as $file) {            
                $newFileName = time() . '-' . $file->getClientOriginalName();    
                $file->move('uploads', $newFileName);    
                
                $saveToCase[] = [
                    'case_id' => $case->id,
                    'photo_url' => $newFileName,
                    'type' => isset($request->type) ? (int)$request->type : null
                ];
            }            

            if ($case != null) {                
                DB::table('case_photos')->insert($saveToCase);
            }

            return redirect()->back()->with("success","Photos Uploaded Successfully!")->withInput(['tab'=>'step2']);
        }

        return redirect()->back()->with("error","Photo Uploaded Failed...")->withInput(['tab'=>'step2']);
    }

    public function destroyPhoto(Request $request) {
        $result = DB::table('case_photos')->where('photo_url', $request->id)->delete();

        return response()->json(['result' => $result]);
    }

    public function sendLocation(Request $request) {
        $data = [];
        $data['position'] = isset($request->position) ? $request->position : '';
        $data['gdv_id'] = isset($request->gdv_id) ? $request->gdv_id : '';
        $data['secret_key'] = Config::getSecretKey();

        $res = $this->callApiSendLocation($data);

        return response()->json($res);
    }

    protected function callApiSendLocation($data) {
        $client = new Client();

        $response = $client->post('http://115.146.126.84/api/locationServices/pushGDVLocation', [
            'form_params' => $data
        ]);

        return response()->json(['result' => $response]);

        // $curl = curl_init();
        // curl_setopt_array($curl, array(
        //     CURLOPT_URL => 'http://115.146.126.84/api/locationServices/pushGDVLocation',
        //     CURLOPT_RETURNTRANSFER => true,
        //     CURLOPT_ENCODING => "",
        //     CURLOPT_MAXREDIRS => 10,
        //     CURLOPT_TIMEOUT => 30,
        //     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        //     CURLOPT_CUSTOMREQUEST => "POST",
        //     CURLOPT_POSTFIELDS => json_encode($data),
        //     CURLOPT_HTTPHEADER => array(
        //         "accept: application/json",
        //         "cache-control: no-cache",                
        //         "content-type: application/json"
        //     ),
        // ));
        // $response = curl_exec($curl);        
        // $responseArr = (array) json_decode($response);

        // return $responseArr;
    }

    protected function _noUse_pushNotification($token, $title, $body)
    {
        $fcmUrl = "https://fcm.googleapis.com/fcm/send";
        // $token = "c_fvsCd2ME4:APA91bFyJUQuO5qfgLcKrACRq4Qmn8QGWMzH46JXc-BgRTVVPoWjXpUxwhTNtXaLxuDHO-8R8j3UtzK0P8JdLU1Zk7dgLU_34aydqT50CAUxK9wt04Zq9mCOrNDXfBQuT4XFnNSHgO-h";
        

        $notification = [
            'title' => $title,
            'body' => $body            
        ];
        
        $extraNotificationData = ["message" => $notification,"moredata" =>'dd'];

        $fcmNotification = [
            //'registration_ids' => $tokenList, //multple token array
            'to'        => $token, //single token
            'notification' => $notification            
        ];

        $headers = [            
            'Content-Type' => 'application/json',
            'Authorization' => 'key=AAAAr5KJQZQ:APA91bGce1eDOO705Rr1CYpdQIBcuq2t4pcu1ktq2HGO7dXluEL0YG9CMkBIeeeRjujtVoBwVgxRXF_nzbPD6fAqUmLO8YxxSPxJxtdIORvsuEBSjOjoTU0Vg_WwKRr3b_sJy9f095_4'
        ];

        $client = new Client(['headers' => $headers]);

        $response = $client->post($fcmUrl, ['body' => json_encode($fcmNotification)]);
    }   

    protected function pushNoti($data) {
        $client = new Client();

        $response = $client->post('http://115.146.126.84/api/locationServices/pushNoti', [
            'form_params' => $data
        ]);

        return response()->json(['result' => $response]);
    }

    protected function saveDoneCase($case) {
        $photos = DB::table('case_photos')->where('case_id', $case->id)->get();

        $data = [
            'case_id' => $case->case_id,
            'case_time' => $case->case_time,
            'case_location' => $case->case_location,
            'driver_info' => $case->driver_info,
            'case_detail_info' => $case->case_detail_info,
            'damage_level' => $case->damage_level,
            'done_jobs' => $case->done_jobs,
            'note' => $case->note,
            'status' => $case->status,            
        ];

        $data['photos'] = [];        

        foreach ($photos as $photo) {
            $data['photos'][] = ['url' => url("/uploads/" . $photo->photo_url), 'type' => $photo->type];
        }

        $data['secret_key'] = Config::getSecretKey();

        $client = new Client();

        $response = $client->post('http://115.146.126.84/api/locationServices/saveDoneCase', [
            'form_params' => $data
        ]);

        return response()->json(['result' => $response]);
    }

    public function getGDVLocation(Request $request) {           
        if (isset($request->gdv_id) && $request->gdv_id != null) {
            
            $data = [];

            $data['gdv_id'] = $request->gdv_id;
            $data['secret_key'] = Config::getSecretKey();

            try {
                $client = new Client();            

                $response = $client->post('http://115.146.126.84/api/locationServices/getGDVLocation', [
                    'form_params' => $data
                ]);                
            } catch (RequestException $e) {                
                return response()->json(['result' => false, 'message' => $e->getMessage()]);
            }

            return $response->getBody();
        }

        return response()->json(['result' => false]);
    }
}
