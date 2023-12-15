<?php

namespace App\Http\Controllers;
use App\Models\other;
use App\Models\city;
use App\Models\address;
use App\Models\district;
use App\Models\ward;
use App\Models\cart;
use DB;
use Illuminate\Http\Request;

class BillOtherController extends Controller
{
    public function store(Request $request)
    {
       $other = DB::table('other as o')->join('city as c','c.id','=','o.city_id')->join('district as d','d.id','=','o.district_id')->join('ward as w','w.id','=','o.ward_id')
       ->select('o.id','o.created_at','o.payment_method','o.status','o.sum_price','o.total_price','o.note','o.customer_name','o.info','d.name as districtName','w.name as wardName','c.name as cityName','o.tax')
       ->paginate(20);
       return view('admin.billLog',compact('other'));
    }
}
