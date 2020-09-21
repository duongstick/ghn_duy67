<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $customers = User::where('role','customer')->count();
        $staffs = User::where('role','staff')->count();
        $params['status']  = 'new';
        $data = $this->getBill($params);
        $new_bills = $data->count();

        if (auth()->user()->role == 'staff'){
            $params['staff_id'] = auth()->id();
        }
        $params['status']  = 'running';
        $running_bills = $this->getBill($params)->count();
        $params['status']  = 'done';
        $done_bills = $this->getBill($params)->count();

        $watting_bills = $this->getBill(['status' => 'waitting','staff_id' => auth()->user()->transport_id]);
        return view('backend.home.index',compact('customers','staffs','new_bills','running_bills','done_bills','data','watting_bills'));
    }

}
