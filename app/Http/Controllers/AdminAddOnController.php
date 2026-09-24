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
        $Exams = "2";
        return view('admin/source/addon/coupons',['Exams' => $Exams]);
    }

    public function adminexamyear()
    {
        $Exams = "2";
        return view('admin/source/addon/exam-year',['Exams' => $Exams]);
    }
}
