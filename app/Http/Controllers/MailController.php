<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\NotificationEmail;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    

    public function index($data){
        $sendTo = $data['email'];
        $details = [
            'nama_lengkap'=>$data['nama_lengkap'],
            'username'=>$data['username'],

        ];
        if($data['typeEmail'] == 'assign'){
            $details['typeEmail'] = 'assign';
            $details['password'] = $data['password'];
        }else if($data['typeEmail'] == 'remove'){
            $details['typeEmail'] = 'remove';
        }

        
        Mail::to($sendTo)->send(new NotificationEmail($details));
    }
}
