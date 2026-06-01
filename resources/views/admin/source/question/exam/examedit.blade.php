@php
use Carbon\Carbon; 
$DefaltExamid = "1";   
@endphp
@extends('admin.assets.adminlayout')
@section('content')
    <div class="container-fluid">
<!-- Page Heading -->
<div class='row align-items-center justify-content-between pt-3 mb-3'>
    <div class='col-auto mb-0 h3 text-gray-800'>Edit Exam</div>
</div>    
{{-- @if(session('success'))
    <div class="successAlert">
        {{ session('success') }}
    </div>
@endif --}}
    @php
    $Exam = DB::table('exams')->select('*')->where('e_id', $e_id)->get();
    $ExamName = $Exam->first()->e_name ?? 'No Exam Found';
    $ExamLevel = $Exam->first()->e_level ?? 'No Exam Found'; 
    @endphp
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class='row align-items-center justify-content-between pt-3 mb-3'>
                <div class='col-auto mb-0 h3 text-gray-800'>{{$ExamName}}</div>
                <div class='col-12 col-xl-auto mb-0'>
                    @if($ExamLevel == "1")
                        <a class="btn btn-primary btn-sm" href='/adminExams'><i class="fas fa-backward"></i> Back to Exam's</a>
                    @else
                        <a class="btn btn-primary btn-sm" href='/adminExamInner/{{ $ExamLevel }}'><i class="fas fa-backward"></i> Back to {{$ExamName}}</a>
                    @endif
                </div>
            </div> 
            <h3></h3> 
            <div class="container">
                @if($ExamLevel == "1")
                    <form action="{{ route('adminEditUExam') }}"  method="POST">
                        @csrf
                        <input type="hidden" name="e_id" value="{{$e_id}}">
                    <div class="row mt-4">
                        <div class="col">
                            <label for="exampleInputEmail1" class="form-label">Exam Name</label>
                            <input type="text" class="form-control" value="{{$ExamName}}" name="exam_name" >
                        </div>
                        <div class="col">
                            <label for="exampleInputEmail1" class="form-label">Exam Info</label>
                            <input type="text" class="form-control" value="{{$Exam->first()->e_info ?? 'No Exam Info Found'}}" name="exam_info" >
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col">
                            <label for="exampleInputEmail1" class="form-label">3 Months Price</label>
                            <input type="text" class="form-control" value="{{$Exam->first()->e_price3m ?? 'No Price Found'}}" name="price3m" >
                        </div>
                        <div class="col">
                            <label for="exampleInputEmail1" class="form-label">6 Months Price</label>
                            <input type="text" class="form-control" value="{{$Exam->first()->e_price6m ?? 'No Price Found'}}" name="price6m" >
                        </div>
                        <div class="col">
                            <label for="exampleInputEmail1" class="form-label">1 Year Price</label>
                            <input type="text" class="form-control" value="{{$Exam->first()->e_price1y ?? 'No Price Found'}}" name="price1y" >
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col">
                            <label for="exampleInputEmail1" class="form-label">Question Types</label>
                            <input type="text" class="form-control"  value="{{$Exam->first()->e_qt_id ?? 'No Price Found'}}" aria-describedby="emailHelp" name="question_types">
                            <div id="emailHelp" class="form-text">(1 for MCQ) , (2 for EMQ), (3 for Long Answer) Type Like (1;2;3),(1;2;3;...) </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col">
                            <label for="exampleFormControlTextarea1" class="form-label">Example textarea</label>
                            <textarea class="form-control"  rows="5" name="exam_description">{{ strip_tags($Exam->first()->e_description ?? 'No Description Found') }}</textarea>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                    </form>
                @else
                    <form action="{{ route('adminEditU2Exam') }}"  method="POST">
                        @csrf
                        <input type="hidden" name="e_id" value="{{$e_id}}">
                    <div class="row mt-4">
                        <div class="col">
                            <label for="exampleInputEmail1" class="form-label">SubSection Name</label>
                            <input type="text" class="form-control" value="{{$ExamName}}" name="exam_name" >
                        </div>
                    </div>
                    
                    <div class="row mt-4">
                        <div class="col">
                            <label for="exampleFormControlTextarea1" class="form-label">Example textarea</label>
                            <textarea class="form-control"  rows="5" name="exam_description">{{ strip_tags($Exam->first()->e_description ?? 'No Description Found') }}</textarea>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                    </form>
                @endif        
            </div>
        </div>
    </div>
</div>
@endsection