
@php
use Carbon\Carbon;
@endphp
@include('frontend.index_header')
@php
    $Category = DB::table('exams')->select('e_name','e_info')->where('e_id', $e_id)->get();
    $CategoryName = $Category->first()->e_name ?? 'No Category Found'; 
@endphp
  <style>
    :root {
      --exam-primary: #2563eb;
      --exam-primary-dark: #1d4ed8;
      --exam-primary-soft: #eff6ff;
      --exam-success: #16a34a;
      --exam-warning: #f59e0b;
      --exam-text: #172033;
      --exam-muted: #64748b;
      --exam-border: #e2e8f0;
      --bs-primary: #2563eb;
      --bs-primary-rgb: 37, 99, 235;
      --bs-success: #16a34a;
      --bs-success-rgb: 22, 163, 74;
      --bs-warning: #f59e0b;
      --bs-warning-rgb: 245, 158, 11;
      --bs-danger: #dc2626;
      --bs-danger-rgb: 220, 38, 38;
      --bs-body-color: #172033;
      --bs-body-font-family: Inter, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
      --bs-border-color: #e2e8f0;
      --bs-border-radius: .85rem;
      --bs-border-radius-lg: 1.1rem;
    }
    body {
      min-height: 100vh;background:radial-gradient(circle at 10% 0%, rgba(37, 99, 235, .13), transparent 32%),
        radial-gradient(circle at 95% 14%, rgba(14, 165, 233, .09), transparent 28%),
        linear-gradient(180deg, #f8fbff 0%, #f5f8fc 58%, #fff 100%);
    }
    .brand-mark {display: grid;width: 46px;height: 46px;place-items: center;border-radius: 14px;color: #fff;font-weight: 800;background: linear-gradient(135deg, var(--exam-primary), #0ea5e9);box-shadow: 0 10px 24px rgba(37, 99, 235, .24);}
    .section-heading {border-bottom: 2px solid rgba(37, 99, 235, .72);}
    .question-card {position: relative;overflow: hidden;border: 1px solid rgba(226, 232, 240, .95) !important;background: rgba(255, 255, 255, .95);backdrop-filter: blur(10px);}
    .question-card::before {content: "";position: absolute;inset: 0 auto 0 0;width: 5px;background: linear-gradient(180deg, var(--exam-primary), #38bdf8);}
    .question-text {font-size: .94rem;line-height: 1.7;}
    .answer-option {position: relative;display: grid;grid-template-columns: 44px minmax(0, 1fr) 24px;align-items: center;gap: 1rem;min-height: 80px;padding: 1rem 1.15rem;cursor: pointer;border-color: transparent !important;transition: transform .16s ease, border-color .16s ease, background .16s ease, box-shadow .16s ease;}
    .answer-option:hover {transform: translateY(-2px);border-color: #bfdbfe !important;box-shadow: 0 14px 32px rgba(15, 23, 42, .10) !important;}
    .answer-option:focus-within {outline: 3px solid rgba(37, 99, 235, .18);outline-offset: 2px;}
    .answer-option.selected {border-color: var(--exam-primary) !important;background: linear-gradient(90deg, #eff6ff, #f8fbff);box-shadow: 0 12px 30px rgba(37, 99, 235, .13) !important;}
    .answer-option.correct {border-color: var(--exam-success) !important;background: #f0fdf4;}
    .answer-option.incorrect {border-color: var(--bs-danger) !important;background: #fef2f2;}
    .answer-option input {position: absolute;opacity: 0;pointer-events: none;}
    .answer-letter {display: grid;width: 42px;height: 42px;place-items: center;border: 1px solid var(--exam-border);border-radius: 13px;color: #475569;background: #f8fafc;font-weight: 800;transition: .16s ease;}
    .answer-option.selected .answer-letter {color: #fff;border-color: var(--exam-primary);background: var(--exam-primary);box-shadow: 0 8px 18px rgba(37, 99, 235, .20);}
    .answer-title { font-size: 1rem; }
    .radio-indicator {position: relative;width: 22px;height: 22px;border: 2px solid #94a3b8;border-radius: 50%;background: #fff;}
    .answer-option.selected .radio-indicator { border-color: var(--exam-primary);}
    .answer-option.selected .radio-indicator::after {content: "";position: absolute;inset: 4px;border-radius: 50%;background: var(--exam-primary);}
    .performance-sidebar { position: sticky; top: 1rem; }
    .metric-icon {display: inline-grid;width: 34px;height: 34px;place-items: center;border-radius: 10px;color: var(--exam-primary);background: var(--exam-primary-soft);font-weight: 800;}
    .timer-value {font-variant-numeric: tabular-nums;font-size: clamp(1.7rem, 4vw, 2rem);letter-spacing: .03em;}
    .timer-ring {display: grid;width: 58px;height: 58px;place-items: center;border-radius: 50%;background: conic-gradient(var(--exam-primary) 0 72%, #dbeafe 72% 100%);}
    .timer-ring::before {content: "";width: 44px;height: 44px;border-radius: 50%;background: #fff;}
    .progress-donut {position: relative;display: grid;flex: 0 0 auto;width: 104px;height: 104px;place-items: center;border-radius: 50%;background: conic-gradient(var(--exam-success) 0 var(--progress-angle, 0deg), #e2e8f0 var(--progress-angle, 0deg) 360deg);transition: background .25s ease;}
    .progress-donut::before {content: "";position: absolute;inset: 11px;border-radius: 50%;background: #fff;box-shadow: inset 0 0 0 1px #f1f5f9;}
    .progress-centre { position: relative; z-index: 1; text-align: center; }
    .progress-centre strong { display: block; font-size: 1.3rem; line-height: 1; }
    .progress-centre span { color: var(--exam-muted); font-size: .69rem; font-weight: 600; }
    .question-navigation {display: grid;grid-template-columns: repeat(5, minmax(0, 1fr));gap: .5rem;}
    .question-button {aspect-ratio: 1;min-width: 0;padding: 0;border: 1px solid var(--exam-border);border-radius: .7rem;color: #64748b;background: #f8fafc;font-size: .82rem;font-weight: 700;}
    .question-button:hover {color: var(--exam-primary);border-color: #93c5fd;background: var(--exam-primary-soft);}
    .question-button.answered { color: #fff; border-color: var(--exam-success); background: var(--exam-success); }
    .question-button.current { color: #fff; border-color: var(--exam-primary); background: var(--exam-primary); box-shadow: 0 0 0 4px rgba(37, 99, 235, .13); }
    .question-button.skipped { color: #92400e; border-color: #fbbf24; background: #fef3c7; }
    .legend-swatch { width: 9px; height: 9px; border-radius: 3px; }
    .btn-discussion {
      --bs-btn-color: #5b21b6;
      --bs-btn-bg: #f5f3ff;
      --bs-btn-border-color: #c4b5fd;
      --bs-btn-hover-color: #5b21b6;
      --bs-btn-hover-bg: #ede9fe;
      --bs-btn-hover-border-color: #8b5cf6;
    }
    .discussion-question-summary {border: 1px solid #ddd6fe;background: #fff;}
    .discussion-post {display: grid;grid-template-columns: 44px minmax(0, 1fr);overflow: hidden;border: 1px solid var(--exam-border);border-radius: .8rem;background: #fff;}
    .vote-column {display: flex;flex-direction: column;align-items: center;gap: 2px;padding: .65rem .3rem;background: #f8fafc;}
    .vote-button {display: grid;width: 28px;height: 25px;place-items: center;border: 0;border-radius: .45rem;color: #94a3b8;background: transparent;font-size: .8rem;}
    .vote-button:hover, .vote-button.active { color: #7c3aed; background: #ede9fe; }
    .vote-score { color: #475569; font-size: .76rem; font-weight: 700; }
    .post-content { min-width: 0; padding: .8rem .9rem; }
    .post-meta { display: flex; flex-wrap: wrap; gap: .38rem; color: var(--exam-muted); font-size: .72rem; }
    .post-author { color: #334155; font-weight: 700; }
    .author-badge { padding: .12rem .4rem; border-radius: 999px; color: #1d4ed8; background: #dbeafe; font-size: .64rem; font-weight: 700; }
    .post-text { margin: .5rem 0; color: #334155; font-size: .88rem; line-height: 1.58; white-space: pre-wrap; }
    .post-actions { display: flex; gap: .8rem; }
    .text-action { padding: 0; border: 0; color: #64748b; background: transparent; font-size: .72rem; font-weight: 700; }
    .text-action:hover { color: #5b21b6; }
    .replies { display: grid; gap: .5rem; margin-top: .65rem; padding-left: .8rem; border-left: 2px solid #ddd6fe; }
    .reply-item { padding: .55rem .65rem; border-radius: .55rem; background: #f8fafc; }
    .reply-text { margin-top: .3rem; color: #475569; font-size: .82rem; line-height: 1.5; white-space: pre-wrap; }
    .reply-composer { display: none; gap: .5rem; margin-top: .65rem; }
    .reply-composer.show { display: grid; }
    .reply-composer textarea { min-height: 64px; }
    .reply-composer-actions { display: flex; justify-content: flex-end; gap: .5rem; }
    @media (max-width: 991.98px) {.performance-sidebar { position: static; }}
    @media (max-width: 575.98px) {
        .answer-option {grid-template-columns: 40px minmax(0, 1fr) 22px;gap: .75rem;padding: .85rem;}
        .brand-subtitle { display: none; }
        .question-card .card-body { padding: 1.25rem !important; }
        }
    .options{width:100%;margin:auto;}
    input[type="radio"]{display:none;}
    .option-card{background:#fff;border:2px solid transparent;border-radius:5px;padding-left:35px;padding-right:35px;min-height: 80px;margin-bottom:10px;display:flex;justify-content:space-between;align-items:center;cursor:pointer;border-color: transparent !important;transition: transform .16s ease, border-color .16s ease, background .16s ease, box-shadow .16s ease;}
    .option-card:hover {transform: translateY(-2px);border-color: #bfdbfe !important;box-shadow: 0 14px 32px rgba(15, 23, 42, .10) !important;}
    .left{display:flex;align-items:center;gap:25px;}
    .right{display:flex;align-items:center;gap:25px;}
    .letter{display: grid;width: 42px;height: 42px;place-items: center;border: 1px solid var(--exam-border);border-radius: 13px;color: #475569;background: #f8fafc;font-weight: 800;transition: .16s ease;}
    .radio{position: relative;width: 22px;height: 22px;border: 2px solid #94a3b8;border-radius: 50%;background: #fff;}
    /* Selected option */
    input:checked + .option-card{background:#eef5ff;border-color:#2f80ff;box-shadow:0 0 10px rgba(47,128,255,.2);}
    input:checked + .option-card .letter{color:#2f80ff;border-color:#bfd4ff;}
    input:checked + .option-card .radio{border-color:#2f80ff;}
    input:checked + .option-card .radio::after{content:"";width:18px;height:18px;background:#2f80ff;border-radius:50%;position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);}
    .letter-title { font-size: 1rem; background-color:#778866;width:90%;padding-top:15px;padding-bottom:15px;}
  </style>
@foreach ($Tests as $item)
    @php
        $QuestionNo = $item->t_answered ?? 0;
        $TestType = $item->t_type ?? 0;
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
            if($TestType == 1) $TestTypeValue = "Exam Mode";
            if($TestType == 2) $TestTypeValue = "Revision Mode";
    @endphp
@endforeach
<div class="container-xxl py-3 py-md-4">    
        <header class="d-flex align-items-center justify-content-between gap-3 mb-2">
            <div class="d-flex align-items-center gap-3">
                <div class="brand-mark">A</div>
                <div class="ml-4">
                    <h1 class="h5 fw-bold mb-1">{{$CategoryName}}</h1>
                    <p class="brand-subtitle small text-secondary mb-0">{{$TestTypeValue}}</p>
                </div>
            </div>
            <span class="badge rounded-pill text-bg-light border px-3 py-2 d-none d-md-inline-flex align-items-center gap-2">
                <span class="rounded-circle bg-success" style="width:8px;height:8px;box-shadow:0 0 0 4px rgba(22,163,74,.12)"></span>
                   &nbsp;&nbsp;&nbsp;Revision session active
            </span>
        </header>
        <div class="row g-4 align-items-start">
            <main class="col-12 col-lg-9">
                @php
                    $QuestionsDB = DB::table('questions')->select('q_question_id','q_qt_id')->where('q_id', $NextQuestion)->get();
                    $QuestionID = $QuestionsDB->first()->q_question_id ?? 'No Question Found';
                    $QuestionQT = $QuestionsDB->first()->q_qt_id ?? 'No Question Found';
                @endphp
                <!--Displaying MCQ Question-->
                @if ($QuestionQT == '1')
                    <form  action="{{ route('submitmcq', ['testid' => $testid]) }}" method="post">
                    @csrf
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
                    <div class="section-heading d-flex align-items-center justify-content-between pb-2 mb-3">
                        <span class="badge rounded-pill text-bg-primary-subtle border border-primary-subtle text-primary-emphasis px-3 py-2" id="questionBadge">Question No : {{$QuestionNo}}</span>
                        <span class="small fw-semibold text-secondary" id="questionCounter">{{$QuestionNo}} of {{$Totallenth}}</span>
                    </div>
                   <section class="card question-card shadow-sm mb-3">
                        <div class="card-body p-4">
                            <p class="question-text mb-0" id="questionText">{{ strip_tags($QuestionText) }}</p>
                        </div>
                    </section> 
                    <div class="options">
                    @php
                        $MCQOptionCount = $QuestionMCQ->first()->mcq_op_count ?? 0;
                        for($i = 1; $i <= $MCQOptionCount; $i++)
                            {
                                $Option = 'Option' . $i;
                                $Alphabet = chr(64 + $i);
                                $SmallAlphabet = chr(96 + $i);
                                echo '<input type="radio" name="option"  value="'.$i.'" id="'.$SmallAlphabet.'">
                                <label for="'.$SmallAlphabet.'" class="option-card">
                                    <div class="left">
                                    <div class="letter">' . $Alphabet . '</div>
                                    <span>' . ${$Option} . '</span>
                                    </div>
                                    <div class="radio"></div>
                                </label>';
                            }
                    @endphp
                    </div>
                    <div class="d-flex flex-wrap align-items-center gap-2 mt-4">
                        <input type="hidden" name="Question_ID" value="{{ $QuestionID }}">
                        <input type="hidden" name="NextQuestion" value="{{ $NextQuestion }}">
                        <input type="hidden" name="Question_QT" value="{{ $QuestionQT }}">
                        <input type="hidden" name="Question_No" value="{{ $QuestionNo }}">
                        <input type="submit" class="btn btn-primary px-4" value="Submit answer">
                        @php
                            $linkData = array($testid, $NextQuestion, $QuestionNo);
                            $string = implode(", ", $linkData);
                        @endphp
                        <a href="/questionskip/{{$string}}" class=" btn btn-warning">Skip</a>
                        <a href="/finishexam/{{$testid}}" class="btn btn-success ms-lg-auto" id="finishBtn">Finish exam</a>
                    </div>
                    </form>
                @endif
                <!--Displaying EMQ Question-->
                @if ($QuestionQT == '2')
                    <form  action="{{ route('submitemq', ['testid' => $testid]) }}" method="post">
                    @csrf 
                    @php
                        $QuestionEMQ = DB::table('questions_emq')->select('*')->where('emq_id', $QuestionID)->get();
                        $QuestionTheme = $QuestionEMQ->first()->emq_theme ?? 'No Question Found';
                        $QuestionReference = $QuestionEMQ->first()->emq_reference ?? 'No Question Found';
                        $QuestionLeadIn = $QuestionEMQ->first()->emq_lead_in ?? 'No Question Found';
                        if($QuestionNo == 0) $QuestionNoC = 1; else $QuestionNoC = $QuestionNo + 1;
                    @endphp 
                    <div class="section-heading d-flex align-items-center justify-content-between pb-2 mb-3">
                        <span class="badge rounded-pill text-bg-primary-subtle border border-primary-subtle text-primary-emphasis px-3 py-2" id="questionBadge">EMQ</span>
                        <span class="small fw-semibold text-secondary" style="margin-bottom: -20px;" >{{$QuestionNoC}} of {{$Totallenth}}</span>
                    </div>
                    <section class="card question-card shadow-sm mb-3">
                        <div class="card-body p-4">
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
                    </section>
                    @php
                    $EMQQuestionCount = $QuestionEMQ->first()->emq_q_count ?? 0;
                    for($i = 1; $i <= $EMQQuestionCount; $i++)
                        {
                            $QuestionNo++;
                            $EMQQuestionCol = "emq_q_".$i;
                            $Question = $QuestionEMQ->first()->$EMQQuestionCol ?? 'No Option Found';
                            echo '<section class="card question-card shadow-sm mb-3">';
                                echo '<div class="card-body p-4">';
                                    echo '<h5 class="card-title">Question No : ' . $QuestionNo . '</h5>';
                                    echo '<p class="card-text">' . strip_tags($Question) . '</p>';
                                    echo '<div class="container">';
                                        echo '<div class="row mt-2">';
                                            echo '<div class="col-md-2 mt-2" style="max-width: 100px;padding-top: 6px;">';
                                                echo '<strong>Option : </strong>';
                                            echo '</div>';
                                            echo '<div class="col-md-10 mt-2">';
                                                echo '<select class="form-select " name="option[]" aria-label="Default select example">';
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
                            echo '</section>';
                        } 
                    @endphp
                    <div class="d-flex flex-wrap align-items-center gap-2 mt-4">
                        <input type="hidden" name="Question_ID" value="{{ $QuestionID }}">
                        <input type="hidden" name="NextQuestion" value="{{ $NextQuestion }}">
                        <input type="hidden" name="Question_QT" value="{{ $QuestionQT }}">
                        <input type="hidden" name="Question_No" value="{{ $QuestionNo }}">
                        <input type="submit" class="btn btn-primary px-4" value="Submit answer">
                        @php
                            $linkData = array($testid, $NextQuestion, $QuestionNo);
                            $string = implode(", ", $linkData);
                        @endphp
                        <a href="/questionskip/{{$string}}" class=" btn btn-warning">Skip</a>
                        <a href="/finishexam/{{$testid}}" class="btn btn-success ms-lg-auto" id="finishBtn">Finish exam</a>
                    </div>
                    </form>
                @endif
            </main>  
            <aside class="col-12 col-lg-3 performance-sidebar">
                <div class="section-heading pb-2 mb-3">
                    <h2 class="h5 fw-bold mb-0">Your Performance</h2>
                </div>
                <div class="row g-3">
                    <div class="col-12 col-md-4 col-lg-12">
                        <section class="card border-0 shadow-sm h-100">
                        <div class="card-body p-3 p-xl-4">
                            <h3 class="h6 fw-bold d-flex align-items-center gap-2 border-bottom pb-3 mb-3">
                            <span class="metric-icon" aria-hidden="true">◷</span> Timer
                            </h3>
                            <div class="d-flex align-items-center justify-content-between gap-3">
                            <div>
                                <small class="text-secondary d-block mb-1">Time remaining</small>
                                <div class="timer-value fw-normal" id="timer"></div>
                            </div>
                            <div class="timer-ring" aria-hidden="true"></div>
                            </div>
                        </div>
                        </section>
                    </div>
                    <div class="col-12 col-md-4 col-lg-12 mt-4">
                        <section class="card border-0 shadow-sm h-100">
                            <div class="card-body p-3 p-xl-4" >
                                <h3 class="h6 fw-bold d-flex align-items-center gap-2 border-bottom pb-3 mb-3">
                                    <span class="metric-icon" aria-hidden="true">✓</span> Progress
                                </h3>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="chart-pie">
                                        <canvas id="myPieChart" width="100%" height="120"></canvas>
                                    </div>
                                    <div class="flex-grow-1 d-grid gap-2 small" >
                                        <div class="d-flex justify-content-between"><span class="text-secondary"><span class="badge bg-success p-1 me-1"> </span>&nbsp;&nbsp;Answered</span></div>
                                        <div class="d-flex justify-content-between"><span class="text-secondary"><span class="badge bg-secondary p-1 me-1"> </span>&nbsp;&nbsp;Remaining</span></div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                    <div class="col-12 col-md-4 col-lg-12 mt-4">
                        <section class="card border-0 shadow-sm h-100">
                        <div class="card-body p-3 p-xl-4">
                            <h3 class="h6 fw-bold d-flex align-items-center gap-2 border-bottom pb-3 mb-3">
                                <span class="metric-icon" aria-hidden="true">#</span> Question navigation
                            </h3>
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
                                                            echo '<a class="btn btn-light btn-sm m-1" style="border-radius: 20%; width: 40px; height: 40px;padding-top:8px;background-color: rgb(0 0 0 / 5%);" href="#questionpos'.$QNNumber.'">'.$QNNumber.'</a>';
                                                        }
                                                    else 
                                                        {
                                                            echo '<a class="btn btn-success btn-sm m-1" style="border-radius: 20%; width: 40px; height: 40px;padding-top:8px;" href="#questionpos'.$QNNumber.'">'.$QNNumber.'</a>';    
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
                                                                    echo '<a class="btn btn-light btn-sm m-1" style="border-radius: 20%; width: 40px; height: 40px;padding-top:8px;background-color: rgb(0 0 0 / 5%);" href="#questionpos'.$QNNumber.'">'.$QNNumber.'</a>';
                                                                }
                                                            else 
                                                                {
                                                                    echo '<a class="btn btn-success btn-sm m-1" style="border-radius: 20%; width: 40px; height: 40px;padding-top:8px;" href="#questionpos'.$QNNumber.'">'.$QNNumber.'</a>';
                                                                }
                                                            $QNNumber++;    
                                                        }
                                                }    
                                        }    
                                @endphp
                            @endforeach
                            <div class="d-flex flex-wrap gap-3 mt-3 small text-secondary">
                                <span class="d-inline-flex align-items-center gap-1"><span class="legend-swatch bg-success"></span>Answered</span>
                                <span class="d-inline-flex align-items-center gap-1"><span class="legend-swatch bg-secondary"></span>Remaining</span>
                            </div>
                        </div>
                        </section>
                    </div>
                </div>
            </aside>
        </div>
        <footer class="d-flex flex-column flex-md-row justify-content-between gap-2 mt-4 pt-3 border-top small text-secondary">
            <span>Copyright © 2015–2026 <strong class="text-body">MedExHub.com</strong></span>
            <span>From triage to disposition, iSim.ai offers cutting-edge emergency simulation.</span>
        </footer>
    </div>
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
$QuestionLeft = $Totallenth - $GharfNumber;
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
                    "rgba(25, 135, 84, 1)",
                    "rgba(255,204,204, 1)"
                ],
                hoverBackgroundColor: [
                    "rgba(188,188,188, 0.9)",
                    "rgba(25, 135, 84, 0.9)",
                    "rgba(255,204,204, 0.9)"
                    
                ],
                hoverBorderColor: [
                    "rgba(91,91,91, 0.9)",
                    "rgba(25, 135, 84, 0.9)",
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
            cutoutPercentage: 70
        }
    });
</script>