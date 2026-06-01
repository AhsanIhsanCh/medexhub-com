@php
use Carbon\Carbon;    
@endphp
@extends('dashboard.layoutDashboard')
@section('message')
    @php
        $Checkvalue = "0";
        $Category = DB::table('exams')->select('e_name','e_qt_id')->where('e_id', $e_id)->get();
        $CategoryName = $Category->first()->e_name ?? 'No Category Found';
        $CQtId = $Category->first()->e_qt_id ?? 'No Qt Id Found';
        if($message == 1)
            {
                $Message = "All Question Reviewed. Please Select Question Type and Number of Question to Start Exam.";
            }
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
        <div class="row">
            <div class="col-md-12 text-center">
                <spam style="font-size: 20px;">Start Exam</spam>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                {{$Message}}
                 <a href="/createnew/{{$e_id}}" class=" btn btn-success">Back</a>
            </div>
        </div>
        
        
        
        
    </div>
@endsection