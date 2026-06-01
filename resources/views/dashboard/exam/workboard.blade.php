
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
                        $Questions = explode(',', $item->t_questions);
                        $Totallenth = $item->t_lenth;
                        $QuestionCount = count($Questions);
                        $NextQuestion = 0;
                        $SrNo = 1;
                        for($i = 0; $i < $QuestionCount; $i++)
                            {
                                $Question = explode(':', $Questions[$i]);
                                if($NextQuestion == 0)
                                    {
                                        if($Question[3] == 0)
                                            {
                                                $NextQuestion = $Question[0];
                                            }
                                        if($Question[3] == 1)
                                            {
                                                $SrNo = $SrNo + 1;
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
                {{-- Displaying MCQ Question --}}
                <form  action="{{ route('submitmcq', ['testid' => $testid]) }}" method="post">
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
                            <p class="card-text">{{ strip_tags($QuestionText) }}</p>
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
                                @php
                                    $linkData = array($testid, $NextQuestion, $QuestionNo);
                                    $string = implode(", ", $linkData);
                                @endphp
                                <a href="/questionskip/{{$string}}" class=" btn btn-warning">Skip</a>
                            </div>
                            <div class="col-md-4" style="text-align: right;">
                                <a href="/finishexam/{{$testid}}" class=" btn btn-warning">Finish</a>
                            </div>  
                        </div>
                    </div>
                @endif
                </form>
                {{-- Displaying EMQ Question --}}
                <form  action="{{ route('submitemq', ['testid' => $testid]) }}" method="post">
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
                            <p class="card-text"><strong>Theme :</strong> {{ strip_tags($QuestionTheme) }}</p>
                            <p class="card-text"><strong>Reference :</strong> {{ strip_tags($QuestionReference) }}</p>
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
                            <p class="card-text mt-3"><strong>Lead In :</strong> {{ strip_tags($QuestionLeadIn) }}</p>
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
                                @php
                                    $linkData = array($testid, $NextQuestion, $QuestionNo);
                                    $string = implode(", ", $linkData);
                                @endphp
                                <a href="/questionskip/{{$string}}" class=" btn btn-warning">Skip</a>
                            </div>
                            <div class="col-md-4" style="text-align: right;">
                                <a href="/finishexam/{{$testid}}" class=" btn btn-warning">Finish</a>
                            </div>  
                        </div>
                    </div>
                @endif
                </form>
            </div>    
            <div class="col-lg-3"  >
                <h3>Your Performance</h3>
                <div style="background-color: #6593ed; height: 4px; margin-bottom: 20px;"></div>
                <div style="position: sticky; top:0;">
                    <div class="card mt-3" style="width: 100%;border-radius: 10px;box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
                        <div class="card-body" style="height: 130px;" >
                            <h5 class="card-title">Timer</h5>
                            <div style="background-color: #c7ccd5; height: 2px; margin-bottom: 20px;"></div>
                            <div style="text-align: center;">
                                <p style="font-size: 30px;font-weight: bold;" id="timer"></p>
                            </div>
                        </div>
                    </div>
                    <div class="card mt-3" style="width: 100%;border-radius: 10px;box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
                        
                        <div class="card-body" >
                            <h5 class="card-title">Progress</h5>
                            <div style="background-color: #c7ccd5; height: 2px; margin-bottom: 20px;"></div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="card-body">
                                        <div class="chart-pie">
                                            <canvas id="myPieChart" width="100%" height="220"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                            <div class="mt-1 text-center small">
                                <span class="mr-2"><i class="fas fa-circle" style="color:#ccffcc;"></i> Questions answered</span>
                                <span class="mr-2"><i class="fas fa-circle" style="color:#cccccc;"></i> Question Left</span>
                            </div>
                        </div>
                    </div>
                    <div class="card mt-3" style="width: 100%;border-radius: 10px;box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
                        <div class="card-body" >
                            <h5 class="card-title">Questions Navigational</h5>
                            <div style="background-color: #c7ccd5; height: 2px; margin-bottom: 20px;"></div>
                            
                            @foreach ($Tests as $object)
                                @php
                                    $QNNumber = "1";
                                    $QNs = explode(',', $object->t_questions);
                                    $QNsCount = count($QNs);
                                    for($q = 0; $q < $QNsCount; $q++)
                                        {
                                            $QN = explode(':', $QNs[$q]);
                                            $QNType = $QN[1];
                                            if($QNType == '1')
                                                {
                                                    if($QN[3] == 0)
                                                        {
                                                            echo '<a class="btn btn-secondary btn-sm m-1" style="border-radius: 50%; width: 40px; height: 40px;padding-top:8px;" href="#questionpos'.$QNNumber.'">'.$QNNumber.'</a>';
                                                        }
                                                    else 
                                                        {
                                                            echo '<a class="btn btn-success btn-sm m-1" style="border-radius: 50%; width: 40px; height: 40px;padding-top:8px;" href="#questionpos'.$QNNumber.'">'.$QNNumber.'</a>';    
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
                                                            if($QN[3] == 0)
                                                                {
                                                                    echo '<a class="btn btn-secondary btn-sm m-1" style="border-radius: 50%; width: 40px; height: 40px;padding-top:8px;" href="#questionpos'.$QNNumber.'">'.$QNNumber.'</a>';
                                                                }
                                                            else 
                                                                {
                                                                    echo '<a class="btn btn-success btn-sm m-1" style="border-radius: 50%; width: 40px; height: 40px;padding-top:8px;" href="#questionpos'.$QNNumber.'">'.$QNNumber.'</a>';
                                                                }
                                                            $QNNumber++;    
                                                        }
                                                }    
                                        }    
                                @endphp
                            @endforeach  
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
// Function to start the timer
function startTimer() {
    let countdownTime = localStorage.getItem('timer_end');
    //Set timeer countdown time in workboardConntroller.php 
    let interval = setInterval(function() {
        let now = new Date().getTime();
        let distance = countdownTime - now;
        // Calculate minutes and seconds
        let hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        let seconds = Math.floor((distance % (1000 * 60)) / 1000);
        // Display results
        const h = hours.toString().padStart(2, '0');
        const m = minutes.toString().padStart(2, '0');
        const s = seconds.toString().padStart(2, '0');
        if(h == 00)
            document.getElementById("timer").innerHTML = m + ":" + s;
        else
            document.getElementById("timer").innerHTML = h + ":" + m + ":" + s;  
        // If countdown finished
        if (distance < 0) {
            clearInterval(interval);
            localStorage.removeItem('timer_end');
            document.getElementById("timer").innerHTML = "EXPIRED";
            // Optional: location.reload(); // Refresh page
        }
    }, 1000);
}
// Start timer on load
window.onload = startTimer;
</script>
<div style="text-align: right;margin-top: 10px; padding: 20px; ">
Copyright © 2015 - 2026 MedExHub.com<br>
From triage to disposition, iSim.ai  offers cutting-edge emergency simulation—give it a try!
</div>
@include('frontend.index_footer')
@foreach ($Tests as $object)
    @php
        $GharfNumber = "0";
        $QNs = explode(',', $object->t_questions);
        $QNsCount = count($QNs);
        for($q = 0; $q < $QNsCount; $q++)
            {
                $QN = explode(':', $QNs[$q]);
                $QNType = $QN[1];
                if($QNType == '1')
                    {
                        if($QN[3] != 0)
                            {
                                $GharfNumber++;
                            }
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
                                if($QN[3] != 0)
                                    {
                                        $GharfNumber++;
                                    } 
                            }
                    }    
            }    
    @endphp
@endforeach
@php
echo $QuestionLeft = $Totallenth - $GharfNumber;
@endphp
<script>
    // Set new default font family and font color to mimic Bootstrap's default styling
(Chart.defaults.global.defaultFontFamily = "Metropolis"),
'-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = "#858796";
// Pie Chart Example
var questionanswered = "<?php echo $GharfNumber; ?>";
var questionleft = "<?php echo $QuestionLeft; ?>";
var ctx = document.getElementById("myPieChart");
var myPieChart = new Chart(ctx, {
    type: "doughnut",
    data: {
        labels: ["Question Left", "Questions answered"],
        datasets: [{
            data: [questionleft, questionanswered],
            backgroundColor: [
                "rgba(188,188,188, 1)",
                "rgba(204,255,204, 1)",
                "rgba(255,204,204, 1)"
            ],
            hoverBackgroundColor: [
                "rgba(188,188,188, 0.9)",
                "rgba(204,255,204, 0.9)",
                "rgba(255,204,204, 0.9)"
                
            ],
            hoverBorderColor: [
                "rgba(91,91,91, 0.9)",
                "rgba(147,196,125, 0.9)",
                "rgba(235,97,87, 0.9)"
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