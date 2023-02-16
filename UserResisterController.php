<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserResister;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
//use Illuminate\Support\Facades\DB;
//use Illuminate\Support\Facades\Auth;
//use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Http;

class UserResisterController extends Controller
{
    private $api_url = 'http://127.0.0.1:8000/api/';
    //private $api_url = 'http://localhost/api/';
    
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
    public function register(Request $request)
    {
        $inputData = $request->all();
        
        $inputData = [
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'password' => $request->password,
            'password_confirmation' => $request->password_confirmation
        ];
        $response = Http::connectTimeout(3)->post('http://127.0.0.1:8000/api/register', $inputData);
        
        print_r($response);
        /*
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://127.0.0.1:8000/api/register',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $inputData,
            CURLOPT_HTTPHEADER => array(
                'Authorization: application/json'
            ),
         ));
        $err = curl_error($curl);
        if ($err) {
            echo "cURL Error #:" . $err;
        }
        $response = curl_exec($curl);
        $response = json_decode($response, true);

        curl_close($curl);
        print_r($response); die;

        $status = $response['status'];
        if($status == 1){
            return redirect('/')->with($response);
        }else{
            $request->flash();
            return redirect('/register')->with($response);
        }
        
        /*
        $validateData = Validator::make($request->all(), [
            'name' => ['required'],
            'email' => ['required'],
            'mobile' => ['required', 'min:10'],
            'password' => ['required', 'min:2', 'confirmed']
        ]);  
        if($validateData->fails()){
            $msg = $validateData->messages();
            $msg = json_decode($msg, true);
            $msgAll = [];
            foreach($msg as $key => $val){
                $msgAll[] = $val[0];
            }
            $msgAll = implode('<br>', $msgAll);
            $msg = [
                'status' => 0,
                'message' => $msgAll,
                'inputData' => $inputData
            ];
            return redirect('/')->with($msg);
        }else{
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'password' => $request->password
            ];
            DB::beginTransaction();
            try {
                $user = User::create($data);
                DB::commit();
            } catch (\Throwable $th) {
                DB::rollback();
                $user = null;
                $msg = $th->getMessage();

                echo '<pre>';
                print_r($msg);
                echo '</pre>';
            }
            if($user != null){
                $msg = [
                    'status' => 1,
                    'message' => 'Register Successfully.'
                ];
            }else{
                $msg = [
                    'status' => 0,
                    'message' => 'Not Register, Try Again.'
                ];
            }
        }
        return redirect('/')->with($msg);
        */
    }
    public function login(Request $request)
    {
        $inputData = $request->all();
        /*
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
   
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard')
                        ->withSuccess('You have Successfully loggedin');
        }
        $request->flash();
        return redirect("login")->withSuccess('Oppes! You have entered invalid credentials');
        */
        
        print_r($inputData);
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->api_url.'login',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $inputData,
            CURLOPT_HTTPHEADER => array(
                'Authorization: application/json'
            ),
         ));

        $response = curl_exec($curl);
        $response = json_decode($response, true);

        curl_close($curl);
        echo '>>>>>>>'; print_r($response); die();
        $status = $response['status'];
        if($status == 1){
            return redirect('/dashboard')->with($response);
        }else{
            $request->flash();
            return redirect('/')->with($response);
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserResister  $userResister
     * @return \Illuminate\Http\Response
     */
    public function show(UserResister $userResister)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserResister  $userResister
     * @return \Illuminate\Http\Response
     */
    public function edit(UserResister $userResister)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserResister  $userResister
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserResister $userResister)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserResister  $userResister
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserResister $userResister)
    {
        //
    }
}
