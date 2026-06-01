@php
use Carbon\Carbon;    
@endphp
@extends('dashboard.layoutDashboard')
@section('viewexam')
    @php
        $Checkvalue = "0";
        $Category = DB::table('exams')->select('e_name','e_qt_id')->where('e_id', $e_id)->get();
        $CategoryName = $Category->first()->e_name ?? 'No Category Found';
        $CQtId = $Category->first()->e_qt_id ?? 'No Qt Id Found';
        $Exam = DB::table('tests')->select('t_type')->where('t_id', $testid)->get();
        $ExamType = $Exam->first()->t_type ?? '0';
    @endphp

    <div class='container-fluid'>
        <div class="row">
            <div class="col-md-8">
                <h1 class='h3 mb-0 text-gray-800' style="color: #2572ff">{{ $CategoryName }}</h1>
            </div>
            <div class="col-md-4 mb-1" style="text-align: right;">
            </div>
        </div>
        <div style="background-color: #bebfc1; height: 4px; margin-bottom: 50px;"></div>    
        @if($ExamType == 1)
            <div class="row">
                <div class="col-md-12 text-center">
                    <spam style="font-size: 20px;">Start Exam</spam>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">
                    @php
                        $linkData = array($testid, 1);
                        $linkDatastring = implode(", ", $linkData);
                    @endphp
                    <a href="/workboard/{{$linkDatastring}}" class=" btn btn-info">Start</a>
                </div>
            </div>
        @endif    
        @if($ExamType == 2)
            <div class="row">
                <div class="col-md-12 text-center">
                    <spam style="font-size: 20px;">Start Revision</spam>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">
                    <a href="/workboard_r/{{$testid}}" class=" btn btn-info">Start</a>
                </div>
            </div>
        @endif
        
        
        
    </div>
@endsection