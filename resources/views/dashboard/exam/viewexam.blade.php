@php
use Carbon\Carbon;    
@endphp
@extends('dashboard.layoutDashboard')
@section('viewexam')
    @php
        $Checkvalue = "0";
        $Exam = DB::table('exams')->select('e_name','e_qt_id')->where('e_id', $e_id)->get();
        $ExamsName = $Exam->first()->e_name ?? 'No Category Found';
        $Exam = DB::table('tests')->select('t_type')->where('t_id', $testid)->get();
        $ExamType = $Exam->first()->t_type ?? '0';
    @endphp
<section class="content-panel">
    <div class="title-row">
        <div>
            <span class="title-kicker">Start Exam</span>
            <h1>{{$ExamsName}}</h1>
            <p class="title-subtitle">Prepare with structure, revise with purpose, and track every step of your exam journey.</p>
        </div>
        <div class="db-actions"><a href="/showexam/{{$e_id}}" class=" btn db-btn btn-sm">< Back</a></div>
    </div>
    @if($ExamType == 1)
        <div class="row">
            <div class="col-md-12">
                <p class="title-subtitle">Prepare with structure, revise with purpose, and track every step of your exam journey.Prepare with structure, revise with purpose, and track every step of your exam journey.Prepare with structure, revise with purpose, and track every step of your exam journey.Prepare with structure, revise with purpose, and track every step of your exam journey.Prepare with structure, revise with purpose, and track every step of your exam journey.Prepare with structure, revise with purpose, and track every step of your exam journey.</p>
                <p class="title-subtitle">Prepare with structure, revise with purpose, and track every step of your exam journey.</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center" style="margin-top:30px;">
                @php
                    $linkData = array($testid, 1);
                    $linkDatastring = implode(", ", $linkData);
                @endphp
                <a class="btn btn-dashboard btn-sm" href="/workboard/{{$linkDatastring}}" target="_blank">Start Exam</a>
            </div>
        </div>
    @endif    
    @if($ExamType == 2)
        <div class="row">
            <div class="col-md-12">
                <p class="title-subtitle">Prepare with structure, revise with purpose, and track every step of your exam journey.Prepare with structure, revise with purpose, and track every step of your exam journey.Prepare with structure, revise with purpose, and track every step of your exam journey.Prepare with structure, revise with purpose, and track every step of your exam journey.Prepare with structure, revise with purpose, and track every step of your exam journey.Prepare with structure, revise with purpose, and track every step of your exam journey.</p>
                <p class="title-subtitle">Prepare with structure, revise with purpose, and track every step of your exam journey.</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center" style="margin-top:30px;">
                <a class="btn btn-dashboard btn-sm" href="/workboard_r/{{$testid}}"  target="_blank">Start Revision</a>
            </div>
        </div>
    @endif
</section>
    
    
    
    
    
    
    
    
    
    
@endsection