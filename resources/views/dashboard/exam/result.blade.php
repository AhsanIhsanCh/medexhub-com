<style>
/*.chart-pie{position:relative;height:15rem;width:100%}@media (min-width:768px){.chart-pie{height:calc(20rem - 43px)*/
.simple-bar-chart{margin:0 auto;--line-count: 10;--line-color: currentcolor;--line-opacity: 0.25;--item-gap: 2%;--item-default-color: #060606; height: 20rem;width :50rem;display: grid;grid-auto-flow: column;gap: var(--item-gap);align-items: end;padding-inline: var(--item-gap);--padding-block: 1.5rem; /*space for labels*/padding-block: var(--padding-block);position: relative;isolation: isolate;}
.simple-bar-chart::after{content: "";position: absolute;inset: var(--padding-block) 0;z-index: -1;--line-width: 1px;--line-spacing: calc(100% / var(--line-count));/*background-image: repeating-linear-gradient(to top, transparent 0 calc(var(--line-spacing) - var(--line-width)), var(--line-color) 0 var(--line-spacing));*/box-shadow: 0 var(--line-width) 0 var(--line-color);opacity: var(--line-opacity);}
.simple-bar-chart > .item{height: calc(1% * var(--val));background-color: var(--clr, var(--item-default-color));position: relative;animation: item-height 1s ease forwards}
@keyframes item-height { from { height: 0 }}
.simple-bar-chart > .item > * { position: absolute; text-align: center }
.simple-bar-chart > .item > .label { inset: 100% 0 auto 0 }
.simple-bar-chart > .item > .value { inset: auto 0 100% 0 }
.simple-bar-chart2{margin:0 auto;--line-count: 10;--line-color: currentcolor;--line-opacity: 0.25;--item-gap: 2%;--item-default-color: #060606;height: 20rem;width :20rem;display: grid;grid-auto-flow: column;gap: var(--item-gap);align-items: end;padding-inline: var(--item-gap);--padding-block: 1.5rem; /*space for labels*/padding-block: var(--padding-block);position: relative;isolation: isolate;}
.simple-bar-chart2::after{content: "";position: absolute;inset: var(--padding-block) 0;z-index: -1;--line-width: 1px;--line-spacing: calc(100% / var(--line-count));/*background-image: repeating-linear-gradient(to top, transparent 0 calc(var(--line-spacing) - var(--line-width)), var(--line-color) 0 var(--line-spacing));*/box-shadow: 0 var(--line-width) 0 var(--line-color);opacity: var(--line-opacity);}
.simple-bar-chart2 > .item{height: calc(1% * var(--val));background-color: var(--clr, var(--item-default-color));position: relative;animation: item-height 1s ease forwards}
@keyframes item-height { from { height: 0 }}
.simple-bar-chart2 > .item > * { position: absolute; text-align: center }
.simple-bar-chart2 > .item > .label { inset: 100% 0 auto 0 }
.simple-bar-chart2 > .item > .value { inset: auto 0 100% 0 }
</style>
@php
use Carbon\Carbon;
@endphp
@include('frontend.index_header')
@php
    $Category = DB::table('exams')->select('e_name','e_info')->where('e_id', $e_id)->get();
    $CategoryName = $Category->first()->e_name ?? 'No Category Found'; 
    $QuestionNo = "1";
    $EMQNo = "1";
    $CorrectAnswerTotal = "0";
    $IncorrectAnswerTotal = "0";
    $SkipAnswerTotal = "0";
    $QNNumber = "1";
@endphp
<section class="section_padding" style="background: #FFFFFF; background: linear-gradient(0deg, rgba(255, 255, 255, 1) 0%, rgba(217, 235, 255, 1) 100%);">
    <div class="container">
        <div class="row">
            <div class="col-12 text-right"  > <a href="../showexam/{{$e_id}}" class="btn btn-success" bis_skin_checked="1">Back to Dashboard</a></div>
        </div>
        <div class="row">
            <div class="col-lg-9" >
                <h3>{{$CategoryName}}</h3>
                <div style="background-color: #6593ed; height: 4px; margin-bottom: 20px;"></div>
                @foreach ($Tests as $item)
                    @php
                        $Questions = explode(',', $item->t_questions);
                        $QuestionCount = count($Questions);
                        $NextQuestion = 0;
                        $SrNo = 1;
                        for($i = 0; $i < $QuestionCount; $i++)
                            {
                                $Question = explode(':', $Questions[$i]);
                                $QuestionSr = $Question[0];
                                $QuestionsDB = DB::table('questions')->select('q_question_id','q_qt_id')->where('q_id', $QuestionSr)->get();
                                $QuestionID = $QuestionsDB->first()->q_question_id ?? 'No Question Found';
                                $QuestionQT = $QuestionsDB->first()->q_qt_id ?? 'No Question Found';
                                if($QuestionQT == '1')
                                    {
                                        $QuestionMCQ = DB::table('questions_mcq')->select('*')->where('mcq_id', $QuestionID)->get();
                                        $QuestionText = $QuestionMCQ->first()->mcq_question ?? 'No Question Found';
                                        $QuestionExplanation = $QuestionMCQ->first()->mcq_d ?? 'No Explanation Found';
                                        $Option1 = $QuestionMCQ->first()->mcq_op_1 ?? 'No Option Found';
                                        $Option2 = $QuestionMCQ->first()->mcq_op_2 ?? 'No Option Found';
                                        $Option3 = $QuestionMCQ->first()->mcq_op_3 ?? 'No Option Found';
                                        $Option4 = $QuestionMCQ->first()->mcq_op_4 ?? 'No Option Found';
                                        $Option5 = $QuestionMCQ->first()->mcq_op_5 ?? 'No Option Found';
                                        $Option6 = $QuestionMCQ->first()->mcq_op_6 ?? 'No Option Found';
                                        $Option7 = $QuestionMCQ->first()->mcq_op_7 ?? 'No Option Found';
                                        $Option8 = $QuestionMCQ->first()->mcq_op_8 ?? 'No Option Found';
                                        $CorrectAnswer = $QuestionMCQ->first()->mcq_a ?? 'No Answer Found';
                                        echo '<div id="questionpos'.$QuestionNo.'" class="card mb-3 mt-3" style="width: 100%;border-radius: 10px;box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">';
                                            echo '<div class="card-body">
                                            <h5 class="card-title">Question No : '.$QuestionNo.'</h5>
                                            <p class="card-text">'.$QuestionText.'</p>
                                            </div>';
                                            $Answer1 = explode('.', $Question[2]);
                                            $Answer2 = explode("'", $Answer1[0]);
                                            $UserAnswer = $Answer2[0];
                                            $MCQOptionCount = $QuestionMCQ->first()->mcq_op_count ?? 0;
                                            for($a = 1; $a <= $MCQOptionCount; $a++)
                                                {
                                                    $Option = 'Option' . $a;
                                                    $Alphabet = chr(64 + $a);
                                                    if($Question[3] == 2)
                                                        {
                                                            if($CorrectAnswer == $Alphabet)
                                                                {
                                                                    echo '<div class="card" style="margin:0 auto;width: 95%;border-radius: 10px;margin-top:20px;padding-left: 10px;background-color: #ccffcc; ">
                                                                            <div class="card-body"><span style="color: green;"><strong>' . $Alphabet . '&nbsp;&nbsp;&nbsp;Correct Answer :</strong></span>&nbsp;&nbsp;&nbsp;&nbsp;' . ${$Option} . '</div>
                                                                            </div>';
                                                                    $SkipAnswerTotal++;        
                                                                }
                                                            else 
                                                                {
                                                                    echo '<div class="card" style="margin:0 auto;width: 95%;border-radius: 10px;margin-top:20px;padding-left: 10px; ">
                                                                            <div class="card-body"><strong>' . $Alphabet . '</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . ${$Option} . '</div>
                                                                            </div>';
                                                                }
                                                        }
                                                    else 
                                                        {
                                                            if($CorrectAnswer == $UserAnswer)
                                                                {
                                                                    if($CorrectAnswer == $Alphabet)
                                                                        {
                                                                            echo '<div class="card" style="margin:0 auto;width: 95%;border-radius: 10px;margin-top:20px;padding-left: 10px;background-color: #ccffcc; ">
                                                                            <div class="card-body"><span style="color: green;"><strong>' . $Alphabet . '&nbsp;&nbsp;&nbsp;Correct Answer :</strong></span>&nbsp;&nbsp;&nbsp;&nbsp;' . ${$Option} . '</div>
                                                                            </div>';
                                                                            $CorrectAnswerTotal++; 
                                                                        }
                                                                    else 
                                                                        {
                                                                            echo '<div class="card" style="margin:0 auto;width: 95%;border-radius: 10px;margin-top:20px;padding-left: 10px; ">
                                                                            <div class="card-body"><strong>' . $Alphabet . '</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . ${$Option} . '</div>
                                                                            </div>';
                                                                        } 
                                                                }
                                                            else 
                                                                {
                                                                    if($UserAnswer == $Alphabet)
                                                                        {
                                                                            echo '<div class="card" style="margin:0 auto;width: 95%;border-radius: 10px;margin-top:20px;padding-left: 10px;background-color: #ffcccc; ">
                                                                            <div class="card-body"><span style="color: red;"><strong>' . $Alphabet . ':&nbsp;&nbsp;&nbsp;Your Answer : </strong></span>&nbsp;&nbsp;&nbsp;&nbsp;' . ${$Option} . '</div>
                                                                            </div>';
                                                                            $IncorrectAnswerTotal++;
                                                                        }
                                                                    else 
                                                                        {
                                                                            if($CorrectAnswer == $Alphabet)
                                                                                {
                                                                                    echo '<div class="card" style="margin:0 auto;width: 95%;border-radius: 10px;margin-top:20px;padding-left: 10px;background-color: #ccffcc; ">
                                                                                    <div class="card-body"><span style="color: green;"><strong>' . $Alphabet . '&nbsp;&nbsp;&nbsp;Correct Answer :</strong></span>&nbsp;&nbsp;&nbsp;&nbsp;' . ${$Option} . '</div>
                                                                                    </div>';
                                                                                }
                                                                            else 
                                                                                {
                                                                                     echo '<div class="card" style="margin:0 auto;width: 95%;border-radius: 10px;margin-top:20px;padding-left: 10px; ">
                                                                                    <div class="card-body"><strong>' . $Alphabet . '</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . ${$Option} . '</div>
                                                                                    </div>';   
                                                                                }    
                                                                        }    
                                                                    
                                                                }
                                                        }    
                                                }
                                            echo '<div class="card-body">
                                                <p class="card-text">'.$QuestionExplanation.'</p>
                                                </div>';
                                            echo '<div class="row mb-4" style="margin:0 auto; width: 95%;">';
                                                echo '<div class="col-md-8 mb-4">';
                                                    echo '<div class="card" style="width: 100%;border-radius: 10px;box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2)margin-bottom: 40px;">
                                                        <div class="card-body" >
                                                            <h5 class="card-title">Graph History</h5>
                                                            <div style="background-color: #c7ccd5; height: 2px; margin-bottom: 20px;"></div>';                            
                                                                echo "<div class='card-body'>";
                                                                    echo "<div class='simple-bar-chart' style='width:90%; max-width: 400px;'>";
                                                                        $TotalAttempts = $QuestionMCQ->first()->mcq_g_1 + $QuestionMCQ->first()->mcq_g_2 + $QuestionMCQ->first()->mcq_g_3 + $QuestionMCQ->first()->mcq_g_4 + $QuestionMCQ->first()->mcq_g_5 + $QuestionMCQ->first()->mcq_g_6 + $QuestionMCQ->first()->mcq_g_7 + $QuestionMCQ->first()->mcq_g_8;
                                                                        for($x = 1; $x <= $MCQOptionCount; $x++)
                                                                            {
                                                                                $GraphCol = "mcq_g_" . $x;
                                                                                $GraphValue = $QuestionMCQ->first()->$GraphCol ?? 'No Option Found';
                                                                                $Option = 'Option' . $x;
                                                                                $Alphabet = chr(64 + $x);
                                                                                $GraphPer = round(($GraphValue / $TotalAttempts) * 100, 2);
                                                                                if($CorrectAnswer == $Alphabet)
                                                                                    {
                                                                                        echo "<div class='item' style='--clr: #ccffcc; --val: $GraphPer'>
                                                                                            <div class='label' style='font-size:12px;'>$Alphabet</div>
                                                                                            <div class='value'>$GraphPer %</div>
                                                                                        </div>";
                                                                                    }
                                                                                else 
                                                                                    {
                                                                                        if($UserAnswer == $Alphabet)
                                                                                            {
                                                                                                echo "<div class='item' style='--clr: #ffcccc; --val: $GraphPer'>
                                                                                                    <div class='label' style='font-size:12px;'>$Alphabet</div>
                                                                                                    <div class='value'>$GraphPer %</div>
                                                                                                </div>"; 
                                                                                            }
                                                                                        else 
                                                                                            {
                                                                                                echo "<div class='item' style='--clr: #efebeb; --val: $GraphPer'>
                                                                                                    <div class='label' style='font-size:12px;'>$Alphabet</div>
                                                                                                    <div class='value'>$GraphPer %</div>
                                                                                                </div>"; 
                                                                                            }
                                                                                    }
                                                                            }
                                                                    echo "</div>";
                                                                    echo '<div class="mt-1 text-center small">';
                                                                        for($y = 1; $y <= $MCQOptionCount; $y++)
                                                                            {
                                                                                $GraphCol = "mcq_g_" . $y;
                                                                                $GraphValue = $QuestionMCQ->first()->$GraphCol ?? 'No Option Found';
                                                                                $Option = 'Option' . $y;
                                                                                $Alphabet = chr(64 + $y);
                                                                                if($CorrectAnswer == $Alphabet)
                                                                                    {
                                                                                        echo '<span class="mr-2"><i class="fas fa-circle" style="color:#ccffcc;"></i> '.$Alphabet.' : '.$GraphValue.' Attempts</span>&nbsp;&nbsp;';
                                                                                    }
                                                                                else 
                                                                                    {
                                                                                        if($UserAnswer == $Alphabet)
                                                                                            {
                                                                                                echo '<span class="mr-2"><i class="fas fa-circle" style="color:#ffcccc;"></i> '.$Alphabet.' : '.$GraphValue.' Attempts</span>&nbsp;&nbsp;';
                                                                                            }
                                                                                        else 
                                                                                            {
                                                                                                echo '<span class="mr-2"><i class="fas fa-circle" style="color:#cccccc;"></i> '.$Alphabet.' : '.$GraphValue.' Attempts</span>&nbsp;&nbsp;';
                                                                                            }
                                                                                    }
                                                                            }
                                                                    echo '</div>';
                                                                echo "</div>";
                                                echo '</div></div></div>';
                                                echo '<div class="col-md-4">';
                                                    echo '<div class="card" style="width: 100%;border-radius: 10px;box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2)margin-bottom: 40px;">
                                                        <div class="card-body">
                                                            <h5 class="card-title">Conversation</h5>
                                                            <div style="background-color: #c7ccd5; height: 2px; margin-bottom: 20px;"></div>';
                                                                $Conversations = DB::table('conversation')->select('*')->where('co_q_id', $QuestionSr)->orderBy('co_id', 'desc')->limit(1)->get();
                                                                if($Conversations->isEmpty())
                                                                    {
                                                                        echo '<div class="alert alert-secondary" role="alert" style="border-radius: 10px; background-color: #fbfbfb; color: black; font-size: 16px; padding-left: 4%; padding-right: 4%; margin-bottom: 20px;">';
                                                                            echo 'No Conversation Found for this question.';
                                                                        echo '</div>';
                                                                    }
                                                                
                                                                foreach ($Conversations as $Conversation)
                                                                    {
                                                                        $MessageData = $Conversation->co_message ?? 'No Question Found';
                                                                        $UserCoID = $Conversation->co_u_id ?? 'No User Found';
                                                                        $CoUser = DB::table('users')->select('u_fname','u_lname')->where('id', $UserCoID)->get();
                                                                        $CoUserName = $CoUser->first()->u_fname . ' ' . $CoUser->first()->u_lname ?? 'No User Found';

                                                                        $created_at = $Conversation->created_at ?? 'No Date Found';
                                                                        $CreatedAt = Carbon::parse($created_at)->format('d M Y, h:i A');
                                                                        echo '<div class="alert alert-secondary" role="alert" style="border-radius: 10px; background-color: #fbfbfb; color: black; font-size: 16px; padding-left: 4%; padding-right: 4%; margin-bottom: 20px;">';
                                                                            echo '<h6 style="color: #858181;text-align:left;margin-top:10px;font-size:10px;"><strong>Date :</strong> ' . $CreatedAt . '<br></h6>';
                                                                            echo $MessageData;
                                                                            echo '<h6 style="color: #858181;font-style: italic;text-align:right;margin-top:10px;">--' . $CoUserName . '<br></h6>';
                                                                        echo '</div>';
                                                                    }
                                                                echo '<div style="text-align:center;"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter'.$QuestionSr.'">Start Conversation</button></div>';
                                                                // Modal
                                                                echo '<div class="modal fade" id="exampleModalCenter'.$QuestionSr.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">';
                                                                    echo '<div class="modal-dialog modal-dialog-centered" role="document">
                                                                        <div class="modal-content" >
                                                                            <div class="modal-header" > 
                                                                                <h5 class="modal-title" id="exampleModalLongTitle">Conversation</h5>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>';
                                                                            echo '<div class="modal-body">';
                                                                                $ConversationsModels = DB::table('conversation')->select('*')->where('co_q_id', $QuestionSr)->orderBy('co_id', 'asc')->get();
                                                                                foreach ($ConversationsModels as $ConversationsModel)
                                                                                    {
                                                                                        $MessageData = $ConversationsModel->co_message ?? 'No Question Found';
                                                                                        $UserCoID = $ConversationsModel->co_u_id ?? 'No User Found';
                                                                                        $CoUser = DB::table('users')->select('u_fname','u_lname')->where('id', $UserCoID)->get();
                                                                                        $CoUserName = $CoUser->first()->u_fname . ' ' . $CoUser->first()->u_lname ?? 'No User Found';

                                                                                        $created_at = $ConversationsModel->created_at ?? 'No Date Found';
                                                                                        $CreatedAt = Carbon::parse($created_at)->format('d M Y, h:i A');
                                                                                        echo '<div class="alert alert-secondary" role="alert" style="border-radius: 10px; background-color: #fbfbfb; color: black; font-size: 16px; padding-left: 4%; padding-right: 4%; margin-bottom: 20px;">';
                                                                                            echo '<h6 style="color: #858181;text-align:left;margin-top:10px;font-size:10px;"><strong>Date :</strong> ' . $CreatedAt . '<br></h6>';
                                                                                            echo $MessageData;
                                                                                            echo '<h6 style="color: #858181;font-style: italic;text-align:right;margin-top:10px;">--' . $CoUserName . '<br></h6>';
                                                                                        echo '</div>';
                                                                                    }
                                                                            echo '</div>';
                                                                            echo '<div class="modal-footer">
                                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                            </div>';
                                                                        echo '</div>';
                                                                    echo '</div>';
                                                                echo '</div>';
                                                                //end model
                                                echo '</div></div></div>';
                                            echo '</div>';
                                        echo '</div>';
                                        $QuestionNo++;
                                    }
                                if($QuestionQT == '2')
                                    {
                                        $QuestionEMQ = DB::table('questions_emq')->select('*')->where('emq_id', $QuestionID)->get();
                                        $QuestionTheme = $QuestionEMQ->first()->emq_theme ?? 'No Question Found';
                                        $QuestionReference = $QuestionEMQ->first()->emq_reference ?? 'No Question Found';
                                        $QuestionLeadIn = $QuestionEMQ->first()->emq_lead_in ?? 'No Question Found';
                                        echo '<div class="card mt-3" style="width: 100%;border-radius: 10px;box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
                                            <div class="card-body">
                                                <h5 class="card-title">EMQ No : ' . $EMQNo . '</h5>
                                                <p class="card-text"><strong>Theme :</strong>'.strip_tags($QuestionTheme).'</p>
                                                <p class="card-text"><strong>Reference :</strong>'.strip_tags($QuestionReference).'</p>
                                                <p class="card-text"><strong>Options :</strong>
                                                    <div class="container">';
                                                        $EMQOptionCount = $QuestionEMQ->first()->emq_op_count ?? 0;
                                                        echo "<div class='row mt-2'>";
                                                        for($a = 1; $a <= $EMQOptionCount; $a++)
                                                            {
                                                                $EMQOptionCol = "emq_op_".$a;
                                                                $Option = $QuestionEMQ->first()->$EMQOptionCol ?? 'No Option Found';
                                                                $Alphabet = chr(64 + $a);
                                                                    echo "<div class='col-md-4 mt-3'>";
                                                                        echo '<strong>' . $Alphabet . ')</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $Option . '';
                                                                    echo "</div>";
                                                            } 
                                                        echo '</div>';
                                                    echo '</div>
                                                </p>
                                                <p class="card-text mt-3"><strong>Lead In :</strong>'.strip_tags($QuestionLeadIn).'</p>
                                            </div>
                                        </div>';
                                        $EMQQuestionCount = $QuestionEMQ->first()->emq_q_count ?? 0;
                                        for($b = 1; $b <= $EMQQuestionCount; $b++)
                                            {
                                                $InnerQuestionID = $b;
                                                $EMQQuestionCol = "emq_q_".$b;
                                                $QuestionText = $QuestionEMQ->first()->$EMQQuestionCol ?? 'No Option Found';
                                                $EMQAnswerCol = "emq_a_".$b;
                                                $CorrectAnswer = $QuestionEMQ->first()->$EMQAnswerCol ?? 'No Option Found';
                                                $EMQDetailCol = "emq_d_".$b;
                                                $Detail = $QuestionEMQ->first()->$EMQDetailCol ?? 'No Detail Found';

                                                echo '<div id="questionpos'.$QuestionNo.'" class="card" style="width: 100%;border-radius: 10px;margin-top:20px;padding-left: 10px; ">';
                                                    echo '<div class="card-body">';
                                                        echo '<h5 class="card-title">Question No : ' . $QuestionNo . '</h5>';
                                                        echo '<p class="card-text">' . $QuestionText . '</p>';
                                                        $z = $b - 1;
                                                        $UserAnswer = explode('.', $Question[2]);
                                                        $UserAnswer = explode("'", $UserAnswer[$z]);
                                                        $UserAnswer = $UserAnswer[0];
                                                        $ColNumber1 = ord($CorrectAnswer) - 64;
                                                        $EMQOptionCol1 = "emq_op_".$ColNumber1;
                                                        $CorrectOption = $QuestionEMQ->first()->$EMQOptionCol1 ?? 'No Option Found';
                                                        $ColNumber2 = ord($UserAnswer) - 64;
                                                        $EMQOptionCol2 = "emq_op_".$ColNumber2;
                                                        $UserOption = $QuestionEMQ->first()->$EMQOptionCol2 ?? 'No Option Found';
                                                        if($Question[3] == 2)
                                                            {
                                                                echo '<div class="card" style="width: 100%;border-radius: 10px;margin-top:20px;padding-left: 10px;background-color: #ccffcc; ">
                                                                <div class="card-body"><span style="color: green;"><strong>Correct Answer ('.$CorrectAnswer.') : </strong></span>&nbsp;&nbsp;&nbsp;&nbsp;' . $CorrectOption . '</div>
                                                                </div>';
                                                                $SkipAnswerTotal++;
                                                            }
                                                        else
                                                            {
                                                                if($UserAnswer == $CorrectAnswer)
                                                                    {
                                                                        echo '<div class="card" style="width: 100%;border-radius: 10px;margin-top:20px;padding-left: 10px;background-color: #ccffcc; ">
                                                                        <div class="card-body"><span style="color: green;"><strong>Correct Answer ('.$UserAnswer.') : </strong></span>&nbsp;&nbsp;&nbsp;&nbsp;' . $CorrectOption . '</div>
                                                                        </div>';
                                                                        $CorrectAnswerTotal++;
                                                                    }
                                                                else
                                                                    {
                                                                        $IncorrectAnswerTotal++;
                                                                        if($UserAnswer == 0)
                                                                            {
                                                                                echo '<div class="card" style="width: 100%;border-radius: 10px;margin-top:20px;padding-left: 10px;background-color: #ffcccc; ">
                                                                                <div class="card-body"><span style="color: red;"><strong>Your Answer : </strong></span>&nbsp;&nbsp;&nbsp;&nbsp;No option selected.</div>
                                                                                </div>';
                                                                            }
                                                                        else 
                                                                            {
                                                                                echo '<div class="card" style="width: 100%;border-radius: 10px;margin-top:20px;padding-left: 10px;background-color: #ffcccc; ">
                                                                                <div class="card-body"><span style="color: red;"><strong>Your Answer ('.$UserAnswer.') : </strong></span>&nbsp;&nbsp;&nbsp;&nbsp;' . $UserOption . '</div>
                                                                                </div>';
                                                                            }
                                                                        echo '<div class="card" style="width: 100%;border-radius: 10px;margin-top:20px;padding-left: 10px;background-color: #ccffcc; ">
                                                                        <div class="card-body"><span style="color: green;"><strong>Correct Answer ('.$CorrectAnswer.') : </strong></span>&nbsp;&nbsp;&nbsp;&nbsp;' . $CorrectOption . '</div>
                                                                        </div>';
                                                                    }
                                                            }
                                                        echo '<div class="card mt-3" style="width: 100%;border-radius: 10px;box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">';
                                                        echo '<div class="card-body">
                                                            <p class="card-text">' . $Detail . '</p>
                                                        </div>
                                                    </div>';
                                                    echo '<div class="row mb-4 mt-4" style="margin:0 auto; width: 100%;">';
                                                        echo '<div class="col-md-8 mb-4">';
                                                            echo '<div class="card" style="width: 100%;border-radius: 10px;box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2)margin-bottom: 40px;">
                                                                <div class="card-body" >
                                                                    <h5 class="card-title">Graph History</h5>
                                                                    <div style="background-color: #c7ccd5; height: 2px; margin-bottom: 20px;"></div>';                            
                                                                        echo "<div class='card-body'>";
                                                                            echo "<div class='simple-bar-chart' style='width:90%; max-width: 500px;'>";
                                                                                $QuestionGraphEMQ = DB::table('questions_emq_graph')->select('*')->where(['emqg_emq_id' => $QuestionID,'emqg_inner_q_id' => $InnerQuestionID])->get();
                                                                                $TotalAttemptsEMQ = $QuestionGraphEMQ->first()->emqg_ans_1 + $QuestionGraphEMQ->first()->emqg_ans_2 + $QuestionGraphEMQ->first()->emqg_ans_3 + $QuestionGraphEMQ->first()->emqg_ans_4 + $QuestionGraphEMQ->first()->emqg_ans_5 + $QuestionGraphEMQ->first()->emqg_ans_6 + $QuestionGraphEMQ->first()->emqg_ans_7 + $QuestionGraphEMQ->first()->emqg_ans_8 + $QuestionGraphEMQ->first()->emqg_ans_9 + $QuestionGraphEMQ->first()->emqg_ans_10 + $QuestionGraphEMQ->first()->emqg_ans_11 + $QuestionGraphEMQ->first()->emqg_ans_12 + $QuestionGraphEMQ->first()->emqg_ans_13 + $QuestionGraphEMQ->first()->emqg_ans_14 + $QuestionGraphEMQ->first()->emqg_ans_15 + $QuestionGraphEMQ->first()->emqg_ans_16 + $QuestionGraphEMQ->first()->emqg_ans_17 + $QuestionGraphEMQ->first()->emqg_ans_18 + $QuestionGraphEMQ->first()->emqg_ans_19 + $QuestionGraphEMQ->first()->emqg_ans_20 + $QuestionGraphEMQ->first()->emqg_ans_21 + $QuestionGraphEMQ->first()->emqg_ans_22 + $QuestionGraphEMQ->first()->emqg_ans_23 + $QuestionGraphEMQ->first()->emqg_ans_24 + $QuestionGraphEMQ->first()->emqg_ans_25;
                                                                                for($n = 1; $n <= $EMQOptionCount; $n++)
                                                                                    {
                                                                                        $GraphCol = "emqg_ans_" . $n;
                                                                                        $GraphValue = $QuestionGraphEMQ->first()->$GraphCol ?? 'No Option Found';
                                                                                        $GraphPer = round(($GraphValue / $TotalAttemptsEMQ) * 100, 1);
                                                                                        $Alphabet = chr(64 + $n);
                                                                                        if($CorrectAnswer == $Alphabet)
                                                                                            {
                                                                                                echo "<div class='item' style='--clr: #ccffcc; --val: $GraphPer'>
                                                                                                    <div class='label' style='font-size:12px;'>$Alphabet</div>
                                                                                                    <div class='value' style='font-size:10px;'>$GraphPer %</div>
                                                                                                </div>";
                                                                                            }
                                                                                        else 
                                                                                            {
                                                                                                if($UserAnswer == $Alphabet)
                                                                                                    {
                                                                                                        echo "<div class='item' style='--clr: #ffcccc; --val: $GraphPer'>
                                                                                                            <div class='label' style='font-size:12px;'>$Alphabet</div>
                                                                                                            <div class='value' style='font-size:10px;'>$GraphPer %</div>
                                                                                                        </div>"; 
                                                                                                    }
                                                                                                else 
                                                                                                    {
                                                                                                        echo "<div class='item' style='--clr: #efebeb; --val: $GraphPer'>
                                                                                                            <div class='label' style='font-size:12px;'>$Alphabet</div>
                                                                                                            <div class='value' style='font-size:10px;'>$GraphPer %</div>
                                                                                                        </div>";
                                                                                                    }   
                                                                                            }    
                                                                                       
                                                                                    }
                                                                            echo "</div>";
                                                                            echo '<div class="mt-1 text-center small">';
                                                                                for($m = 1; $m <= $EMQOptionCount; $m++)
                                                                                    {
                                                                                        $GraphCol = "emqg_ans_" . $m;
                                                                                        $GraphValue = $QuestionGraphEMQ->first()->$GraphCol ?? 'No Option Found';
                                                                                        $Alphabet = chr(64 + $m);
                                                                                        if($CorrectAnswer == $Alphabet)
                                                                                            {
                                                                                                echo '<span class="mr-2"><i class="fas fa-circle" style="color:#ccffcc;"></i> <strong>'.$Alphabet.' :</strong> '.$GraphValue.'</span>&nbsp;&nbsp;';
                                                                                            }
                                                                                        else 
                                                                                            {
                                                                                                if($UserAnswer == $Alphabet)
                                                                                                    {
                                                                                                        echo '<span class="mr-2"><i class="fas fa-circle" style="color:#ffcccc;"></i> <strong>'.$Alphabet.' :</strong> : '.$GraphValue.'</span>&nbsp;&nbsp;';
                                                                                                    }
                                                                                                else 
                                                                                                    {
                                                                                                        echo '<span class="mr-2"><i class="fas fa-circle" style="color:#cccccc;"></i> <strong>'.$Alphabet.' :</strong> : '.$GraphValue.'</span>&nbsp;&nbsp;';
                                                                                                    }
                                                                                            }
                                                                                            if(($m == 8) || ($m == 16) || ($m == 24))
                                                                                            echo "<br><br>";

                                                                                    }
                                                                            echo '</div>';
                                                                        echo "</div>";
                                                        echo '</div></div></div>';
                                                echo '<div class="col-md-4">';
                                                    echo '<div class="card" style="width: 100%;border-radius: 10px;box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2)margin-bottom: 40px;">
                                                        <div class="card-body">
                                                            <h5 class="card-title">Conversation</h5>
                                                            <div style="background-color: #c7ccd5; height: 2px; margin-bottom: 20px;"></div>';
                                                                $Conversations = DB::table('conversation')->select('*')->where(['co_q_id' => $QuestionSr,'co_inner_q' => $InnerQuestionID])->orderBy('co_id', 'desc')->limit(1)->get();
                                                                if($Conversations->isEmpty())
                                                                    {
                                                                        echo '<div class="alert alert-secondary" role="alert" style="border-radius: 10px; background-color: #fbfbfb; color: black; font-size: 16px; padding-left: 4%; padding-right: 4%; margin-bottom: 20px;">';
                                                                            echo 'No Conversation Found for this question.';
                                                                        echo '</div>';
                                                                    }
                                                                foreach ($Conversations as $Conversation)
                                                                    {
                                                                        $MessageData = $Conversation->co_message ?? 'No Question Found';
                                                                        $UserCoID = $Conversation->co_u_id ?? 'No User Found';
                                                                        $CoUser = DB::table('users')->select('u_fname','u_lname')->where('id', $UserCoID)->get();
                                                                        $CoUserName = $CoUser->first()->u_fname . ' ' . $CoUser->first()->u_lname ?? 'No User Found';

                                                                        $created_at = $Conversation->created_at ?? 'No Date Found';
                                                                        $CreatedAt = Carbon::parse($created_at)->format('d M Y, h:i A');
                                                                        echo '<div class="alert alert-secondary" role="alert" style="border-radius: 10px; background-color: #fbfbfb; color: black; font-size: 16px; padding-left: 4%; padding-right: 4%; margin-bottom: 20px;">';
                                                                            echo '<h6 style="color: #858181;text-align:left;margin-top:10px;font-size:10px;"><strong>Date :</strong> ' . $CreatedAt . '<br></h6>';
                                                                            echo $MessageData;
                                                                            echo '<h6 style="color: #858181;font-style: italic;text-align:right;margin-top:10px;">--' . $CoUserName . '<br></h6>';
                                                                        echo '</div>';
                                                                    }
                                                                //Model
                                                                $ConversationlinkData = array($QuestionSr, $InnerQuestionID);
                                                                $ConversationLink = implode("a",$ConversationlinkData);
                                                                echo '<div style="text-align:center;"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter'. $ConversationLink .'">Start Conversation</button></div>';
                                                                // Modal
                                                                echo '<div class="modal fade" id="exampleModalCenter'. $ConversationLink .'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">';
                                                                    echo '<div class="modal-dialog modal-dialog-centered" role="document">
                                                                        <div class="modal-content" >
                                                                            <div class="modal-header" > 
                                                                                <h5 class="modal-title" id="exampleModalLongTitle">Conversation</h5>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>';
                                                                            echo '<div class="modal-body">';
                                                                                $DataConversation = explode('a', $ConversationLink);
                                                                                $QSrA = $DataConversation[0];
                                                                                $QSrB = $DataConversation[1];
                                                                                $ConversationsModelAs = DB::table('conversation')->select('*')->where(['co_q_id' => $QSrA,'co_inner_q' => $QSrB])->orderBy('co_id', 'asc')->get();
                                                                                foreach ($ConversationsModelAs as $ConversationsModelA)
                                                                                    {
                                                                                        $MessageData = $ConversationsModelA->co_message ?? 'No Question Found';
                                                                                        $UserCoID = $ConversationsModelA->co_u_id ?? 'No User Found';
                                                                                        $CoUser = DB::table('users')->select('u_fname','u_lname')->where('id', $UserCoID)->get();
                                                                                        $CoUserName = $CoUser->first()->u_fname . ' ' . $CoUser->first()->u_lname ?? 'No User Found';
                                                                                        $created_at = $ConversationsModelA->created_at ?? 'No Date Found';
                                                                                        $CreatedAt = Carbon::parse($created_at)->format('d M Y, h:i A');
                                                                                        echo '<div class="alert alert-secondary" role="alert" style="border-radius: 10px; background-color: #fbfbfb; color: black; font-size: 16px; padding-left: 4%; padding-right: 4%; margin-bottom: 20px;">';
                                                                                            echo '<h6 style="color: #858181;text-align:left;margin-top:10px;font-size:10px;"><strong>Date :</strong> ' . $CreatedAt . '<br></h6>';
                                                                                            echo $MessageData;
                                                                                            echo '<h6 style="color: #858181;font-style: italic;text-align:right;margin-top:10px;">--' . $CoUserName . '<br></h6>';
                                                                                        echo '</div>';
                                                                                    }
                                                                            echo '</div>';
                                                                            echo '<div class="modal-footer">
                                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                            </div>';
                                                                        echo '</div>';
                                                                    echo '</div>';
                                                                echo '</div>';
                                                                //End Model
                                                echo '</div></div></div>';
                                            echo '</div>';
                                                    echo '</div>';
                                                echo '</div>';
                                                $QuestionNo++;
                                            } 
                                            $EMQNo++;
                                    }
                                if($QuestionQT == '3')    
                                    {
                                        if($i == 0)
                                            {
                                                echo "<div class=' text-center h4 mt-5' role='alert'>Your Session successfully completed.</div>";
                                                echo "<div class='row mt-4 text-center'>";
                                                    echo "<div class='col-12'> <a href='../showexam/$e_id' class='btn btn-success' bis_skin_checked='1'>Back to Dashboard</a></div>";
                                                echo "</div>";
                                            }    
                                        $CorrectAnswerTotal++;
                                        $IncorrectAnswerTotal = 0;
                                        $SkipAnswerTotal = 0;
                                        
                                    }
                            }
                    @endphp
                @endforeach
            </div>    
            <div class="col-lg-3"  >
                <h3>Your Performance</h3>
                <div style="background-color: #6593ed; height: 4px; margin-bottom: 20px;"></div>
                <div style="position: sticky; top:0;">
                    <div class="card mt-3" style="width: 100%;border-radius: 10px;box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
                        <div class="card-body" >
                            <h5 class="card-title">Overall Progress</h5>
                            <div style="background-color: #c7ccd5; height: 2px; margin-bottom: 20px;"></div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="card-body">
                                        <div class="chart-pie">
                                            <canvas id="myPieChart" width="100%" height="250"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                            <div class="mt-1 text-center small">
                                <span class="mr-2"><i class="fas fa-circle" style="color:#ccffcc;"></i> Correct</span>
                                <span class="mr-2"><i class="fas fa-circle" style="color:#ffcccc;"></i> Incorrect</span>
                                <span class="mr-2"><i class="fas fa-circle" style="color:#cccccc;"></i> Skip</span>
                            </div>
                        </div>
                    </div>
                    <div class="card mt-3" style="width: 100%;border-radius: 10px;box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
                        <div class="card-body" >
                            <h5 class="card-title">Questions Navigational</h5>
                            <div style="background-color: #c7ccd5; height: 2px; margin-bottom: 20px;"></div>
                            @foreach ($Tests as $object)
                                @php
                                    $QNs = explode(',', $object->t_questions);
                                    $QNsCount = count($QNs);
                                    for($q = 0; $q < $QNsCount; $q++)
                                        {
                                            $QN = explode(':', $QNs[$q]);
                                            $QNType = $QN[1];
                                            if($QNType == '1')
                                                {
                                                    if($QN[3] == 2)
                                                        {
                                                            echo '<a class="btn btn-secondary btn-sm m-1" style="border-radius: 50%; width: 40px; height: 40px;padding-top:8px;" href="#questionpos'.$QNNumber.'">'.$QNNumber.'</a>';
                                                        }
                                                    else {
                                                            $QNAns = explode("'", $QN[2]);
                                                            if($QNAns[1] == '1')
                                                                {
                                                                    echo '<a class="btn btn-success btn-sm m-1" style="border-radius: 50%; width: 40px; height: 40px;padding-top:8px;" href="#questionpos'.$QNNumber.'">'.$QNNumber.'</a>';
                                                                }
                                                            else if($QNAns[1] == '0')
                                                                {
                                                                    echo '<a class="btn btn-danger btn-sm m-1" style="border-radius: 50%; width: 40px; height: 40px;padding-top:8px;" href="#questionpos'.$QNNumber.'">'.$QNNumber.'</a>';
                                                                }
                                                    }    
                                                    
                                                    $QNNumber++;    
                                                }
                                            if($QNType == '2')
                                                {
                                                    $QNDB = DB::table('questions')->select('q_question_id')->where('q_id', $QN[0])->get();
                                                    $QNID = $QNDB->first()->q_question_id ?? 'No Question Found';
                                                    $QNEMQ = DB::table('questions_emq')->select('emq_q_count')->where('emq_id', $QNID)->get();
                                                    $EMQQNCount = $QNEMQ->first()->emq_q_count ?? 0;
                                                    for($r = 1; $r <= $EMQQNCount; $r++)
                                                        {
                                                            $QNEMQ1Ans = explode(".", $QN[2]);
                                                            $QNEMQ2Ans = explode("'", $QNEMQ1Ans[$r-1]);
                                                            if($QN[3] == 2)
                                                                {
                                                                    echo '<a class="btn btn-secondary btn-sm m-1" style="border-radius: 50%; width: 40px; height: 40px;padding-top:8px;" href="#questionpos'.$QNNumber.'">'.$QNNumber.'</a>';
                                                                }
                                                            else 
                                                                {
                                                                    if($QNEMQ2Ans[1] == '1')
                                                                        {
                                                                            echo '<a class="btn btn-success btn-sm m-1" style="border-radius: 50%; width: 40px; height: 40px;padding-top:8px;" href="#questionpos'.$QNNumber.'">'.$QNNumber.'</a>';
                                                                        }
                                                                    else if($QNEMQ2Ans[1] == '0')
                                                                        {
                                                                            echo '<a class="btn btn-danger btn-sm m-1" style="border-radius: 50%; width: 40px; height: 40px;padding-top:8px;" href="#questionpos'.$QNNumber.'">'.$QNNumber.'</a>';
                                                                        }
                                                                }
                                                            $QNNumber++;    
                                                        }
                                                }    
                                        }    
                                @endphp    
                            

                            @endforeach
                            <div class="mt-4 text-center small">
                                <span class="mr-2"><i class="fas fa-circle text-success"></i> Correct ({!! $CorrectAnswerTotal !!})</span>
                                <span class="mr-2"><i class="fas fa-circle text-danger"></i> Incorrect ({!! $IncorrectAnswerTotal !!})</span>
                                <span class="mr-2"><i class="fas fa-circle text-secondary"></i> Skip ({!! $SkipAnswerTotal !!})</span>
                            </div>
                            
                        </div>
                    </div>
                </div>
                {{-- <div>(Attempted 0 of 10)</div>
                <div style="background-color: #c7ccd5; height: 2px; margin-bottom: 20px;"></div> --}}
               
            </div>
        </div>
        @if($QuestionQT != 3)
        <div class="row mt-4">
            <div class="col-12"  > <a href="../showexam/{{$e_id}}" class="btn btn-success" bis_skin_checked="1">Back to Dashboard</a></div>
        </div>
        @endif
    </div>
</section>
<div style="text-align: right;margin-top: 10px; padding: 20px; ">
Copyright © 2015 - 2026 MedExHub.com<br>
From triage to disposition, iSim.ai  offers cutting-edge emergency simulation—give it a try!
</div>
@include('frontend.index_footer')
@php
$GrangTotal = $CorrectAnswerTotal + $IncorrectAnswerTotal + $SkipAnswerTotal;
$Correct = round(($CorrectAnswerTotal / $GrangTotal) * 100, 2);
$Incorrect = round(($IncorrectAnswerTotal / $GrangTotal) * 100, 2);
$Skip = round(($SkipAnswerTotal / $GrangTotal) * 100, 2);    
@endphp
<script>
    // Set new default font family and font color to mimic Bootstrap's default styling
(Chart.defaults.global.defaultFontFamily = "Metropolis"),
'-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = "#858796";
// Pie Chart Example
var correct = "<?php echo $Correct; ?>";
var incorrect = "<?php echo $Incorrect; ?>";
var skip = "<?php echo $Skip; ?>";
var ctx = document.getElementById("myPieChart");
var myPieChart = new Chart(ctx, {
    type: "doughnut",
    data: {
        labels: ["Skip", "Incorrect", "Correct"],
        datasets: [{
            data: [skip, incorrect, correct],
            backgroundColor: [
                "rgba(188,188,188, 1)",
                "rgba(255,204,204, 1)",
                "rgba(204,255,204, 1)"
            ],
            hoverBackgroundColor: [
                "rgba(188,188,188, 0.9)",
                "rgba(255,204,204, 0.9)",
                "rgba(204,255,204, 0.9)"
            ],
            hoverBorderColor: [
                "rgba(91,91,91, 0.9)",
                "rgba(235,97,87, 0.9)",
                "rgba(147,196,125, 1)"
            ]
       
        }]
        
    },
    options: {
        maintainAspectRatio: false,
        tooltips: {
            backgroundColor: "rgb(255,255,255)",
            bodyFontColor: "#858796",
            borderColor: "#dddfeb",
            borderWidth: 1,
            xPadding: 15,
            yPadding: 15,
            displayColors: false,
            caretPadding: 10
        },
        legend: {
            display: false
        },
        cutoutPercentage: 0
    }
});
</script>