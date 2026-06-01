
@php
use Carbon\Carbon;
@endphp
@include('frontend.index_header')
@php
    $Category = DB::table('exams')->select('e_name','e_info')->where('e_id', $e_id)->get();
    $CategoryName = $Category->first()->e_name ?? 'No Category Found'; 
@endphp

<section class="section_padding" style="bbackground: #FFFFFF; background: linear-gradient(0deg, rgba(255, 255, 255, 1) 0%, rgba(217, 235, 255, 1) 100%);">
    <div class="container">
        <div class="row">
            <div class="col-lg-9" >
                <h3>{{$CategoryName}}</h3>
                <div style="background-color: #6593ed; height: 4px; margin-bottom: 20px;"></div>
                @foreach ($Tests as $item)
                    @php
                        $QuestionNo = $item->t_answered ?? 0;
                        $TestLenth = $item->t_lenth ?? 0;
                        $Questions = explode(',', $item->t_questions);
                        $QuestionCount = count($Questions);
                        $NextQuestion = 0;
                        $SrNo = 1;
                        for($i = 0; $i < $QuestionCount; $i++)
                            {
                                $Question = explode(':', $Questions[$i]);
                                if($NextQuestion == 0)
                                    {
                                        switch ($Question[3])
                                            {
                                                case '2':
                                                    $DispalyType = '2';
                                                    $NextQuestion = $Question[0];
                                                    $AnswerSheet = $Question[2];
                                                break;
                                                case '0':
                                                    $DispalyType = '1';
                                                    $NextQuestion = $Question[0];
                                                    $AnswerSheet = $Question[2];
                                                break;
                                                case '1':
                                                $SrNo = $SrNo + 1;
                                                break;
                                                
                                            }
                                    }
                            }
                    @endphp
                @endforeach
                @php
                    $QuestionsDB = DB::table('questions')->select('q_question_id','q_qt_id')->where('q_id', $NextQuestion)->get();
                    $QuestionID = $QuestionsDB->first()->q_question_id ?? 'No Question Found';
                    $QuestionQT = $QuestionsDB->first()->q_qt_id ?? 'No Question Found';
                @endphp    
                @if($DispalyType == 1)
                    {{-- Displaying MCQ Question --}}
                    <form  action="{{ route('submitrmcq', ['testid' => $testid]) }}" method="post">
                    @csrf
                    @if ($QuestionQT == '1')
                        @php
                            $QuestionMCQ = DB::table('questions_mcq')->select('*')->where('mcq_id', $QuestionID)->get();
                            $QuestionText = $QuestionMCQ->first()->mcq_question ?? 'No Question Found';
                            $Option1 = $QuestionMCQ->first()->mcq_op_1 ?? 'No Option Found';
                            $Option2 = $QuestionMCQ->first()->mcq_op_2 ?? 'No Option Found';
                            $Option3 = $QuestionMCQ->first()->mcq_op_3 ?? 'No Option Found';
                            $Option4 = $QuestionMCQ->first()->mcq_op_4 ?? 'No Option Found';
                            $Option5 = $QuestionMCQ->first()->mcq_op_5 ?? 'No Option Found';
                            $Option6 = $QuestionMCQ->first()->mcq_op_6 ?? 'No Option Found';
                            $Option7 = $QuestionMCQ->first()->mcq_op_7 ?? 'No Option Found';
                            $Option8 = $QuestionMCQ->first()->mcq_op_8 ?? 'No Option Found';
                            $QuestionNo++;
                        @endphp
                        <div class="card" style="width: 100%;border-radius: 10px;box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
                            <div class="card-body">
                                <h5 class="card-title">Question No : {{$QuestionNo}}</h5>
                                <p class="card-text">{!! $QuestionText !!}</p>
                            </div>
                        </div>
                        @php
                            $MCQOptionCount = $QuestionMCQ->first()->mcq_op_count ?? 0;
                            for($i = 1; $i <= $MCQOptionCount; $i++)
                                {
                                    $Option = 'Option' . $i;
                                    $Alphabet = chr(64 + $i);
                                    echo '<div class="card" style="width: 100%;border-radius: 10px;margin-top:20px;padding-left: 10px; ">
                                            <div class="card-body"><strong>' . $Alphabet . '</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="option" value="' . $i . '" class="form-check-input">
                                                ' . ${$Option} . '
                                            </div>
                                        </div>';
                                }
                        @endphp
                        <div class="container">
                            <div class="row" style="margin-top:30px;">
                                <div class="col-md-8">
                                    <input type="hidden" name="Question_ID" value="{{ $QuestionID }}">
                                    <input type="hidden" name="NextQuestion" value="{{ $NextQuestion }}">
                                    <input type="hidden" name="Question_QT" value="{{ $QuestionQT }}">
                                    <input type="hidden" name="Question_No" value="{{ $QuestionNo }}">
                                    <input type="submit" class="btn btn-success" value="Submit">
                                </div>
                                <div class="col-md-4" style="text-align: right;">
                                    <a href="/finishexam/{{$testid}}" class=" btn btn-warning">Finish</a>
                                </div>  
                            </div>
                        </div>
                    @endif
                    </form>
                    {{-- Displaying EMQ Question --}}
                    <form  action="{{ route('submitremq', ['testid' => $testid]) }}" method="post">
                    @csrf    
                    @if ($QuestionQT == '2')
                        @php
                            $QuestionEMQ = DB::table('questions_emq')->select('*')->where('emq_id', $QuestionID)->get();
                            $QuestionTheme = $QuestionEMQ->first()->emq_theme ?? 'No Question Found';
                            $QuestionReference = $QuestionEMQ->first()->emq_reference ?? 'No Question Found';
                            $QuestionLeadIn = $QuestionEMQ->first()->emq_lead_in ?? 'No Question Found';
                        @endphp     
                        <div class="card" style="width: 100%;border-radius: 10px;box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
                            <div class="card-body">
                                {{-- <h5 class="card-title">Question No : {{$SrNo}}</h5> --}}
                                <p class="card-text"><strong>Theme :</strong> {!! $QuestionTheme !!}Question</p>
                                <p class="card-text"><strong>Reference :</strong> {!! $QuestionReference !!}</p>
                                <p class="card-text"><strong>Options :</strong>
                                    <div class="container">
                                        @php
                                        $EMQOptionCount = $QuestionEMQ->first()->emq_op_count ?? 0;
                                        echo "<div class='row mt-2'>";
                                        for($i = 1; $i <= $EMQOptionCount; $i++)
                                            {
                                                $EMQOptionCol = "emq_op_".$i;
                                                $Option = $QuestionEMQ->first()->$EMQOptionCol ?? 'No Option Found';
                                                $Alphabet = chr(64 + $i);
                                                    echo "<div class='col-md-4 mt-3'>";
                                                        echo '<strong>' . $Alphabet . ')</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $Option . '';
                                                    echo "</div>";
                                            } 
                                            echo '</div>';                           
                                        @endphp
                                    </div>
                                </p>
                                <p class="card-text mt-3"><strong>Lead In :</strong> {!! $QuestionLeadIn !!}</p>
                            </div>
                        </div>
                                @php
                                $EMQQuestionCount = $QuestionEMQ->first()->emq_q_count ?? 0;
                                for($i = 1; $i <= $EMQQuestionCount; $i++)
                                    {
                                        $QuestionNo++;
                                        $EMQQuestionCol = "emq_q_".$i;
                                        $Question = $QuestionEMQ->first()->$EMQQuestionCol ?? 'No Option Found';
                                        echo '<div class="card" style="width: 100%;border-radius: 10px;margin-top:20px;padding-left: 10px; ">';
                                            echo '<div class="card-body">';
                                                echo '<h5 class="card-title">Question No : ' . $QuestionNo . '</h5>';
                                                echo '<p class="card-text">' . strip_tags($Question) . '</p>';
                                                echo '<div class="container">';
                                                    echo '<div class="row mt-2">';
                                                        echo '<div class="col-md-2 mt-2" style="max-width: 100px;padding-top: 6px;">';
                                                            echo '<strong>Option : </strong>';
                                                        echo '</div>';
                                                        echo '<div class="col-md-10 mt-2">';
                                                            echo '<select class="form-control" name="option[]" aria-label="Default select example">';
                                                                echo '<option selected value= "0">Select</option>';
                                                                    $EMQOptionCount2 = $QuestionEMQ->first()->emq_op_count ?? 0;
                                                                    for($a = 1; $a <= $EMQOptionCount2; $a++)
                                                                        {
                                                                            $EMQOptionCol2 = "emq_op_".$a;
                                                                            $Option = $QuestionEMQ->first()->$EMQOptionCol2 ?? 'No Option Found';
                                                                            $Alphabet = chr(64 + $a);
                                                                            echo '<option value="'. $i .':' . $a . '"><strong>' . $Alphabet . ')</strong>&nbsp;&nbsp;&nbsp;' . $Option . '</option>';
                                                                        }
                                                            echo '</select>';
                                                        echo '</div>';
                                                    echo '</div>';
                                                echo '</div>';
                                            echo '</div>';
                                        echo '</div>';
                                    } 
                                @endphp
                        <div class="container">
                            <div class="row" style="margin-top:30px;">
                                <div class="col-md-8">
                                    <input type="hidden" name="Question_ID" value="{{ $QuestionID }}">
                                    <input type="hidden" name="NextQuestion" value="{{ $NextQuestion }}">
                                    <input type="hidden" name="Question_QT" value="{{ $QuestionQT }}">
                                    <input type="hidden" name="Question_No" value="{{ $QuestionNo }}">
                                    <input type="submit" class="btn btn-success" value="Submit">
                                </div>
                                <div class="col-md-4" style="text-align: right;">
                                    <a href="/finishexam/{{$testid}}" class=" btn btn-warning">Finish</a>
                                </div>  
                            </div>
                        </div>                        
                    @endif
                    </form>
                    {{-- Displaying FlashCard Question --}}
                    <form  action="#" method="post">
                    @csrf
                    @if ($QuestionQT == '3')
                        @php
                            $QuestionFC = DB::table('questions_fc')->select('*')->where('fc_id', $QuestionID)->get();
                            $QuestionText = $QuestionFC->first()->fc_question ?? 'No Question Found';
                            $QuestionNo++;
                        @endphp
                        <div class="card" style="width: 100%;border-radius: 10px;box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
                            <div class="card-body">
                                <h5 class="card-title">Fact No : {{$QuestionNo}}</h5>
                                <p class="card-text">{{ strip_tags($QuestionText) }}</p>
                            </div>
                        </div>
                        <div class="container">
                            <div class="row" style="margin-top:30px;">
                                <div class="col-md-8">
                                    <input type="hidden" name="Question_ID" value="{{ $QuestionID }}">
                                    <input type="hidden" name="NextQuestion" value="{{ $NextQuestion }}">
                                    <input type="hidden" name="Question_QT" value="{{ $QuestionQT }}">
                                    <input type="hidden" name="Question_No" value="{{ $QuestionNo }}">
                                    {{-- <input type="submit" class="btn btn-success" value="Submit"> --}}
                                    @php
                                        $linkData1 = array($testid,$NextQuestion,$QuestionNo);
                                        $string = implode(",", $linkData1);
                                    @endphp
                                    {{-- <a href="/submitrfc/{{$string}}" class=" btn btn-success"><i class="fas fa-arrow-left"></i></a> --}}
                                    <a href="/submitrfc/{{$string}}" class=" btn btn-success"><i class="fas fa-arrow-right"></i> Fact</a>
                                </div>
                                <div class="col-md-4" style="text-align: right;">
                                    <a href="/finishexam/{{$testid}}" class=" btn btn-warning">Finish</a>
                                </div>  
                            </div>
                        </div>
                    @endif
                    </form>  
                @endif
                @if($DispalyType == 2)
                    {{-- Displaying MCQ Question Answered --}}
                    <form  action="{{ route('submitramcq', ['testid' => $testid]) }}" method="post">
                    @csrf
                    @if ($QuestionQT == '1')
                        @php
                            $QuestionMCQ = DB::table('questions_mcq')->select('*')->where('mcq_id', $QuestionID)->get();
                            $QuestionText = $QuestionMCQ->first()->mcq_question ?? 'No Question Found';
                            $QuestionExplanation = $QuestionMCQ->first()->mcq_d ?? 'No Question Found';
                            $CorrectAnswer = $QuestionMCQ->first()->mcq_a ?? 'No Option Found';
                            $Option1 = $QuestionMCQ->first()->mcq_op_1 ?? 'No Option Found';
                            $Option2 = $QuestionMCQ->first()->mcq_op_2 ?? 'No Option Found';
                            $Option3 = $QuestionMCQ->first()->mcq_op_3 ?? 'No Option Found';
                            $Option4 = $QuestionMCQ->first()->mcq_op_4 ?? 'No Option Found';
                            $Option5 = $QuestionMCQ->first()->mcq_op_5 ?? 'No Option Found';
                            $Option6 = $QuestionMCQ->first()->mcq_op_6 ?? 'No Option Found';
                            $Option7 = $QuestionMCQ->first()->mcq_op_7 ?? 'No Option Found';
                            $Option8 = $QuestionMCQ->first()->mcq_op_8 ?? 'No Option Found';
                        @endphp
                        <div class="card" style="width: 100%;border-radius: 10px;box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
                            <div class="card-body">
                                <h5 class="card-title">Question No : {{$QuestionNo}}</h5>
                                <p class="card-text">{!! $QuestionText !!}</p>
                            </div>
                        </div>
                        @php
                            $MCQOptionCount = $QuestionMCQ->first()->mcq_op_count ?? 0;
                            for($i = 1; $i <= $MCQOptionCount; $i++)
                                {
                                    $UserAnswer = explode('.', $AnswerSheet);
                                    $UserAnswer = explode("'", $UserAnswer[0]);
                                    $UserAnswer = $UserAnswer[0];
                                    $Option = 'Option' . $i;
                                    $Alphabet = chr(64 + $i);
                                    if($CorrectAnswer == $Alphabet)
                                        {
                                            echo '<div class="card" style="width: 100%;border-radius: 10px;margin-top:20px;padding-left: 10px;background-color: #ccffcc; ">
                                                    <div class="card-body"><span style="color: green;"><strong>' . $Alphabet . '&nbsp;&nbsp;&nbsp;Correct Answer :</strong></span>&nbsp;&nbsp;&nbsp;&nbsp;' . ${$Option} . '</div>
                                                    </div>';
                                        }
                                    else 
                                        {
                                            if($UserAnswer == $Alphabet)
                                                {
                                                    echo '<div class="card" style="width: 100%;border-radius: 10px;margin-top:20px;padding-left: 10px;background-color: #ffcccc; ">
                                                    <div class="card-body"><span style="color: red;"><strong>' . $Alphabet . ':&nbsp;&nbsp;&nbsp;Your Answer : </strong></span>&nbsp;&nbsp;&nbsp;&nbsp;' . ${$Option} . '</div>
                                                    </div>';
                                                }
                                            else
                                                {
                                                    echo '<div class="card" style="width: 100%;border-radius: 10px;margin-top:20px;padding-left: 10px; ">
                                                    <div class="card-body"><strong>' . $Alphabet . '</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . ${$Option} . '</div>
                                                    </div>';
                                                }
                                        }
                                }
                        @endphp
                        <div class="card mt-3" style="width: 100%;border-radius: 10px;box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
                            <div class="card-body">
                                <p class="card-text">{!! $QuestionExplanation !!}</p>
                            </div>
                        </div>
                        <div class="container">
                            <div class="row" style="margin-top:30px;">
                                <div class="col-md-8">
                                    <input type="hidden" name="Question_ID" value="{{ $QuestionID }}">
                                    <input type="hidden" name="NextQuestion" value="{{ $NextQuestion }}">
                                    <input type="hidden" name="Question_QT" value="{{ $QuestionQT }}">
                                    <input type="hidden" name="Question_No" value="{{ $QuestionNo }}">
                                    @if($TestLenth != $QuestionNo)
                                        <input type="submit" class="btn btn-success" value="Next Question">
                                    @else    
                                        <input type="submit" class="btn btn-warning" value="View Overall Result">
                                    @endif   
                                </div>
                                <div class="col-md-4" style="text-align: right;">
                                    <a href="/finishexam/{{$testid}}" class=" btn btn-warning">Finish</a>
                                </div>
                            </div>
                        </div>
                    @endif
                    </form>
                    {{-- Displaying EMQ Question Answered--}}
                    <form  action="{{ route('submitraemq', ['testid' => $testid]) }}" method="post">
                    @csrf 
                    @if ($QuestionQT == '2')
                        @php
                            $QuestionEMQ = DB::table('questions_emq')->select('*')->where('emq_id', $QuestionID)->get();
                            $QuestionTheme = $QuestionEMQ->first()->emq_theme ?? 'No Question Found';
                            $QuestionReference = $QuestionEMQ->first()->emq_reference ?? 'No Question Found';
                            $QuestionLeadIn = $QuestionEMQ->first()->emq_lead_in ?? 'No Question Found';
                        @endphp   
                        <div class="card" style="width: 100%;border-radius: 10px;box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
                            <div class="card-body">
                                {{-- <h5 class="card-title">Question No : {{$SrNo}}</h5> --}}
                                <p class="card-text"><strong>Theme :</strong> {!! $QuestionTheme !!}Answer</p>
                                <p class="card-text"><strong>Reference :</strong> {!! $QuestionReference !!}</p>
                                <p class="card-text"><strong>Options :</strong>
                                    <div class="container">
                                        @php
                                        $EMQOptionCount = $QuestionEMQ->first()->emq_op_count ?? 0;
                                        echo "<div class='row mt-2'>";
                                        for($i = 1; $i <= $EMQOptionCount; $i++)
                                            {
                                                $EMQOptionCol = "emq_op_".$i;
                                                $Option = $QuestionEMQ->first()->$EMQOptionCol ?? 'No Option Found';
                                                $Alphabet = chr(64 + $i);
                                                    echo "<div class='col-md-4 mt-3'>";
                                                        echo '<strong>' . $Alphabet . ')</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $Option . '';
                                                    echo "</div>";
                                            } 
                                            echo '</div>';                           
                                        @endphp
                                    </div>
                                </p>
                                <p class="card-text mt-3"><strong>Lead In :</strong> {!! $QuestionLeadIn !!}</p>
                            </div>
                        </div>
                                @php
                                $EMQQuestionCount = $QuestionEMQ->first()->emq_q_count ?? 0;
                                $QuestionNo = $QuestionNo - $EMQQuestionCount;
                                for($i = 1; $i <= $EMQQuestionCount; $i++)
                                    {
                                        $QuestionNo++;
                                        $EMQQuestionCol = "emq_q_".$i;
                                        $Question = $QuestionEMQ->first()->$EMQQuestionCol ?? 'No Option Found';
                                        $EMQAnswerCol = "emq_a_".$i;
                                        $CorrectAnswer = $QuestionEMQ->first()->$EMQAnswerCol ?? 'No Option Found';
                                        $EMQDetailCol = "emq_d_".$i;
                                        $Detail = $QuestionEMQ->first()->$EMQDetailCol ?? 'No Detail Found';

                                        echo '<div class="card" style="width: 100%;border-radius: 10px;margin-top:20px;padding-left: 10px; ">';
                                            echo '<div class="card-body">';
                                                echo '<h5 class="card-title">Question No : ' . $QuestionNo . '</h5>';
                                                echo '<p class="card-text">' . $Question . '</p>';
                                                $z = $i - 1;
                                                $UserAnswer = explode('.', $AnswerSheet);
                                                $UserAnswer = explode("'", $UserAnswer[$z]);
                                                $UserAnswer = $UserAnswer[0];
                                                if($UserAnswer == $CorrectAnswer)
                                                    {
                                                        $ColNumber = ord($CorrectAnswer) - 64;
                                                        $EMQOptionCol2 = "emq_op_".$ColNumber;
                                                        $Option = $QuestionEMQ->first()->$EMQOptionCol2 ?? 'No Option Found';
                                                        echo '<div class="card" style="width: 100%;border-radius: 10px;margin-top:20px;padding-left: 10px;background-color: #ccffcc; ">
                                                        <div class="card-body"><span style="color: green;"><strong>Correct Answer : </strong></span>&nbsp;&nbsp;&nbsp;&nbsp;' . $Option . '</div>
                                                        </div>';
                                                    }
                                                else
                                                    {
                                                        echo '<div class="card" style="width: 100%;border-radius: 10px;margin-top:20px;padding-left: 10px;background-color: #ffcccc; ">
                                                        <div class="card-body"><span style="color: red;"><strong>Your Answer : </strong></span>&nbsp;&nbsp;&nbsp;&nbsp;' . $Option . '</div>
                                                        </div>';
                                                        echo '<div class="card" style="width: 100%;border-radius: 10px;margin-top:20px;padding-left: 10px;background-color: #ccffcc; ">
                                                        <div class="card-body"><span style="color: green;"><strong>Correct Answer : </strong></span>&nbsp;&nbsp;&nbsp;&nbsp;' . $Option . '</div>
                                                        </div>';
                                                    }
                                                echo '<div class="card mt-3" style="width: 100%;border-radius: 10px;box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">';
                                                echo '<div class="card-body">
                                                    <p class="card-text">' . $Detail . '</p>
                                                </div>
                                            </div>';
                                            echo '</div>';
                                        echo '</div>';
                                    } 
                                @endphp
                        <div class="container">
                            <div class="row" style="margin-top:30px;">
                                <div class="col-md-8">
                                    <input type="hidden" name="Question_ID" value="{{ $QuestionID }}">
                                    <input type="hidden" name="NextQuestion" value="{{ $NextQuestion }}">
                                    <input type="hidden" name="Question_QT" value="{{ $QuestionQT }}">
                                    <input type="hidden" name="Question_No" value="{{ $QuestionNo }}">
                                    @if($TestLenth != $QuestionNo)
                                        <input type="submit" class="btn btn-success" value="Next Question">
                                    @else    
                                        <input type="submit" class="btn btn-warning" value="View Overall Result">
                                    @endif    
                                </div>
                                <div class="col-md-4" style="text-align: right;">
                                    <a href="/finishexam/{{$testid}}" class=" btn btn-warning">Finish</a>
                                </div>
                            </div>
                        </div>
                    @endif
                    </form>
                    {{-- Displaying FlashCard Question Answered --}}
                    <form  action="#" method="post">
                    @csrf
                    @if ($QuestionQT == '3')
                        @php
                            $QuestionFC = DB::table('questions_fc')->select('*')->where('fc_id', $QuestionID)->get();
                            $CorrectAnswer = $QuestionFC->first()->fc_answer ?? 'No Option Found';
                            $QuestionExplanation = $QuestionFC->first()->fc_description ?? 'No Question Found';
                        @endphp
                        <div class="card" style="width: 100%;border-radius: 10px;box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
                            <div class="card-body">
                                <h5 class="card-title">Fact No : {{$QuestionNo}}</h5>
                                <p class="card-text">{!! $CorrectAnswer !!}</p>
                            </div>
                        </div>
                        <div class="card mt-3" style="width: 100%;border-radius: 10px;box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
                            <div class="card-body">
                                <p class="card-text">{!! $QuestionExplanation !!}</p>
                            </div>
                        </div>
                        <div class="container">
                            <div class="row" style="margin-top:30px;">
                                <div class="col-md-8">
                                    <input type="hidden" name="Question_ID" value="{{ $QuestionID }}">
                                    <input type="hidden" name="NextQuestion" value="{{ $NextQuestion }}">
                                    <input type="hidden" name="Question_QT" value="{{ $QuestionQT }}">
                                    <input type="hidden" name="Question_No" value="{{ $QuestionNo }}">
                                    {{-- <input type="submit" class="btn btn-success" value="Next Question"> --}}
                                    @php
                                        $linkData1 = array($testid,$NextQuestion,$QuestionNo);
                                        $string = implode(",", $linkData1);
                                    @endphp
                                    {{-- <a href="/submitrafc/{{$string}}" class=" btn btn-success"><i class="fas fa-arrow-left"></i></a> --}}
                                    <a href="/submitrafc/{{$string}}" class=" btn btn-success"><i class="fas fa-arrow-right"></i> Next Fact</a>
                                </div>
                                
                                <div class="col-md-4" style="text-align: right;">
                                    <a href="/finishexam/{{$testid}}" class=" btn btn-warning">Finish</a>
                                </div>  
                            </div>
                        </div>
                    @endif
                    </form>
                @endif
            </div>    
            <div class="col-lg-3"  >
                <h3>Your Performance</h3>
                <div style="background-color: #6593ed; height: 4px; margin-bottom: 20px;"></div>
                Your Session Progress
                @php
                    $AddMinutes = $QuestionCount;
                    $endTime = now()->modify('+'.$AddMinutes.' minutes')->toIso8601String();
                @endphp
                <div>Time Left</div>
                <div style="background-color: #c7ccd5; height: 2px; margin-bottom: 20px;"></div>
                <div style="text-align: center;">
                    <p style="font-size: 30px;font-weight: bold;" id="countdown-timer"></p>
                </div>
                <div>(Attempted 0 of 10)</div>
                <div style="background-color: #c7ccd5; height: 2px; margin-bottom: 20px;"></div>
                <div>Questions Navigational</div>
                <div style="background-color: #c7ccd5; height: 2px; margin-bottom: 20px;"></div>
                
            </div>
        </div>
    </div>
</section>


<script>
    // Get the target date/time from the Laravel backend variable
    
    
    
    const countDownDate = new Date("{{ $endTime }}").getTime();
    
    // Update the count down every 1 second
    const x = setInterval(function() {

        // Get today's date and time
        const now = new Date().getTime();

        // Find the distance between now and the count down date
        const distance = countDownDate - now;

        // Time calculations for days, hours, minutes and seconds
        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Display the result in the element with id="countdown-timer"
        document.getElementById("countdown-timer").innerHTML = hours + "h " + minutes + "m " + seconds + "s ";

        // If the count down is finished, write some text
        if (distance < 0) {
            clearInterval(x);
            document.getElementById("countdown-timer").innerHTML = "EXPIRED";
            // You can also add code to reload the page or perform other actions here
        }
    }, 1000);
</script>


<div style="text-align: right;margin-top: 10px; padding: 20px; ">
Copyright © 2015 - 2026 MedExHub.com<br>

From triage to disposition, iSim.ai  offers cutting-edge emergency simulation—give it a try!
</div>

<script src="https://assets.startbootstrap.com/js/sb-customizer.js"></script>
        <sb-customizer project="sb-admin-pro"></sb-customizer>





@include('frontend.index_footer')
