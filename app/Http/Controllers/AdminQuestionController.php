<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\subscribe;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class AdminQuestionController extends Controller
{
    public function showQuestion($qt_id)
    {
        $Questions = DB::table('questions')->where('q_qt_id', $qt_id)->limit(20)->orderBy('q_id', 'desc')->get();
        return view('admin/source/question/question',['Questions' => $Questions,'qt_id' => $qt_id,'e_id' => '1']);
    }
    public function selectQuestionExam(Request $request)
    {
        $qt_id = $request->input('qt_id');
        $SelectedLevel = $request->input('examOpption');
        $SelectedExam = '';
        $CheckCount = 1;
        $CLevel1 = DB::table('exams')->select('e_id','e_inner_level','e_level')->where('e_id', $SelectedLevel)->get();
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
        $SelectedExam_Array = explode(",", $SelectedExam);
        $Questions = DB::table('questions')->select('*')->whereIn('q_e_inner_level', $SelectedExam_Array)->where('q_qt_id', $qt_id)->orderBy('q_id', 'desc')->get();
        return view('admin/source/question/question',['Questions' => $Questions,'qt_id' => $qt_id,'e_id' => $SelectedLevel]);
    }
    public function selectQuestionExamLink($linkData)
    {
        $Data = explode(',', $linkData);
        $e_id = $Data[0];
        $qt_id = $Data[1];
        $SelectedLevel = $e_id;
        $SelectedExam = '';
        $CheckCount = 1;
        $CLevel1 = DB::table('exams')->select('e_id','e_inner_level','e_level')->where('e_id', $SelectedLevel)->get();
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
        $SelectedExam_Array = explode(",", $SelectedExam); 
        $Questions = DB::table('questions')->select('*')->whereIn('q_e_inner_level', $SelectedExam_Array)->where('q_qt_id', $qt_id)->orderBy('q_id', 'desc')->get();
        return view('admin/source/question/question',['Questions' => $Questions,'qt_id' => $qt_id,'e_id' => $SelectedLevel]);
    }
    public function adminAddQuestion($linkData)
    {
        $Data1 = explode(',', $linkData);
        $exam_id = $Data1[0];
        $qt_id = $Data1[1];
        $Exam = DB::table('exams')->select('e_inner_level')->where('e_id', $exam_id)->get();
        $InnerLevel = $Exam->first()->e_inner_level;
        $CheckQuestion3 = DB::table('questions')->select('q_id','q_question_id')->where('q_e_id', $exam_id)->where('q_e_inner_level', $InnerLevel)->where('q_qt_id', $qt_id)->where('q_status', '3')->get();
        if ($CheckQuestion3->isEmpty()) 
            {
                DB::table('questions')->insert([
                'q_e_id' => $exam_id,
                'q_e_inner_level' => $InnerLevel,
                'q_qt_id' => $qt_id,
                'q_question_id' => 0,
                'q_difficulty' => 0,
                'q_status' => 3,
                'q_admin' => 0,
                'q_home_show' => 0,
                'q_difficulty' => 0,
                ]);
                $QuestionId = DB::getPdo()->lastInsertId();
                if($qt_id == 1)
                    {
                        DB::table('questions_mcq')->insert([
                        'mcq_e_id' => $exam_id,
                        'mcq_e_inner_level' => $InnerLevel,
                        'mcq_status' => '3',
                        ]);
                        $NewQuestionId = DB::getPdo()->lastInsertId();
                    }
                if($qt_id == 2)
                    {
                        DB::table('questions_emq')->insert([
                        'emq_e_id' => $exam_id,
                        'emq_e_inner_level' => $InnerLevel,
                        'emq_status' => '3',
                        ]);
                        $NewQuestionId = DB::getPdo()->lastInsertId();
                    }
                if($qt_id == 3)
                    {
                        DB::table('questions_fc')->insert([
                        'fc_e_id' => $exam_id,
                        'fc_e_inner_level' => $InnerLevel,
                        'fc_status' => '3',
                        ]);
                        $NewQuestionId = DB::getPdo()->lastInsertId();
                    }        
                DB::table('questions')->where('q_id', $QuestionId)->update(['q_question_id' => $NewQuestionId]);
            }
        else
            {
                $NewQuestionId = $CheckQuestion3->first()->q_question_id;
            }
        return view('admin/source/question/questionadd',['q_id' => $NewQuestionId,'qt_id' => $qt_id]);
    }
    public function adminEditQuestion($linkData1)
    {
        $Data1 = explode(',', $linkData1);
        $q_id = $Data1[0];
        $qt_id = $Data1[1];
        return view('admin/source/question/questionedit',['q_id' => $q_id,'qt_id' => $qt_id]);
    }
    public function adminEditUMCQOption(Request $request)
    {
        $q_id = $request->input('q_id');
        $qt_id = $request->input('qt_id');
        $MCQOptions = $request->input('MCQOptions');
        $MCQExamYear = $request->input('MCQExamYear');
        DB::table('questions_mcq')->where('mcq_id', $q_id)->update(['mcq_op_count' => $MCQOptions,'mcq_ey_id' => $MCQExamYear]);
        $CheckQuestion3 = DB::table('questions')->select('q_status')->where('q_question_id', $q_id)->where('q_qt_id', $qt_id)->get();
        if($CheckQuestion3->first()->q_status == 3)
            {
                DB::table('questions')->where('q_question_id', $q_id)->where('q_qt_id', $qt_id)->update(['q_status' => 0]);
                DB::table('questions_mcq')->where('mcq_id', $q_id)->update(['mcq_status' => 0]);
            }
        return view('admin/source/question/questionedit',['q_id' => $q_id,'qt_id' => $qt_id]);
    }
    public function adminEditUMCQ(Request $request)
    {
        $q_id = $request->input('q_id');
        $qt_id = $request->input('qt_id');
        $OptionCount = $request->input('OptionCount');
         for($i = 1; $i <= $OptionCount; $i++)
            {
                $TextOption = $request->input("TextOption$i");
                DB::table('questions_mcq')->where('mcq_id', $q_id)->update(["mcq_op_$i" => $TextOption]);
            }
        $MCQOuestion = $request->input('TextQuestion');
        $MCQCorrectAns = $request->input('TextCorrectAns');
        $MCQDescription = $request->input('TextDescription');
        $MCQLink = $request->input('TextLink');
        DB::table('questions_mcq')->where('mcq_id', $q_id)->update(["mcq_question" => $MCQOuestion,"mcq_a" => $MCQCorrectAns,"mcq_d" => $MCQDescription,"mcq_link" => $MCQLink ]);
        $CheckQuestion3 = DB::table('questions')->select('q_status')->where('q_question_id', $q_id)->where('q_qt_id', $qt_id)->get();
        if($CheckQuestion3->first()->q_status == 3)
            {
                DB::table('questions')->where('q_question_id', $q_id)->where('q_qt_id', $qt_id)->update(['q_status' => 0]);
                DB::table('questions_mcq')->where('mcq_id', $q_id)->update(['mcq_status' => 0]);
            }
        return view('admin/source/question/questionedit',['q_id' => $q_id,'qt_id' => $qt_id]);
    }
     public function adminEditUEMQOption(Request $request)
    {
        $q_id = $request->input('q_id');
        $qt_id = $request->input('qt_id');
        $EMQOptions = $request->input('EMQOptions');
        $EMQQuestion = $request->input('EMQQuestion');
        for($i = 1; $i <= $EMQQuestion; $i++)
            {
                $Checkemqgharh = DB::table('questions_emq_graph')->select('emqg_id')->where('emqg_emq_id', $q_id)->where('emqg_inner_q_id', $i)->get();
                if ($Checkemqgharh->isEmpty())
                    {
                            DB::table('questions_emq_graph')->insert([
                            'emqg_emq_id' => $q_id,
                            'emqg_inner_q_id' => $i,
                            ]);
                    }
            }
        $EMQExamYear = $request->input('EMQExamYear');
        DB::table('questions_emq')->where('emq_id', $q_id)->update(['emq_op_count' => $EMQOptions,'emq_q_count' => $EMQQuestion,'emq_ey_id' => $EMQExamYear]);
        $CheckQuestion3 = DB::table('questions')->select('q_status')->where('q_question_id', $q_id)->where('q_qt_id', $qt_id)->get();
        if($CheckQuestion3->first()->q_status == 3)
            {
                DB::table('questions')->where('q_question_id', $q_id)->where('q_qt_id', $qt_id)->update(['q_status' => 0]);
                DB::table('questions_emq')->where('emq_id', $q_id)->update(['emq_status' => 0]);
            }
        return view('admin/source/question/questionedit',['q_id' => $q_id,'qt_id' => $qt_id]);
    }
    public function adminEditUEMQ(Request $request)
    {
        $q_id = $request->input('q_id');
        $qt_id = $request->input('qt_id');
        $EMQTheme = $request->input('TextTheme');
        $EMQReference = $request->input('TextReference');
        $EMQLeadIn = $request->input('TextLeadIn');
        $EMQLink = $request->input('TextLink');
        DB::table('questions_emq')->where('emq_id', $q_id)->update(["emq_theme" => $EMQTheme,"emq_reference" => $EMQReference,"emq_lead_in" => $EMQLeadIn,"emq_link" => $EMQLink ]);
        $OptionCount = $request->input('OptionCount');
         for($i = 1; $i <= $OptionCount; $i++)
            {
                $TextOption = $request->input("TextOption$i");
                DB::table('questions_emq')->where('emq_id', $q_id)->update(["emq_op_$i" => $TextOption]);
            }
        $QuestionCount = $request->input('QuestionCount');
         for($j = 1; $j <= $QuestionCount; $j++)
            {
                $TextQuestion = $request->input("TextQuestion$j");
                $TextCorrectAns = $request->input("TextCorrectAns$j");
                $TextExplanation = $request->input("TextExplanation$j");
                DB::table('questions_emq')->where('emq_id', $q_id)->update(["emq_q_$j" => $TextQuestion,"emq_a_$j" => $TextCorrectAns,"emq_d_$j" => $TextExplanation]);
            }
        $CheckQuestion3 = DB::table('questions')->select('q_status')->where('q_question_id', $q_id)->where('q_qt_id', $qt_id)->get();
        if($CheckQuestion3->first()->q_status == 3)
            {
                DB::table('questions')->where('q_question_id', $q_id)->where('q_qt_id', $qt_id)->update(['q_status' => 0]);
                DB::table('questions_emq')->where('emq_id', $q_id)->update(['emq_status' => 0]);
            }
        return view('admin/source/question/questionedit',['q_id' => $q_id,'qt_id' => $qt_id]);
    }
    public function adminEditUFCOption(Request $request)
    {
        $q_id = $request->input('q_id');
        $qt_id = $request->input('qt_id');
        $FCExamYear = $request->input('FCExamYear');
        DB::table('questions_fc')->where('fc_id', $q_id)->update(['fc_ey_id' => $FCExamYear]);
        $CheckQuestion3 = DB::table('questions')->select('q_status')->where('q_question_id', $q_id)->where('q_qt_id', $qt_id)->get();
        if($CheckQuestion3->first()->q_status == 3)
            {
                DB::table('questions')->where('q_question_id', $q_id)->where('q_qt_id', $qt_id)->update(['q_status' => 0]);
                DB::table('questions_fc')->where('fc_id', $q_id)->update(['fc_status' => 0]);
            }
        return view('admin/source/question/questionedit',['q_id' => $q_id,'qt_id' => $qt_id]);
    }
     public function adminEditUFC(Request $request)
    {
        $q_id = $request->input('q_id');
        $qt_id = $request->input('qt_id');
        $FCQuestion = $request->input('TextQuestion');
        $FCAnswer = $request->input('TextAnswer');
        $FCExplanation = $request->input('TextExplanation');
        $FCLink = $request->input('TextLink');
        DB::table('questions_fc')->where('fc_id', $q_id)->update(["fc_question" => $FCQuestion,"fc_answer" => $FCAnswer,"fc_description" => $FCExplanation,"fc_link" => $FCLink ]);
        $CheckQuestion3 = DB::table('questions')->select('q_status')->where('q_question_id', $q_id)->where('q_qt_id', $qt_id)->get();
        if($CheckQuestion3->first()->q_status == 3)
            {
                DB::table('questions')->where('q_question_id', $q_id)->where('q_qt_id', $qt_id)->update(['q_status' => 0]);
                DB::table('questions_fc')->where('fc_id', $q_id)->update(['fc_status' => 0]);
            }
        return view('admin/source/question/questionedit',['q_id' => $q_id,'qt_id' => $qt_id]);
    }
}
