<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\subscribe;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;




class ExamController extends Controller
{
    public function updatedbentry()
    {
        
//  $FeedBacks = DB::table('feedback')->select('*')->whereBetween('fb_id', [2001, 3000])->get();
//  foreach ($FeedBacks as $FeedBack)
//         {
//                 $FBID = $FeedBack->fb_id ?? 'No User Found';
//                 echo $UserIDDM = $FeedBack->fb_u_id ?? 'No User Found';
//                 echo "<br>";
//                 echo $QuestionDM = $FeedBack->fb_q_id ?? 'No Question Found';
//                 echo "<br>";
//                 echo $QuestionInnerDM = $FeedBack->fb_inner_q ?? 'No Question Found';
//                 echo "<br>";
//                 echo $QuestionTypeDM = $FeedBack->fb_qt_id ?? 'No Question Found';
//                 echo "<br>";
//                 $FeedBackData = DB::table('feedback_data')->select('*')->where('fbd_fb_id', $FBID)->get();
//                 foreach($FeedBackData as $Data)
//                     {
//                         //echo $Message = $Data->fbd_message ?? 'No Message Found';
//                         $MessageTypeDM = $Data->fbd_reply ?? 'No Message Type Found';
//                         echo $MessageDM = $Data->fbd_message ?? 'No Message Found';
//                         if($MessageTypeDM == 3)
//                             {
//                                 $UserIDDM = "2";
//                             }
//                         echo "<br><br><br><br><br>";

//                         DB::table('conversation')->insert([
//                                     'co_u_id' => $UserIDDM,
//                                     'co_qt_id' => $QuestionTypeDM,
//                                     'co_q_id' => $QuestionDM,
//                                     'co_inner_q' => $QuestionInnerDM,
//                                     'co_message_type' => $MessageTypeDM,
//                                     'co_message' => $MessageDM,
//                                     'co_status' => 0,
//                                     'created_at' => Carbon::now(),
//                                     'updated_at' => Carbon::now(),
//                                     ]);

                        								

//                     }
//         }



//     dump($FeedBacks);
        echo "Done";
    }

    public function purchasedexam()
    {
        $userId = auth()->id();
        $Subscribes = DB::table('subscribes')->where('su_u_id', $userId)->orderBy('su_e_id', 'asc')->get();
        return view('dashboard/exam/exam',['Subscribes' => $Subscribes]);
    }

    public function showexam($e_id)
    {
        $Tests = DB::table('tests')->where([['t_u_id', auth()->id()],['t_e_id', $e_id]])->orderBy('t_id', 'desc')->get();
        return view('dashboard/exam/showexam',['e_id' => $e_id, 'Tests' => $Tests]);
    }

    public function createnew($e_id)
    {
        return view('dashboard/exam/createnew',['e_id' => $e_id, 'Subselecteds' => []]);
    }
      public function subsectionselected(Request $request)
    {
        $e_id = $request->input('e_id');
        $Subselected = $request->input('TopicSelection', []); 

        dump($Subselected);
        return view('dashboard/exam/createnew',['e_id' => $e_id, 'Subselecteds' => $Subselected]);
    }

