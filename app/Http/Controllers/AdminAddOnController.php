<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\subscribe;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class AdminAddOnController extends Controller
{
    public function admincoupons()
    {
        $Coupons = DB::table('coupon')->orderBy('created_at', 'desc')->get();
        return view('admin/source/addon/coupons',['Coupons' => $Coupons]);
    }
    public function adminexamyear()
    {
         $ExamYears = DB::table('examyear')->orderBy('ey_name', 'asc')->get();
        return view('admin/source/addon/exam-year',['ExamYears' => $ExamYears]);
    }
}
