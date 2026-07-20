@php
use Carbon\Carbon;    
@endphp
@extends('dashboard.layoutDashboard')
@section('createnew')
    @php
        $Checkvalue = "0";
        $Category = DB::table('exams')->select('e_name','e_qt_id')->where('e_id', $e_id)->get();
        $CategoryName = $Category->first()->e_name ?? 'No Category Found';
        $CQtId = $Category->first()->e_qt_id ?? 'No Qt Id Found';
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
        <form method="POST" action="{{ route('makeexam') }}">
        @csrf
            <input type="hidden" name="e_id" value="{{ $e_id }}">
            <div class="row">
                <div class="col-md-12">
                    <spam style="font-size: 20px;">Select Curriculum</spam>
                    &nbsp;&nbsp;&nbsp;
                    <a href="/subsection/{{$e_id}}" class=" btn btn-info btn-sm">Subsection</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <spam style="font-size: 14px;color: red;">
                        Note: By selecting a higher level curriculum, all the sub levels will be included automatically.<br>
                        If you want to attempt a specific subsection click at that subsection only.<br>
                        For example selecting anatomy will select questions from all the subsections.
                    </spam>
                </div>
            </div>
            @forelse ($Subselecteds as $Subselected)
                @php
                    $Category = DB::table('exams')->select('e_name','e_inner_level')->where('e_inner_level', $Subselected)->get();
                    $CategoryName = $Category->first()->e_name ?? 'No Category Found';
                    $CategoryInnerLevel = $Category->first()->e_inner_level ?? 'No Info Available';
                    $Checkvalue = "1";
                @endphp 
                <div class="row mt-0">
                    <div class="col-md-12">&nbsp;&nbsp;&nbsp;
                        <label>
                            <input type="checkbox" name="TopicSelection[]" value="{{ $CategoryInnerLevel }}" checked>&nbsp;&nbsp;{{ $CategoryName }}
                        </label>
                    </div>
                </div>
            @empty
                @php
                    $Category = DB::table('exams')->select('e_name','e_inner_level')->where('e_id', $e_id)->get();
                    $CategoryName = $Category->first()->e_name ?? 'No Exam Found';
                    $CategoryInnerLevel = $Category->first()->e_inner_level ?? 'No Info Available';
                @endphp 
                <div class="row mt-3">
                    <div class="col-md-12">&nbsp;&nbsp;&nbsp;
                        <label>
                            <input type="checkbox" name="TopicSelection[]" value="{{ $CategoryInnerLevel }}" checked>&nbsp;&nbsp;{{ $CategoryName }}
                        </label>
                    </div>
                </div>
            @endforelse
            @if($Checkvalue == 1)
                <a href="/createnew/{{$e_id}}" class=" btn btn-info btn-sm">Clear</a>
            @endif
            @if($CQtId == 3)
                <input type="hidden" name="Mode" value="2"> 
            @else
                <div class="row">
                <div class="col-md-12">
                    <spam style="font-size: 20px;">Select Mode</spam>
                </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12">&nbsp;&nbsp;&nbsp;
                        <label>
                            <input type="radio" name="Mode" value="1" checked> &nbsp;&nbsp;Exam Mode
                        </label>&nbsp;&nbsp;&nbsp;
                        <label>
                            <input type="radio" name="Mode" value="2"> &nbsp;&nbsp;Revision Mode
                        </label>
                    </div>
                </div>
            @endif
            <div class="row mt-4">
                <div class="col-md-12">
                    <spam style="font-size: 20px;">Select Question Type</spam>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-12">
                    @if (!empty($CQtId))
                        @foreach(explode(';', $CQtId) as $QTypeId)
                            @php
                                $QT = DB::table('question_type')->select('qt_name')->where('qt_id', $QTypeId)->get();
                                $QTName = $QT->first()->qt_name ?? 'No Category Found';    
                            @endphp
                            &nbsp;&nbsp;&nbsp;
                            @if($loop->first)
                                <label>
                                    <input type="checkbox" name="QueType[]" value="{{ $QTypeId }}" checked>&nbsp;&nbsp;{{ $QTName }}
                                </label>
                            @else
                                <label>
                                    <input type="checkbox" name="QueType[]" value="{{ $QTypeId }}">&nbsp;&nbsp;{{ $QTName }}
                                </label>
                            @endif
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-12">
                    <spam style="font-size: 20px;">Question Reviewed</spam>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-12">
                    &nbsp;&nbsp;&nbsp;
                    <label>
                        <input type="radio" name="Reviewed" value="1" checked> &nbsp;&nbsp;Reviewed earlier
                    </label>
                    &nbsp;&nbsp;&nbsp;
                    <label>
                        <input type="radio" name="Reviewed" value="2"> &nbsp;&nbsp;Not reviewed yet
                    </label>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-12">
                    <spam style="font-size: 20px;">Select Number of Questions</spam>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-12">&nbsp;&nbsp;&nbsp;
                    <label>
                        <input type="radio" name="NoOfQue" value="10" checked> &nbsp;&nbsp;10
                    </label>
                    &nbsp;&nbsp;&nbsp;
                    <label>
                        <input type="radio" name="NoOfQue" value="20"> &nbsp;&nbsp;20
                    </label>
                    &nbsp;&nbsp;&nbsp;
                    <label>
                        <input type="radio" name="NoOfQue" value="30"> &nbsp;&nbsp;30
                    </label>
                    &nbsp;&nbsp;&nbsp;
                    <label>
                        <input type="radio" name="NoOfQue" value="40"> &nbsp;&nbsp;40
                    </label>
                    &nbsp;&nbsp;&nbsp;
                    <label>
                        <input type="radio" name="NoOfQue" value="50"> &nbsp;&nbsp;50
                    </label>
                    &nbsp;&nbsp;&nbsp;
                    <label>
                        <input type="radio" name="NoOfQue" value="60"> &nbsp;&nbsp;60
                    </label>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-12" style="text-align: center;">
                    <button type="submit" class=" btn btn-success">Generate</button>
                </div>
            </div>
        </form>
    </div>
@endsection