    public function makeexam(Request $request)
    {
        $e_id = $request->input('e_id');
        $CheckCount = 1;
        $SelectedCat = "";
        $TopicSelections = $request->input('TopicSelection', []);
        foreach ($TopicSelections as $TopicSelection) {
            $CLevel1 = DB::table('exams')->select('e_id','e_inner_level','e_level')->where('e_inner_level', $TopicSelection)->get();
                foreach ($CLevel1 as $Level1) {
                    if ($CheckCount == 1)
                            {
                                $SelectedCat .= $Level1->e_inner_level;
                                $CheckCount++;
                            }
                        else
                            {
                                $SelectedCat .=",".$Level1->e_inner_level;
                            }
                    $CLevel2 = DB::table('exams')->select('e_id','e_inner_level','e_level')->where('e_level', $Level1->e_id)->where('e_status', '1')->get();
                    foreach ($CLevel2 as $Level2) {
                        $SelectedCat .=",".$Level2->e_inner_level;
                        $CLevel3 = DB::table('exams')->select('e_id','e_inner_level','e_level')->where('e_level', $Level2->e_id)->where('e_status', '1')->get();
                        foreach ($CLevel3 as $Level3) {
                            $SelectedCat .=",".$Level3->e_inner_level;
                            $CLevel4 = DB::table('exams')->select('e_id','e_inner_level','e_level')->where('e_level', $Level3->e_id)->where('e_status', '1')->get();
                            foreach ($CLevel4 as $Level4) {
                                $SelectedCat .=",".$Level4->e_inner_level;
                                $CLevel5 = DB::table('exams')->select('e_id','e_inner_level','e_level')->where('e_level', $Level4->e_id)->where('e_status', '1')->get();
                                foreach ($CLevel5 as $Level5) {
                                    $SelectedCat .=",".$Level5->e_inner_level;
                                    $CLevel6 = DB::table('exams')->select('e_id','e_inner_level','e_level')->where('e_level', $Level5->e_id)->where('e_status', '1')->get();
                                    foreach ($CLevel6 as $Level6) {
                                        $SelectedCat .=",".$Level6->e_inner_level;
                                        $CLevel7 = DB::table('exams')->select('e_id','e_inner_level','e_level')->where('e_level', $Level6->e_id)->where('e_status', '1')->get();
                                    }
                                }
                            }
                        }
                    }
                }
            }
            $selectedMode = $request->input('Mode');
            $selectedQueType = $request->input('QueType', []); 
            $selectedReviewed = $request->input('Reviewed');
            $selectedNoOfQue = $request->input('NoOfQue');
            $SelectedCat_Array = explode(',', $SelectedCat);
            //Get the questions which are already in the test_reviewed table for the user and course
            $TQs_Exist = DB::table('tests_reviewed')->where('tr_u_id', auth()->id())->where('tr_c_id', $e_id)->get();
            if (count($TQs_Exist) === 0) {
                    DB::table('tests_reviewed')->insert([
                    'tr_u_id' => auth()->id(),
                    'tr_c_id' => $e_id,
                    ]);
                }
            //Get Reviewed Questions
            $TQs = DB::table('tests_reviewed')->select('tr_questions')->where('tr_u_id', auth()->id())->where('tr_c_id', $e_id)->get();
            $RviewedArray = [];
            foreach ($TQs as $TQ) {
                $RviewedArray = array_merge($RviewedArray, explode(',', $TQ->tr_questions));
            }
            //Check if Reviewed is selected or not and get the questions accordingly.
            if($selectedReviewed == 1)
                {
                    $Questions = DB::table('questions')->select('q_id','q_e_inner_level','q_qt_id')->whereIn('q_e_inner_level', $SelectedCat_Array )->whereIn('q_qt_id', $selectedQueType )->where('q_status', '1')->inRandomOrder()->limit($selectedNoOfQue)->get();
                }
            else
                {
                    $Questions = DB::table('questions')->select('q_id','q_e_inner_level','q_qt_id')->whereIn('q_e_inner_level', $SelectedCat_Array )->whereIn('q_qt_id', $selectedQueType )->whereNotIn('q_id', $RviewedArray)->where('q_status', '1')->inRandomOrder()->limit($selectedNoOfQue)->get();
                }                
            //Selected Questions Create string to insert in the tests table and also to update in the tests_reviewed table
            //Structure of the string is q_id:q_qt_id:Status Quetion Answered or Not(Value 0,1)'(0.0.0.0.0.0.0.0.0.0 Ansawerd Status ):Answere (Value 0 for Wrong answered 1 Correct answered) 
            $Selected_Questions = "";
            foreach ($Questions as $loop => $Question)
                {
                    if ($loop == 0)
                        {
                            $Selected_Questions .= $Question->q_id.":".$Question->q_qt_id.":0'0.0'0.0'0.0'0.0'0.0'0.0'0.0'0.0'0.0'0:0";
                        }
                    else
                        {
                            $Selected_Questions .= ",".$Question->q_id.":".$Question->q_qt_id.":0'0.0'0.0'0.0'0.0'0.0'0.0'0.0'0.0'0.0'0:0";
                        }        
                }
            //Check if All Question Reviewed no Question Selected.
            if (empty($Selected_Questions)) 
                {
                    return view('dashboard/exam/message',['message' => '1', 'e_id' => $e_id]);
                }
            //Check the selected question type
            if ((in_array(1, $selectedQueType)) && (in_array(2, $selectedQueType)))
                {
                    //echo "MCQ AND EMQ is selected";
                    $EMQ_Count = 0;
                    $EMQ_Size = 0;
                    foreach (explode(',', $Selected_Questions) as $loopA => $QuestionA)
                        {
                            $QuestionDetails = explode(':', $QuestionA);
                            if($QuestionDetails[1] == 2)
                                {
                                    $QueEMQs = DB::table('questions')->select('q_question_id')->where('q_id', $QuestionDetails[0])->get();
                                    foreach ($QueEMQs as $loop => $QueEMQ)
                                        {
                                            $EMQ_Qs = DB::table('questions_emq')->select('emq_q_count')->where('emq_id', $QueEMQ->q_question_id)->get();
                                                foreach ($EMQ_Qs as $loop => $EMQ_Q)
                                                    {
                                                        $EMQ_Count += $EMQ_Q->emq_q_count;
                                                        $EMQ_Size++;

                                                    }
                                        }
                                }
                        }
                    $BalanceEMQ = $EMQ_Count - $EMQ_Size;
                    $NewLenth = $selectedNoOfQue + $BalanceEMQ;
                    $My_Questions = explode(',', $Selected_Questions);
                    foreach ($My_Questions as $loop => $My_Question)
                        {
                            $TestDetails = explode(':', $My_Question);
                            if($selectedNoOfQue < $NewLenth)
                                {
                                    if($TestDetails[1] == 1)
                                        {
                                            unset($My_Questions[$loop]);
                                            $NewLenth--;
                                        }
                                }
                            
                        }
                    $My_Questions = implode(",", $My_Questions);    
                }
            elseif (in_array(1, $selectedQueType))
                {
                    //echo "MCQ is selected";
                    $My_Questions = $Selected_Questions;
                    $NewLenth = $selectedNoOfQue;
                }
            elseif (in_array(2, $selectedQueType))
                {
                    //echo "EMQ is selected";
                    $Make_array = explode(',', $Selected_Questions);
                    if($selectedNoOfQue == 10)
                        {
                            $My_Questions = array_slice($Make_array, 0, 2);
                        }
                    elseif($selectedNoOfQue == 20)
                        {
                            $My_Questions = array_slice($Make_array, 0, 4);
                        }
                    elseif($selectedNoOfQue == 30)
                        {
                            $My_Questions = array_slice($Make_array, 0, 6);
                        }
                    elseif($selectedNoOfQue == 40)
                        {
                            $My_Questions = array_slice($Make_array, 0, 8);
                        }
                    elseif($selectedNoOfQue == 50)
                        {
                            $My_Questions = array_slice($Make_array, 0, 10);
                        }
                    elseif($selectedNoOfQue == 60)
                        {
                            $My_Questions = array_slice($Make_array, 0, 12);
                        }        
                    else
                        {
                            $My_Questions = $Make_array;
                        }
                        $EMQ_Count = 0;
                        foreach ($My_Questions as $loopA => $QuestionA)
                            {
                                $QuestionDetails = explode(':', $QuestionA);
                                $QueEMQs = DB::table('questions')->select('q_question_id')->where('q_id', $QuestionDetails[0])->get();
                                    foreach ($QueEMQs as $loop => $QueEMQ)
                                        {
                                            $EMQ_Qs = DB::table('questions_emq')->select('emq_q_count')->where('emq_id', $QueEMQ->q_question_id)->get();
                                                foreach ($EMQ_Qs as $loop => $EMQ_Q)
                                                    {
                                                        $EMQ_Count += $EMQ_Q->emq_q_count;
                                                    }
                                        }
                                    
                            }
                        $My_Questions = implode(",", $My_Questions); 
                        $NewLenth = $EMQ_Count;
                }
            elseif (in_array(3, $selectedQueType))
                {
                    //echo "MCQ is selected";
                    $My_Questions = $Selected_Questions;
                    $NewLenth = $selectedNoOfQue;
                }    
            $TimeStart = date("Y-m-d H:i:s");
            //Insert the test details in the tests table       
            DB::table('tests')->insert([
            't_type' => $selectedMode,
            't_u_id' => auth()->id(),
            't_e_id' => $e_id,
            't_questions' => $My_Questions,
            't_lenth' => $NewLenth,
            't_time_start' => $TimeStart,
            't_answered' => 0,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ]);
            $testid = DB::getPdo()->lastInsertId();
            //Check Rviewed Array have no value.
            if (count($RviewedArray) === 1) 
                {
                    $MergedArray = explode(',', $Selected_Questions);
                }
            else
                {
                    $MergedArray = array_merge($RviewedArray, explode(',', $Selected_Questions));
                }
            //Sort the Merged Array and remove duplicates and convert it to a string to update in the tests_reviewed table
            $sortedArray = collect($MergedArray)->sort()->unique()->values()->all();
            //Update the tests_reviewed table with the new reviewed questions
            DB::table('tests_reviewed')->where('tr_u_id', auth()->id())->where('tr_c_id', $e_id)->update(['tr_questions' => implode(',', $sortedArray),]);
            return view('dashboard/exam/viewexam',['testid' => $testid, 'e_id' => $e_id]);
    }
public function subsection($e_id)
    {
        return view('dashboard/exam/subsection',['e_id' => $e_id]);
    }

    
}
