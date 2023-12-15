<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Mail\billOther;
use Illuminate\Support\Facades\Mail;
class BillController extends Controller
{
    public function __construc(){
        $this->middleware('auth');
    }
    public static function EmailCustomer($to_email,$data){
        Mail::to($to_email)->send(new billOther($data));
        return "<p> thanh cong</p>";
    }
}
