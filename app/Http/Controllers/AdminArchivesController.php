<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\subscribe;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class AdminArchivesController extends Controller
{
    public function adminexams()
    {
        $Exams = "2";
        return view('admin/source/archives/exams',['Exams' => $Exams]);
    }
    public function adminmcq()
    {
        $Exams = "2";
        return view('admin/source/archives/mcq',['Exams' => $Exams]);
    }
    public function adminemq()
    {
        $Exams = "2";
        return view('admin/source/archives/emq',['Exams' => $Exams]);
    }
    public function adminflashcard()
    {
        $Exams = "2";
        return view('admin/source/archives/flash-card',['Exams' => $Exams]);
    }
    public function adminkfp1()
    {
        $Exams = "2";
        return view('admin/source/archives/kfp1',['Exams' => $Exams]);
    }
     public function adminkfp2()
    {
        $Exams = "2";
        return view('admin/source/archives/kfp2',['Exams' => $Exams]);
    }
}
