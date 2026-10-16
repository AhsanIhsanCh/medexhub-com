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
    public function adminquestion($linkData)
    {
        $linkDataArray = explode(",", $linkData);
        $qt_id = $linkDataArray[0];
        $limitShow = $linkDataArray[1];
        $e_id = "1";
        $Questions = DB::table('questions')->where('q_qt_id', $qt_id)->limit($limitShow)->orderBy('q_id', 'desc')->get();
        return view('admin/source/archives/question',['Questions' => $Questions,'qt_id' => $qt_id,'e_id' => $e_id,'limitShow' => $limitShow]);
    }
    public function admininnerquestion(Request $request)
    {
        $CheckCount = 1;
        $SelectedExam = "";
        $qt_id = $request->input('qt_id');
        $e_id = $request->input('examOption');
        $limitShow = $request->input('limitShow');
        $Exams = DB::table('exams')->select('e_inner_level')->where('e_id', $e_id)->get();
        $ExamsInnerLevel = $Exams->first()->e_inner_level ?? '0';
        $CLevel1 = DB::table('exams')->select('e_id','e_inner_level','e_level')->where('e_inner_level', $ExamsInnerLevel)->get();
        foreach ($CLevel1 as $Level1) {
            if ($CheckCount == 1)
                    {
                        $SelectedExam .= $Level1->e_inner_level;
                        $CheckCount++;
                    }
                else
                    {
                        $SelectedExam .=",".$Level1->e_inner_level;
                    }
            $CLevel2 = DB::table('exams')->select('e_id','e_inner_level','e_level')->where('e_level', $Level1->e_id)->where('e_status', '1')->get();
            foreach ($CLevel2 as $Level2) {
                $SelectedExam .=",".$Level2->e_inner_level;
                $CLevel3 = DB::table('exams')->select('e_id','e_inner_level','e_level')->where('e_level', $Level2->e_id)->where('e_status', '1')->get();
                foreach ($CLevel3 as $Level3) {
                    $SelectedExam .=",".$Level3->e_inner_level;
                    $CLevel4 = DB::table('exams')->select('e_id','e_inner_level','e_level')->where('e_level', $Level3->e_id)->where('e_status', '1')->get();
                    foreach ($CLevel4 as $Level4) {
                        $SelectedExam .=",".$Level4->e_inner_level;
                        $CLevel5 = DB::table('exams')->select('e_id','e_inner_level','e_level')->where('e_level', $Level4->e_id)->where('e_status', '1')->get();
                        foreach ($CLevel5 as $Level5) {
                            $SelectedExam .=",".$Level5->e_inner_level;
                            $CLevel6 = DB::table('exams')->select('e_id','e_inner_level','e_level')->where('e_level', $Level5->e_id)->where('e_status', '1')->get();
                            foreach ($CLevel6 as $Level6) {
                                $SelectedExam .=",".$Level6->e_inner_level;
                                $CLevel7 = DB::table('exams')->select('e_id','e_inner_level','e_level')->where('e_level', $Level6->e_id)->where('e_status', '1')->get();
                            }
                        }
                    }
                }
            }
        }
        $SelectedExam_Array = explode(',', $SelectedExam);
        $Questions = DB::table('questions')->where('q_qt_id', $qt_id)->whereIn('q_e_inner_level', $SelectedExam_Array )->limit($limitShow)->orderBy('q_id', 'desc')->get();
        return view('admin/source/archives/question',['Questions' => $Questions,'qt_id' => $qt_id,'e_id' => $e_id,'limitShow' => $limitShow]);
    }
    public function admininnerquestionlink($linkData)
    {
        $linkDataArray = explode(",", $linkData);
        $qt_id = $linkDataArray[0];
        $e_id = $linkDataArray[1];
        $limitShow = $linkDataArray[2];
        $CheckCount = 1;
        $SelectedExam = "";
        $Exams = DB::table('exams')->select('e_inner_level')->where('e_id', $e_id)->get();
        $ExamsInnerLevel = $Exams->first()->e_inner_level ?? '0';
        $CLevel1 = DB::table('exams')->select('e_id','e_inner_level','e_level')->where('e_inner_level', $ExamsInnerLevel)->get();
        foreach ($CLevel1 as $Level1) {
            if ($CheckCount == 1)
                    {
                        $SelectedExam .= $Level1->e_inner_level;
                        $CheckCount++;
                    }
                else
                    {
                        $SelectedExam .=",".$Level1->e_inner_level;
                    }
            $CLevel2 = DB::table('exams')->select('e_id','e_inner_level','e_level')->where('e_level', $Level1->e_id)->where('e_status', '1')->get();
            foreach ($CLevel2 as $Level2) {
                $SelectedExam .=",".$Level2->e_inner_level;
                $CLevel3 = DB::table('exams')->select('e_id','e_inner_level','e_level')->where('e_level', $Level2->e_id)->where('e_status', '1')->get();
                foreach ($CLevel3 as $Level3) {
                    $SelectedExam .=",".$Level3->e_inner_level;
                    $CLevel4 = DB::table('exams')->select('e_id','e_inner_level','e_level')->where('e_level', $Level3->e_id)->where('e_status', '1')->get();
                    foreach ($CLevel4 as $Level4) {
                        $SelectedExam .=",".$Level4->e_inner_level;
                        $CLevel5 = DB::table('exams')->select('e_id','e_inner_level','e_level')->where('e_level', $Level4->e_id)->where('e_status', '1')->get();
                        foreach ($CLevel5 as $Level5) {
                            $SelectedExam .=",".$Level5->e_inner_level;
                            $CLevel6 = DB::table('exams')->select('e_id','e_inner_level','e_level')->where('e_level', $Level5->e_id)->where('e_status', '1')->get();
                            foreach ($CLevel6 as $Level6) {
                                $SelectedExam .=",".$Level6->e_inner_level;
                                $CLevel7 = DB::table('exams')->select('e_id','e_inner_level','e_level')->where('e_level', $Level6->e_id)->where('e_status', '1')->get();
                            }
                        }
                    }
                }
            }
        }
        $SelectedExam_Array = explode(',', $SelectedExam);
        $Questions = DB::table('questions')->where('q_qt_id', $qt_id)->whereIn('q_e_inner_level', $SelectedExam_Array )->limit($limitShow)->orderBy('q_id', 'desc')->get();
        return view('admin/source/archives/question',['Questions' => $Questions,'qt_id' => $qt_id,'e_id' => $e_id,'limitShow' => $limitShow]);
    }

}
