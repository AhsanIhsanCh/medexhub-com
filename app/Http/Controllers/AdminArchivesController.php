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
        
        $Exams = DB::table('exams')->where('e_level', '1')->get();
        return view('admin/source/archives/exams',['Exams' => $Exams,'e_id' => '0','displaytype' => '1']);
    }
     public function admininnerexams($e_id)
    {
       
        $Exams = DB::table('exams')->where('e_level', $e_id)->get();
        return view('admin/source/archives/exams',['Exams' => $Exams,'e_id' => $e_id,'displaytype' => '2']);
    }





    public function adminmcq()
    {
        $qt_id = "1";
        $Questions = DB::table('questions')->where('q_qt_id', $qt_id)->limit(20)->orderBy('q_id', 'desc')->get();
        return view('admin/source/archives/mcq',['Questions' => $Questions,'qt_id' => $qt_id,'e_id' => '1']);
    
    
        
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
