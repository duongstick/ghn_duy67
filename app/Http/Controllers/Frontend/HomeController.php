<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\City;
use App\Models\District;
use App\Models\Ward;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        return view('frontend.home.index');
    }
    public function createBill(){
        $provinces = City::OrderBy('name')->get();
        $province_id = $provinces[0]['id'];
        $district = District::where('province_id',$province_id)->get();
        return view('frontend.home.create_bill',compact('provinces','district'));

    }
    public function saveBill(Request $request){
       $params = $request->all();
       if (isset($params['province'])){
           $province = City::findOrFail($params['province']);

       }
        if (isset($params['district'])){
            $district = District::findOrFail($params['district']);

        }
        if (isset($params['ward'])){
            $ward = Ward::findOrFail($params['ward']);

        }
        $province_name = isset($province->name) ? $province->name.', ' : '';
        $district_name = isset($district->name) ? $district->name.', ' : '';
        $ward_name = isset($ward->name) ? $ward->name.', ' : '';
       $to =$province_name .$district_name.$ward_name.$params['address'];
       $find = [
           'email' => $params['email'],
       ];
       $update = [
           'name' => $params['name'],
           'phone' => $params['phone'],
           'password' => bcrypt('abcd1234'),
       ];
       $customer = User::where('role','customer')->updateOrCreate($find,$update);
       $customer_id = $customer->id;
        $input= [
            'from' =>auth()->user()->address,
            'to' => $to,
            'customer_id' => $customer_id,
            'seller_id' => auth()->id(),
            'money' => $params['money'],
            'status' =>'new',
            'notes'=>$params['notes'],
            'cod_price'=>$params['cod_price'],
            'type' => $params['cod_price'] > 0 ? 'shipcode' : 'basic'
        ] ;
        Bill::create($input);
        return back()->with('success','Tạo đơn thành công');
    }
    public function search(){
        $bill_id = request()->get('bill_id');
        $bill_info = Bill::find($bill_id);
        return view('frontend.home.search',compact('bill_id','bill_info'));
    }
    public function listBill(){
        $data = Bill::where('customer_id',auth()->id())->orderBy('id','desc')->get();
        $me = Bill::where('seller_id',auth()->id())->orderBy('id','desc')->get();
        return view('frontend.home.list',compact('data','me'));
    }
    public function getDistrict(Request $request){
        $province_id = $request->get('province_id');
        $data = District::where('province_id',$province_id)->get();
        return view('frontend.home.district',compact('data'));
    }
    public function getWard(Request $request){
        $province_id = $request->get('district_id');
        $data = Ward::where('district_id',$province_id)->get();
        return view('frontend.home.ward',compact('data'));
    }
    public function profile(){
        $info = auth()->user();
        return view('frontend.home.profile',compact('info'));

    }
}
