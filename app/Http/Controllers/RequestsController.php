<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request as Req;
use App\Models\Request;
use Illuminate\Support\Facades\Auth;

use Mail;
use App\Mail\ResponseMail;

class RequestsController extends Controller
{
    public function get() {
        $data = [];
        $is_admin = false;
        if (Auth::check()){
            if (Auth::user()->email == env("ADMIN_EMAIL")){
                $is_admin = true;
                $requests = Request::orderBy('status', 'asc')->get();
                foreach ($requests as $request) {
                    array_push($data, ["id"=>$request->id, 
                        "name"=>$request->name, 
                        "email"=>$request->email, 
                        "status"=>$request->status, 
                        "message"=>$request->message, 
                        "comment"=>$request->comment, 
                        "created_at"=>$request->created_at, 
                        "updated_at"=>$request->updated_at]);
                }
            } else {
                $requests = Request::orderBy('status', 'asc')->get()->where('email', Auth::user()->email);
                foreach ($requests as $request) {
                    array_push($data, ["id"=>$request->id, 
                        "name"=>$request->name, 
                        "email"=>$request->email, 
                        "status"=>$request->status, 
                        "message"=>$request->message, 
                        "comment"=>$request->comment, 
                        "created_at"=>$request->created_at, 
                        "updated_at"=>$request->updated_at]);
                }
            }
        }
        return view('requests')->with('users', $data)->with('isAdmin', $is_admin);
    }

    public function create() {
        if (auth()->user()->name == '') {
            return json_encode(['error'=>'Name is required fied!']);
        }
        if (auth()->user()->email == '') {
            return json_encode(['error'=>'Email is required fied!']);
        }
        if (!array_key_exists("message", $_POST) || $_POST['message'] == '') {
            return json_encode(['error'=>'Message is required fied!']);
        }
        Request::create([
            'name'=>auth()->user()->name,
            'email'=>auth()->user()->email,
            'message'=>$_POST['message']
        ]);
        return redirect()->intended('home');;
    }

    public function resolve(Req $req, string $id) {
        if (!ctype_digit($id)) {
            return json_encode(['error'=>'Id must be integer!']);
        }
        if ($req->input('comment') == '') {
            return json_encode(['error'=>'Comment is requred field!']);
        }
        $request = Request::find((int)$id);
        if ($request == null) {
            return json_encode(['error'=>'No requests with this ID!']);
        }
        if ($request->status == 'Resolved') {
            return json_encode(['error'=>'Request already resolved!']);
        }
        $request->update([
            'comment'=>$req->input('comment'),
            'status'=>'Resolved'
        ]);
        $mailSender = new ResponseMail(storage_path('app/emails'));
        $mailSender->send($request->email, "Response to: $request->message", $req->input('comment'));
        return json_encode(['status'=>'Request successfully resolved!']);
    }
}
