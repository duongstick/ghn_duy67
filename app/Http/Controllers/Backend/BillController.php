<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\Transport;
use App\User;
use Illuminate\Http\Request;

class BillController extends Controller
{
    public function index(){
        $params = [];
        if (in_array(auth()->user()->role,['staff','seller'])){
            $params['staff_id'] = auth()->id();
        }
        $data = $this->getBill($params);
        return view('backend.bill.index',compact('data'));
    }
    public function view($id){
        $info = Bill::findOrFail($id);
        $staffs = User::where('role',3)->get();
        return view('backend.bill.view',compact('info','staffs'));
    }
    public function status($id,$status){
       $info = Bill::findOrFail($id);
       $info->status = $status;
        if ($status == 'running'){
            $info->staff_id = auth()->id();
        }
       if ($info->save()){
           $code = 'success';
           $message = 'Cập nhật trạng thái thành công!';
       }else{
           $code = 'error';
           $message = 'Cập nhật trạng thái thất bại!';
       }
        return back()->with($code,$message);
    }
    public function update(Request $request, $id){
        $info = Bill::findOrFail($id);
        $info->staff_id  = $request->get('staff_id');
        $info->status = $request->get('status');
        if ($info->save()){
            $code = 'success';
            $message = 'Điều phối vận chuyển thành công!';
        }
        else{
            $code = 'error';
            $message = 'Điều phối vận chuyển thất bại!';
        }
        return back()->with($code,$message);
    }
}
