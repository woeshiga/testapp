<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request as Req;
use App\Models\Request;

use Mail;
use App\Mail\ResponseMail;

class RequestsController extends Controller
{
    public function get() {
        $requests = Request::orderBy('status', 'asc')->get();
        $data = [];
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
        return json_encode($data);
    }

    public function create() {
        if (!array_key_exists("name", $_POST) || $_POST['name'] == '') {
            return json_encode(['error'=>'Name is required fied!']);
        }
        if (!array_key_exists("email", $_POST) || $_POST['email'] == '') {
            return json_encode(['error'=>'Email is required fied!']);
        }
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            return json_encode(['error'=>'Email is not valid!']);
        }
        if (!array_key_exists("message", $_POST) || $_POST['message'] == '') {
            return json_encode(['error'=>'Message is required fied!']);
        }
        Request::create([
            'name'=>$_POST['name'],
            'email'=>$_POST['email'],
            'message'=>$_POST['message']
        ]);
        return json_encode(['succes'=>'Request successfully addedd!']);
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
