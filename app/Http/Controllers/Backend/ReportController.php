<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\Order;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index(){
        $from = request()->get('from') ? date('Y-m-d',strtotime(request()->get('from'))) : date('Y-m-d');
        $to = request()->get('to') ? date('Y-m-d',strtotime(request()->get('to'))) : Carbon::now()->addWeek()->format('Y-m-d');
        if ($from > $to){
            return back()->with('error','Ngày bắt đầu không lớn hơn ngày kết thúc');
        }
        $date = [$from,$to];
        $params['date'] = $date;
        $customers = User::where('role','customer')->whereBetween('created_at',$date)->count();
        $staffs = User::where('role','staff')->whereBetween('created_at',$date)->count();
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
        $data_chart = $this->getSaleByDate($params);
//        dd($data_chart);
        return view('backend.report.index',compact('customers','staffs','new_bills','running_bills','done_bills','from','to','data_chart'));
    }
    function getSaleByDate($params)
    {
        $result = array();
        $status = isset($params['status']) ? $params['status'] : 'done';
        $data = Bill::whereBetween('created_at', $params['date'])
            ->select(
                DB::raw('cod_price'),
                DB::raw("created_at")
            );
            if (isset($params['staff_id'])) {
                $data = $data->where('staff_id', $params['staff_id']);
            }
        $data = $data->where('status', $status)->get();
        if (count($data) > 0){
            $data = $data->pluck('cod_price','created_at')->toArray();
        }
        $rank_date = $this->dateRange($params['date']);
        foreach ($rank_date as $key => $item) {
            $i = 0;
            foreach ($data as $date => $value){
                if (date('d-m',strtotime($date)) == $item){
                    $result[$item][$i] = $value;
                }else{
                    $result[$item][$i] = 0;
                }
                $i++;
            }
        }
        if (!empty($result)){
            foreach ($result as $date => $item){
                $result[$date] = is_array($item) ? array_sum($item) : 0;
            }
        }
        $date_data = [
            'categories' => array_keys($result),
            'data' => array_values($result),
            'data_origin' => $result,
        ];
        return $date_data;
    }
    // nhập vào mảng [ngày bắt đầu, ngày kết thúc ] => mảng danh sách ngày trong khoảng
    function dateRange($date, $step = '+1 day', $format = 'd-m' ) {

        $dates = array();
        $first = $date[0];
        $last = $date[1];
        $current = strtotime($first);
        $last = strtotime($last);
        while( $current <= $last ) {
            $dates[] = date($format, $current);
            $current = strtotime($step, $current);
        }
        return $dates;
    }
}
