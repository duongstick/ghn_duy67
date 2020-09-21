<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use Illuminate\Http\Request;

class BillController extends Controller
{
   public function delete($id){
       $info = Bill::find($id);
       if($info == null){
           return back()->with('error','Không có thông tin đơn hàng');
       }
       if ($info->status != 'new'){
           return back()->with('error','Đơn hàng đã chuyển trạng thái, không thể xóa');
       }
       if ($info->delete()){
           return back()->with('success','Xóa đơn hàng thành công');
       }else{
           return back()->with('error','Xóa đơn hàng thất bại');
       }
   }
   public function sellerRate($id,$star){
       $info = Bill::find($id);
       if($info == null){
           return back()->with('error','Không có thông tin đơn hàng');
       }
       if ($info->status != 'done'){
           return back()->with('error','Đơn hàng chưa hoàn thành,Người gửi không thể đánh giá');
       }
       if ($star <= 0 || $star > 5){
           return back()->with('error','Số sao phải lớn hơn 0 và nhỏ hơn hoặc bằng 5');
       }
       $info->seller_rate = $star;
       if ($info->save()){
           return back()->with('success','Đánh giá  thành công');
       }else{
           return back()->with('error','Đánh giá  thất bại');
       }
   }
    public function customerRate($id,$star){
        $info = Bill::find($id);
        if($info == null){
            return back()->with('error','Không có thông tin đơn hàng');
        }
        if ($info->status != 'done'){
            return back()->with('error','Đơn hàng chưa hoàn thành, Người nhận không thể đánh giá');
        }
        if ($star <= 0 || $star > 5){
            return back()->with('error','Số sao phải lớn hơn 0 và nhỏ hơn hoặc bằng 5');
        }
        $info->customer_rate = $star;
        if ($info->save()){
            return back()->with('success','Đánh giá  thành công');
        }else{
            return back()->with('error','Đánh giá  thất bại');
        }
    }
}
