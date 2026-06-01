<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\subscribe;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
class WorkboardController extends Controller
{
    public function workboard($linkDatastring)
    {
        $linkData = explode(",", $linkDatastring);
        $testid = $linkData[0];
        $StartExamType = $linkData[1];
        $Tests = DB::table('tests')->where([['t_u_id', auth()->id()],['t_id', $testid]])->get();
        $e_id = $Tests->first()->t_e_id;
        $TestLenth = $Tests->first()->t_lenth;
        $modified_string = $Tests->first()->t_questions;
        //Check Session Completed Goto Result
        $QC_Result = explode(',', $modified_string);
        $QC_Result_Count = count($QC_Result);
        $CheckString = "";
        for($c = 0; $c < $QC_Result_Count; $c++)
            {
                $QC_ResultIn = explode(':', $QC_Result[$c]);
                $CheckString .= $QC_ResultIn[3].",";                
            }
        $Modified_CheckString = substr($CheckString, 0, -1);
        if (str_contains($Modified_CheckString, 0)) 
            {
               if($StartExamType == 1)
                    {
                        $dataA = date("Y-m-d H:i:s", time());
                        $JavaDatTime = strtotime('+'.$TestLenth.' minutes', strtotime($dataA));
                        $JavaDatTime = $JavaDatTime * 1000;
                        DB::table('tests')->where('t_id', $testid)->update(['t_timer_end' => $JavaDatTime]);
                    }
                if($StartExamType == 2)
                    {
                        $JavaDatTime = $Tests->first()->t_timer_end ?? 0;
                    }
                ?>
                <script>
                    var min = '<?php echo $JavaDatTime; ?>';
                    countdownTime = new Date().getTime() + (min * 60 * 1000);
                    localStorage.setItem('timer_end', min);
                    var localtimervalue = localStorage.getItem('timer_end');
                </script>
                <?php
                return view('dashboard/exam/workboard',['testid' => $testid, 'Tests' => $Tests, 'e_id' => $e_id]);
            }
        else
            return view('dashboard/exam/result',['testid' => $testid, 'Tests' => $Tests, 'e_id' => $e_id]);
    }
    public function submitmcq($testid, Request $request)
    {
        //Get Test Details
        $TestsDB = DB::table('tests')->where([['t_u_id', auth()->id()],['t_id', $testid]])->get();
        $data = $request->validate([
            'option' => 'required',
            'Question_ID' => 'required',
            'NextQuestion' => 'required',
            'Question_No' => 'required', 
            'Question_QT' => 'required' 
        ]);
        $QuestionID = $data['Question_ID'];
        $NextQuestion = $data['NextQuestion'];
        $QuestionQT = $data['Question_QT'];
        $QuestionNo = $data['Question_No'];
        $Alphabet = chr(64 + $data['option']);
        $QuestionMCQ = DB::table('questions_mcq')->select('*')->where('mcq_id', $QuestionID)->get();
        $MCQ_ID = $QuestionMCQ->first()->mcq_id ?? 'No Option Found';
        $CorrectAnswer = $QuestionMCQ->first()->mcq_a ?? 'No Option Found';
        //Graph Update
        $GraphCol = "mcq_g_".$data['option'];
        $QuestionGraph = DB::table('questions_mcq')->select($GraphCol)->where('mcq_id', $QuestionID)->get();
        $CurrentGraphValue = $QuestionGraph->first()->$GraphCol ?? 0;
        $UpdatedGraphValue = $CurrentGraphValue + 1;
        //Update Graph MYSQL Query
        DB::table('questions_mcq')->where('mcq_id', $QuestionID)->update([$GraphCol => $UpdatedGraphValue]);
        //User Answer Check
        if($Alphabet == $CorrectAnswer) { $UserAnswer = 1; } else { $UserAnswer = 0;}
        $AnsBlock = $Alphabet."'".$UserAnswer.".0'0.0'0.0'0.0'0.0'0.0'0.0'0.0'0.0'0";
        //Update Test Table
        $UpdateTestData = '';
        foreach ($TestsDB as $item_db)
            {
                $Questions = explode(',', $item_db->t_questions);
                $QuestionCount = count($Questions);
                $SrNo = 1;
                for($i = 0; $i < $QuestionCount; $i++)
                    {
                        $Question = explode(':', $Questions[$i]);
                        if($NextQuestion == $Question[0])
                            {
                                $UpdateTestData .=  $Question[0].":".$Question[1].":".$AnsBlock.":1,";
                            }
                        else
                            {
                                $UpdateTestData .=  $Question[0].":".$Question[1].":".$Question[2].":".$Question[3].",";
                            }
                    }
            }
        $modified_string = substr($UpdateTestData, 0, -1);
        //Update Test Data
        DB::table('tests')->where('t_id', $testid)->update(['t_questions' => $modified_string ,'t_answered' => $QuestionNo]);
        //Get Updated Test Details
        $Tests = DB::table('tests')->where([['t_u_id', auth()->id()],['t_id', $testid]])->get();
        $e_id = $Tests->first()->t_e_id;
        //Check Session Completed Goto Result
        $QC_Result = explode(',', $modified_string);
        $QC_Result_Count = count($QC_Result);
        $CheckString = "";
        for($c = 0; $c < $QC_Result_Count; $c++)
            {
                $QC_ResultIn = explode(':', $QC_Result[$c]);
                $CheckString .= $QC_ResultIn[3].",";                
            }
        $Modified_CheckString = substr($CheckString, 0, -1);
        if (str_contains($Modified_CheckString, 0)) 
            return view('dashboard/exam/workboard',['testid' => $testid, 'Tests' => $Tests, 'e_id' => $e_id, 'Q_No' => $QuestionNo]);
        else
            return view('dashboard/exam/result',['testid' => $testid, 'Tests' => $Tests, 'e_id' => $e_id, 'Q_No' => $QuestionNo]);       
    }
    public function submitemq($testid, Request $request)
    {
        $TestsDB = DB::table('tests')->where([['t_u_id', auth()->id()],['t_id', $testid]])->get();
        $data = $request->validate([
            'option' => 'required',
            'Question_ID' => 'required',
            'NextQuestion' => 'required',
            'Question_No' => 'required', 
            'Question_QT' => 'required' 
        ]);
        $QuestionID = $data['Question_ID'];
        $NextQuestion = $data['NextQuestion'];
        $QuestionQT = $data['Question_QT'];
        $QuestionNo = $data['Question_No'];
        $Options = $data['option'];
        $QuestionCount = count($Options);
        $AnsBlockParts = "";
        foreach ($Options as $Option)
            {
                if($Option == 0)
                    {
                        //User has not selected any option for this question
                        $AnsBlockPart = ".0'0";       
                    }
                else
                    {
                        $Question = explode(':', $Option);
                        //Check Answer is Correct or Not
                        $UserAns = chr(64 + $Question[1]);
                        $QuestionEMQ = DB::table('questions_emq')->select('*')->where('emq_id', $QuestionID)->get();
                        $EMQAndCol = "emq_a_".$Question[0];
                        $CorrectAnswer = $QuestionEMQ->first()->$EMQAndCol ?? 'No Option Found';
                        if($UserAns == $CorrectAnswer) { $AnsBlockPart = ".".$UserAns."'1"; } else { $AnsBlockPart = ".".$UserAns."'0"; }
                        //Add Graph Update Here
                        $EMQGraph = DB::table('questions_emq_graph')->select('*')->where('emqg_emq_id', $QuestionID)->where('emqg_inner_q_id', $Question[0])->get();
                        $EMQGraphCol = "emqg_ans_".$Question[1];
                        $CurrentGraphValue = $EMQGraph->first()->$EMQGraphCol ?? 0;
                        $UpdatedGraphValue = $CurrentGraphValue + 1;
                        //Update Graph MYSQL Query
                        DB::table('questions_emq_graph')->where('emqg_emq_id', $QuestionID)->where('emqg_inner_q_id', $Question[0])->update([$EMQGraphCol => $UpdatedGraphValue]);
                    }
                $AnsBlockParts .= $AnsBlockPart;
            }    
        $AnsBlockParts = substr($AnsBlockParts, 1);
        $AddNullAns = 10 - $QuestionCount;
        $NullAns = "";
        for($i = 0; $i < $AddNullAns; $i++)
            {
                $NullAns .= ".0'0";
            }
        $AnsBlock = $AnsBlockParts.$NullAns;  
        $UpdateTestData = '';
        foreach ($TestsDB as $item_db)
            {
                $Questions = explode(',', $item_db->t_questions);
                $QuestionCount = count($Questions);
                $SrNo = 1;
                for($i = 0; $i < $QuestionCount; $i++)
                    {
                        $Question = explode(':', $Questions[$i]);
                        if($NextQuestion == $Question[0])
                            {
                                $UpdateTestData .=  $Question[0].":".$Question[1].":".$AnsBlock.":1,";
                            }
                        else
                            {
                                $UpdateTestData .=  $Question[0].":".$Question[1].":".$Question[2].":".$Question[3].",";
                            }
                    }
            }
        $modified_string = substr($UpdateTestData, 0, -1);
        //Update Test Data
        DB::table('tests')->where('t_id', $testid)->update(['t_questions' => $modified_string,'t_answered' => $QuestionNo]);
        $Tests = DB::table('tests')->where([['t_u_id', auth()->id()],['t_id', $testid]])->get();
        $e_id = $Tests->first()->t_e_id;
        //Check Session Completed Goto Result
        $QC_Result = explode(',', $modified_string);
        $QC_Result_Count = count($QC_Result);
        $CheckString = "";
        for($c = 0; $c < $QC_Result_Count; $c++)
            {
                $QC_ResultIn = explode(':', $QC_Result[$c]);
                $CheckString .= $QC_ResultIn[3].",";                
            }
        $Modified_CheckString = substr($CheckString, 0, -1);
        if (str_contains($Modified_CheckString, 0)) 
            return view('dashboard/exam/workboard',['testid' => $testid, 'Tests' => $Tests, 'e_id' => $e_id, 'Q_No' => $QuestionNo]);
        else
            return view('dashboard/exam/result',['testid' => $testid, 'Tests' => $Tests, 'e_id' => $e_id, 'Q_No' => $QuestionNo]);       
    }
    public function questionskip($linkData)
    {
        $Data = explode(',', $linkData);
        $testid = $Data[0];
        $QuestionID = $Data[1];
        $QuestionNo = $Data[2];
        $UpdateTestData = '';
        $TestDB = DB::table('tests')->where([['t_u_id', auth()->id()],['t_id', $testid]])->get();
        $e_id = $TestDB->first()->t_e_id;
        $DBQuestions = $TestDB->first()->t_questions;
        $Questions = explode(',', $DBQuestions);
        $QuestionsCount = count($Questions);
        for($i = 0; $i < $QuestionsCount; $i++)
            {
                $Question = explode(':', $Questions[$i]);
                if($QuestionID == $Question[0])
                    {
                        $UpdateTestData .=  $Question[0].":".$Question[1].":".$Question[2].":2,";
                    }
                else
                    {
                        $UpdateTestData .=  $Question[0].":".$Question[1].":".$Question[2].":".$Question[3].",";
                    }
            }
            $modified_string = substr($UpdateTestData, 0, -1);
            DB::table('tests')->where('t_id', $testid)->update(['t_questions' => $modified_string,'t_answered' => $QuestionNo]);
            //Get Updated Test Details
            $Tests = DB::table('tests')->where([['t_u_id', auth()->id()],['t_id', $testid]])->get();
            $e_id = $Tests->first()->t_e_id;
            //Check Session Completed Goto Result
            $QC_Result = explode(',', $modified_string);
            $QC_Result_Count = count($QC_Result);
            $CheckString = "";
            for($c = 0; $c < $QC_Result_Count; $c++)
                {
                    $QC_ResultIn = explode(':', $QC_Result[$c]);
                    $CheckString .= $QC_ResultIn[3].",";                
                }
            $Modified_CheckString = substr($CheckString, 0, -1);
            if (str_contains($Modified_CheckString, 0)) 
                return view('dashboard/exam/workboard',['testid' => $testid, 'Tests' => $Tests, 'e_id' => $e_id, 'Q_No' => $QuestionNo]);
            else
                return view('dashboard/exam/result',['testid' => $testid, 'Tests' => $Tests, 'e_id' => $e_id, 'Q_No' => $QuestionNo]);
    }
    //Revision Workboard Function
    public function workboard_r($testid)
    {
        $Tests = DB::table('tests')->where([['t_u_id', auth()->id()],['t_id', $testid]])->get();
        $e_id = $Tests->first()->t_e_id;
        $modified_string = $Tests->first()->t_questions;
        //Check Session Completed Goto Result
        $QC_Result = explode(',', $modified_string);
        $QC_Result_Count = count($QC_Result);
        $CheckString = "";
        for($c = 0; $c < $QC_Result_Count; $c++)
            {
                $QC_ResultIn = explode(':', $QC_Result[$c]);
                $CheckString .= $QC_ResultIn[3].",";                
            }
        $Modified_CheckString = substr($CheckString, 0, -1);
        if (str_contains($Modified_CheckString, 0)) 
            return view('dashboard/exam/workboard_r',['testid' => $testid, 'Tests' => $Tests, 'e_id' => $e_id]);
        else
            return view('dashboard/exam/result',['testid' => $testid, 'Tests' => $Tests, 'e_id' => $e_id]);
    }
    public function submitrmcq($testid, Request $request)
    {
        //Get Test Details
        $TestsDB = DB::table('tests')->where([['t_u_id', auth()->id()],['t_id', $testid]])->get();
        $data = $request->validate([
            'option' => 'required',
            'Question_ID' => 'required',
            'NextQuestion' => 'required',
            'Question_No' => 'required', 
            'Question_QT' => 'required' 
        ]);
        $QuestionID = $data['Question_ID'];
        $NextQuestion = $data['NextQuestion'];
        $QuestionQT = $data['Question_QT'];
        $QuestionNo = $data['Question_No'];
        $Alphabet = chr(64 + $data['option']);
        $QuestionMCQ = DB::table('questions_mcq')->select('*')->where('mcq_id', $QuestionID)->get();
        $MCQ_ID = $QuestionMCQ->first()->mcq_id ?? 'No Option Found';
        $CorrectAnswer = $QuestionMCQ->first()->mcq_a ?? 'No Option Found';
        //Graph Update
        $GraphCol = "mcq_g_".$data['option'];
        $QuestionGraph = DB::table('questions_mcq')->select($GraphCol)->where('mcq_id', $QuestionID)->get();
        $CurrentGraphValue = $QuestionGraph->first()->$GraphCol ?? 0;
        $UpdatedGraphValue = $CurrentGraphValue + 1;
        //Update Graph MYSQL Query
        DB::table('questions_mcq')->where('mcq_id', $QuestionID)->update([$GraphCol => $UpdatedGraphValue]);
        //User Answer Check
        if($Alphabet == $CorrectAnswer) { $UserAnswer = 1; } else { $UserAnswer = 0;}
        $AnsBlock = $Alphabet."'".$UserAnswer.".0'0.0'0.0'0.0'0.0'0.0'0.0'0.0'0.0'0";
        //Update Test Table
        $UpdateTestData = '';
        foreach ($TestsDB as $item_db)
            {
                $Questions = explode(',', $item_db->t_questions);
                $QuestionCount = count($Questions);
                $SrNo = 1;
                for($i = 0; $i < $QuestionCount; $i++)
                    {
                        $Question = explode(':', $Questions[$i]);
                        if($NextQuestion == $Question[0])
                            {
                                $UpdateTestData .=  $Question[0].":".$Question[1].":".$AnsBlock.":2,";
                            }
                        else
                            {
                                $UpdateTestData .=  $Question[0].":".$Question[1].":".$Question[2].":".$Question[3].",";
                            }
                    }
            }
        $modified_string = substr($UpdateTestData, 0, -1);
        //Update Test Data
        DB::table('tests')->where('t_id', $testid)->update(['t_questions' => $modified_string,'t_answered' => $QuestionNo]);
        //Get Updated Test Details
        $Tests = DB::table('tests')->where([['t_u_id', auth()->id()],['t_id', $testid]])->get();
        $e_id = $Tests->first()->t_e_id;
        //Check Session Completed Goto Result
        $QC_Result = explode(',', $modified_string);
        $QC_Result_Count = count($QC_Result);
        $CheckString = "";
        for($c = 0; $c < $QC_Result_Count; $c++)
            {
                $QC_ResultIn = explode(':', $QC_Result[$c]);
                $CheckString .= $QC_ResultIn[3].",";                
            }
        $Modified_CheckString = substr($CheckString, 0, -1);
        return view('dashboard/exam/workboard_r',['testid' => $testid, 'Tests' => $Tests, 'e_id' => $e_id, 'Q_No' => $QuestionNo]);
    }
    public function submitramcq($testid, Request $request)
    {
        //Get Test Details
        $TestsDB = DB::table('tests')->where([['t_u_id', auth()->id()],['t_id', $testid]])->get();
        $data = $request->validate([
            'Question_ID' => 'required',
            'NextQuestion' => 'required',
            'Question_No' => 'required', 
            'Question_QT' => 'required'  
        ]);
        $QuestionID = $data['Question_ID'];
        $NextQuestion = $data['NextQuestion'];
        $QuestionQT = $data['Question_QT'];
        $QuestionNo = $data['Question_No'];
        //Update Test Table
        $UpdateTestData = '';
        foreach ($TestsDB as $item_db)
            {
                $Questions = explode(',', $item_db->t_questions);
                $QuestionCount = count($Questions);
                $SrNo = 1;
                for($i = 0; $i < $QuestionCount; $i++)
                    {
                        $Question = explode(':', $Questions[$i]);
                        if($NextQuestion == $Question[0])
                            {
                                $UpdateTestData .=  $Question[0].":".$Question[1].":".$Question[2].":1,";
                            }
                        else
                            {
                                $UpdateTestData .=  $Question[0].":".$Question[1].":".$Question[2].":".$Question[3].",";
                            }
                    }
            }
        $modified_string = substr($UpdateTestData, 0, -1);
        //Update Test Data
        DB::table('tests')->where('t_id', $testid)->update(['t_questions' => $modified_string,'t_answered' => $QuestionNo]);
        //Get Updated Test Details
        $Tests = DB::table('tests')->where([['t_u_id', auth()->id()],['t_id', $testid]])->get();
        $e_id = $Tests->first()->t_e_id;
        //Check Session Completed Goto Result
        $QC_Result = explode(',', $modified_string);
        $QC_Result_Count = count($QC_Result);
        $CheckString = "";
        for($c = 0; $c < $QC_Result_Count; $c++)
            {
                $QC_ResultIn = explode(':', $QC_Result[$c]);
                $CheckString .= $QC_ResultIn[3].",";                
            }
        $Modified_CheckString = substr($CheckString, 0, -1);
        if (str_contains($Modified_CheckString, 0)) 
            return view('dashboard/exam/workboard_r',['testid' => $testid, 'Tests' => $Tests, 'e_id' => $e_id, 'Q_No' => $QuestionNo]);
        else
            return view('dashboard/exam/result',['testid' => $testid, 'Tests' => $Tests, 'e_id' => $e_id, 'Q_No' => $QuestionNo]);
    }
    public function submitremq($testid, Request $request)
    {
        $TestsDB = DB::table('tests')->where([['t_u_id', auth()->id()],['t_id', $testid]])->get();
        $data = $request->validate([
            'option' => 'required',
            'Question_ID' => 'required',
            'NextQuestion' => 'required',
            'Question_No' => 'required', 
            'Question_QT' => 'required'
        ]);
        $QuestionID = $data['Question_ID'];
        $NextQuestion = $data['NextQuestion'];
        $QuestionQT = $data['Question_QT'];
        $QuestionNo = $data['Question_No'];
        $Options = $data['option'];
        $QuestionCount = count($Options);
        $AnsBlockParts = "";
        foreach ($Options as $Option)
            {
                if($Option == 0)
                    {
                        //User has not selected any option for this question
                        $AnsBlockPart = ".0'0";       
                    }
                else
                    {
                        $Question = explode(':', $Option);
                        //Check Answer is Correct or Not
                        $UserAns = chr(64 + $Question[1]);
                        $QuestionEMQ = DB::table('questions_emq')->select('*')->where('emq_id', $QuestionID)->get();
                        $EMQAndCol = "emq_a_".$Question[0];
                        $CorrectAnswer = $QuestionEMQ->first()->$EMQAndCol ?? 'No Option Found';
                        if($UserAns == $CorrectAnswer) { $AnsBlockPart = ".".$UserAns."'1"; } else { $AnsBlockPart = ".".$UserAns."'0"; }
                        //Add Graph Update Here
                        $EMQGraph = DB::table('questions_emq_graph')->select('*')->where('emqg_emq_id', $QuestionID)->where('emqg_inner_q_id', $Question[0])->get();
                        $EMQGraphCol = "emqg_ans_".$Question[1];
                        $CurrentGraphValue = $EMQGraph->first()->$EMQGraphCol ?? 0;
                        $UpdatedGraphValue = $CurrentGraphValue + 1;
                        //Update Graph MYSQL Query
                        DB::table('questions_emq_graph')->where('emqg_emq_id', $QuestionID)->where('emqg_inner_q_id', $Question[0])->update([$EMQGraphCol => $UpdatedGraphValue]);
                    }
                $AnsBlockParts .= $AnsBlockPart;
            }    
        $AnsBlockParts = substr($AnsBlockParts, 1);
        $AddNullAns = 10 - $QuestionCount;
        $NullAns = "";
        for($i = 0; $i < $AddNullAns; $i++)
            {
                $NullAns .= ".0'0";
            }
        $AnsBlock = $AnsBlockParts.$NullAns;  
        $UpdateTestData = '';
        foreach ($TestsDB as $item_db)
            {
                $Questions = explode(',', $item_db->t_questions);
                $QuestionCount = count($Questions);
                $SrNo = 1;
                for($i = 0; $i < $QuestionCount; $i++)
                    {
                        $Question = explode(':', $Questions[$i]);
                        if($NextQuestion == $Question[0])
                            {
                                $UpdateTestData .=  $Question[0].":".$Question[1].":".$AnsBlock.":2,";
                            }
                        else
                            {
                                $UpdateTestData .=  $Question[0].":".$Question[1].":".$Question[2].":".$Question[3].",";
                            }
                    }
            }
        $modified_string = substr($UpdateTestData, 0, -1);
        //Update Test Data
        DB::table('tests')->where('t_id', $testid)->update(['t_questions' => $modified_string,'t_answered' => $QuestionNo]);
        $Tests = DB::table('tests')->where([['t_u_id', auth()->id()],['t_id', $testid]])->get();
        $e_id = $Tests->first()->t_e_id;
        //Check Session Completed Goto Result
        $QC_Result = explode(',', $modified_string);
        $QC_Result_Count = count($QC_Result);
        $CheckString = "";
        for($c = 0; $c < $QC_Result_Count; $c++)
            {
                $QC_ResultIn = explode(':', $QC_Result[$c]);
                $CheckString .= $QC_ResultIn[3].",";                
            }
        $Modified_CheckString = substr($CheckString, 0, -1);
        return view('dashboard/exam/workboard_r',['testid' => $testid, 'Tests' => $Tests, 'e_id' => $e_id, 'Q_No' => $QuestionNo]);
    }
    public function submitraemq($testid, Request $request)
    {
        //Get Test Details
        $TestsDB = DB::table('tests')->where([['t_u_id', auth()->id()],['t_id', $testid]])->get();
        $data = $request->validate([
            'Question_ID' => 'required',
            'NextQuestion' => 'required',
            'Question_No' => 'required', 
            'Question_QT' => 'required' 
        ]);
        $QuestionID = $data['Question_ID'];
        $NextQuestion = $data['NextQuestion'];
        $QuestionQT = $data['Question_QT'];
        $QuestionNo = $data['Question_No'];
        //Update Test Table
        $UpdateTestData = '';
        foreach ($TestsDB as $item_db)
            {
                $Questions = explode(',', $item_db->t_questions);
                $QuestionCount = count($Questions);
                $SrNo = 1;
                for($i = 0; $i < $QuestionCount; $i++)
                    {
                        $Question = explode(':', $Questions[$i]);
                        if($NextQuestion == $Question[0])
                            {
                                $UpdateTestData .=  $Question[0].":".$Question[1].":".$Question[2].":1,";
                            }
                        else
                            {
                                $UpdateTestData .=  $Question[0].":".$Question[1].":".$Question[2].":".$Question[3].",";
                            }
                    }
            }
        $modified_string = substr($UpdateTestData, 0, -1);
        //Update Test Data
        DB::table('tests')->where('t_id', $testid)->update(['t_questions' => $modified_string,'t_answered' => $QuestionNo]);
        //Get Updated Test Details
        $Tests = DB::table('tests')->where([['t_u_id', auth()->id()],['t_id', $testid]])->get();
        $e_id = $Tests->first()->t_e_id;
        //Check Session Completed Goto Result
        $QC_Result = explode(',', $modified_string);
        $QC_Result_Count = count($QC_Result);
        $CheckString = "";
        for($c = 0; $c < $QC_Result_Count; $c++)
            {
                $QC_ResultIn = explode(':', $QC_Result[$c]);
                $CheckString .= $QC_ResultIn[3].",";                
            }
        $Modified_CheckString = substr($CheckString, 0, -1);
        if (str_contains($Modified_CheckString, 0)) 
            return view('dashboard/exam/workboard_r',['testid' => $testid, 'Tests' => $Tests, 'e_id' => $e_id, 'Q_No' => $QuestionNo]);
        else
            return view('dashboard/exam/result',['testid' => $testid, 'Tests' => $Tests, 'e_id' => $e_id, 'Q_No' => $QuestionNo]);
    }
    public function submitrfc($linkData)
    {
        $Data = explode(',', $linkData);
        $testid = $Data[0];
        $NextQuestion = $Data[1];
        $QuestionNo = $Data[2];
        //Get Test Details
        $TestsDB = DB::table('tests')->where([['t_u_id', auth()->id()],['t_id', $testid]])->get();
        //Update Test Table
        $UpdateTestData = '';
        foreach ($TestsDB as $item_db)
            {
                $Questions = explode(',', $item_db->t_questions);
                $QuestionCount = count($Questions);
                $SrNo = 1;
                for($i = 0; $i < $QuestionCount; $i++)
                    {
                        $Question = explode(':', $Questions[$i]);
                        if($NextQuestion == $Question[0])
                            {
                                $UpdateTestData .=  $Question[0].":".$Question[1].":".$Question[2].":2,";
                            }
                        else
                            {
                                $UpdateTestData .=  $Question[0].":".$Question[1].":".$Question[2].":".$Question[3].",";
                            }
                    }
            }
        $modified_string = substr($UpdateTestData, 0, -1);
        //Update Test Data
        DB::table('tests')->where('t_id', $testid)->update(['t_questions' => $modified_string,'t_answered' => $QuestionNo]);
        //Get Updated Test Details
        $Tests = DB::table('tests')->where([['t_u_id', auth()->id()],['t_id', $testid]])->get();
        $e_id = $Tests->first()->t_e_id;
        //Check Session Completed Goto Result
        $QC_Result = explode(',', $modified_string);
        $QC_Result_Count = count($QC_Result);
        $CheckString = "";
        for($c = 0; $c < $QC_Result_Count; $c++)
            {
                $QC_ResultIn = explode(':', $QC_Result[$c]);
                $CheckString .= $QC_ResultIn[3].",";                
            }
        $Modified_CheckString = substr($CheckString, 0, -1);
        return view('dashboard/exam/workboard_r',['testid' => $testid, 'Tests' => $Tests, 'e_id' => $e_id, 'Q_No' => $QuestionNo]);
    }
    public function submitrafc($linkData)
    {
        $Data = explode(',', $linkData);
        $testid = $Data[0];
        $NextQuestion = $Data[1];
        $QuestionNo = $Data[2];
        //Get Test Details
        $TestsDB = DB::table('tests')->where([['t_u_id', auth()->id()],['t_id', $testid]])->get();
        
        //Update Test Table
        $UpdateTestData = '';
        foreach ($TestsDB as $item_db)
            {
                $Questions = explode(',', $item_db->t_questions);
                $QuestionCount = count($Questions);
                $SrNo = 1;
                for($i = 0; $i < $QuestionCount; $i++)
                    {
                        $Question = explode(':', $Questions[$i]);
                        if($NextQuestion == $Question[0])
                            {
                                $UpdateTestData .=  $Question[0].":".$Question[1].":".$Question[2].":1,";
                            }
                        else
                            {
                                $UpdateTestData .=  $Question[0].":".$Question[1].":".$Question[2].":".$Question[3].",";
                            }
                    }
            }
        $modified_string = substr($UpdateTestData, 0, -1);
        //Update Test Data
        DB::table('tests')->where('t_id', $testid)->update(['t_questions' => $modified_string,'t_answered' => $QuestionNo]);
        //Get Updated Test Details
        $Tests = DB::table('tests')->where([['t_u_id', auth()->id()],['t_id', $testid]])->get();
        $e_id = $Tests->first()->t_e_id;
        //Check Session Completed Goto Result
        $QC_Result = explode(',', $modified_string);
        $QC_Result_Count = count($QC_Result);
        $CheckString = "";
        for($c = 0; $c < $QC_Result_Count; $c++)
            {
                $QC_ResultIn = explode(':', $QC_Result[$c]);
                $CheckString .= $QC_ResultIn[3].",";                
            }
        $Modified_CheckString = substr($CheckString, 0, -1);
        if (str_contains($Modified_CheckString, 0)) 
            return view('dashboard/exam/workboard_r',['testid' => $testid, 'Tests' => $Tests, 'e_id' => $e_id, 'Q_No' => $QuestionNo]);
        else
            return view('dashboard/exam/result',['testid' => $testid, 'Tests' => $Tests, 'e_id' => $e_id, 'Q_No' => $QuestionNo]);
    }
    public function finishexam($testid)
    {
        ?>
                <script>
                    localStorage.removeItem('timer_end');
                </script>
                <?php
        
        $UpdateTestData = '';
        $TestDB = DB::table('tests')->where([['t_u_id', auth()->id()],['t_id', $testid]])->get();
        $e_id = $TestDB->first()->t_e_id;
        $DBQuestions = $TestDB->first()->t_questions;
        $Questions = explode(',', $DBQuestions);
        $QuestionsCount = count($Questions);
        for($i = 0; $i < $QuestionsCount; $i++)
            {
                $Question = explode(':', $Questions[$i]);
                if($Question[3] == 0)
                    {
                        $UpdateTestData .=  $Question[0].":".$Question[1].":".$Question[2].":2,";
                    }
                else
                    {
                        $UpdateTestData .=  $Question[0].":".$Question[1].":".$Question[2].":".$Question[3].",";
                    }
            }
            $modified_string = substr($UpdateTestData, 0, -1);
            DB::table('tests')->where('t_id', $testid)->update(['t_questions' => $modified_string]);
            //Get Updated Test Details
            $Tests = DB::table('tests')->where([['t_u_id', auth()->id()],['t_id', $testid]])->get();
            $e_id = $Tests->first()->t_e_id;
            //Check Session Completed Goto Result
            return view('dashboard/exam/result',['testid' => $testid, 'Tests' => $Tests, 'e_id' => $e_id]);
            
    }    
}
