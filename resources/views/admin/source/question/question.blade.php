@php
use Carbon\Carbon; 
$DefaltExamid = "1";   
@endphp
@extends('admin.assets.adminlayout')
@section('content')
    <div class="container-fluid">
<!-- Page Heading -->
<div class='row align-items-center justify-content-between pt-3 mb-3'>
    @php
         $QT_DB = DB::table('question_type')->select('qt_name')->where('qt_id', $qt_id)->get();
         $QuestionType = $QT_DB->first()->qt_name;
    @endphp
    <div class='col-auto mb-0 h3 text-gray-800'>{{$QuestionType}}</div>
</div>    
{{-- @if(session('success'))
    <div class="successAlert">
        {{ session('success') }}
    </div>
@endif --}}
    <div class="card shadow mb-4">
        <div class="card-body">
            @php
                if($e_id != "0")
                    {
                        echo '<div class="row">';
                            echo '<div class="col-10 mb-3">';
                                $ExamString = DB::table('exams')->where('e_id', $e_id)->get();
                                $varone = $ExamString->first()->e_inner_level;
                                $Levels = explode(".",$varone);
                                $Count = count($Levels);
                                $String = "";
                                $Create = "";
                                for ($i = 0; $i < $Count; $i++)
                                    {
                                        $Create .= $Levels[$i].".";
                                        $ExamString2 = DB::table('exams')->where('e_inner_level', substr($Create,0,strlen($Create)-1))->get();
                                        $NewExamName = $ExamString2->first()->e_name;
                                        $ExamPathe = $ExamString2->first()->e_id;
                                        $linkData = array($ExamPathe,$qt_id);
                                        $stringLinkData = implode(",", $linkData);
                                        if($i == 0)
                                            $String .= "<a href='/adminQuestion/$qt_id'>".$NewExamName."</a>";
                                        else
                                            $String .= "&nbsp;&nbsp;&nbsp;&nbsp;>>&nbsp;&nbsp;&nbsp;&nbsp;<a href='/adminQuestionSelectExamLink/$stringLinkData'>".$NewExamName."</a>";
                                    }
                                    echo $String;
                            echo '</div>';
                            echo '<div class="col-2 mb-3" style="text-align: right;">';
                                if($ExamPathe != 1)
                                    echo "<a href='/adminAddQuestion/$stringLinkData' class='btn btn-success btn-sm'><i class='fas fa-clipboard-list fa-sm text-white-50'></i>&nbsp;&nbsp;Add ".$QuestionType."</a>";
                            echo '</div>';
                        echo '</div>';                                    
                    }
            @endphp
            <label for="SelectOpptionExam" class="form-label">Select Exam</label>
            <form action="{{ route('adminQuestionSelectExam',$e_id) }}"  method="POST">
            @csrf
            <input type="hidden" name="qt_id" value="{{ $qt_id }}">
            <select class="form-select" aria-label="Default select example" id="SelectOpptionExam" name="examOpption" onchange="this.form.submit()" >
                <option value="0">Select Exam</option>
                @php
                    $Exams = DB::table('exams')->select('e_id','e_name')->where('e_level', $e_id)->get();
                @endphp
                @foreach ($Exams as $Exam)
                    @php
                    $Exam_ID = $Exam->e_id ?? '0';
                    $ExamName = $Exam->e_name ?? 'No Exam Found';    
                    @endphp
                    <option value="{{ $Exam_ID }}">{{ $ExamName }}</option>
                @endforeach
            </select>
            </form>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th style="min-width: 50px;">Sr #</th>
                            <th>Question</th>
                            <th style="min-width: 100px;">Actions</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Sr #</th>
                            <th>Question</th>
                            <th>Sr #</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($Questions as $Question)
                            @if($Question->q_status == 0)
                                <tr class="table-danger">
                            @elseif ($Question->q_status == 1)        
                                <tr>
                            @elseif ($Question->q_status == 2)        
                                <tr class="table-warning">
                            @endif
                                <td style='text-align: center;'>{{$loop->iteration}}</td>
                                <td>
                                    @php
                                        if($Question->q_qt_id == 1)
                                            {
                                               $MCQ = DB::table('questions_mcq')->select('mcq_id','mcq_question')->where('mcq_id', $Question->q_question_id)->get();
                                                //Q_ID mcq_id in type 1
                                                $Q_ID = $MCQ->first()->mcq_id ?? 'No Exam Found';
                                                $Q_Data = $MCQ->first()->mcq_question ?? 'No Exam Found';
                                            }
                                        if($Question->q_qt_id == 2)
                                            {
                                                $EMQ = DB::table('questions_emq')->select('emq_id','emq_theme')->where('emq_id', $Question->q_question_id)->get();
                                                //Q_ID emq_id in type 2
                                                $Q_ID = $EMQ->first()->emq_id ?? 'No Exam Found';
                                                $Q_Data = $EMQ->first()->emq_theme ?? 'No Exam Found';
                                            }
                                        if($Question->q_qt_id == 3)
                                            {
                                                $FC = DB::table('questions_fc')->select('fc_id','fc_question')->where('fc_id', $Question->q_question_id)->get();
                                                //Q_ID emq_id in type 3
                                                $Q_ID = $FC->first()->fc_id ?? 'No Exam Found';
                                                $Q_Data = $FC->first()->fc_question ?? 'No Exam Found';
                                            }
                                        if($Question->q_qt_id == 5)
                                            {
                                                $KFP1 = DB::table('questions_kfp_c1')->select('kfp_id','kfp_question')->where('kfp_id', $Question->q_question_id)->get();
                                                //Q_ID emq_id in type 2
                                                $Q_ID = $KFP1->first()->kfp_id ?? 'No Exam Found';
                                                $Q_Data = $KFP1->first()->kfp_question ?? 'No Exam Found';
                                            }
                                        if($Question->q_qt_id == 6)
                                            {
                                                $KFP2 = DB::table('questions_kfp_c2')->select('kfp_c2_id','kfp_c2_question')->where('kfp_c2_id', $Question->q_question_id)->get();
                                                //Q_ID emq_id in type 2
                                                $Q_ID = $KFP2->first()->kfp_c2_id ?? 'No Exam Found';
                                                $Q_Data = $KFP2->first()->kfp_c2_question ?? 'No Exam Found';
                                            }                
                                        
                                    @endphp
                                    {{ strip_tags($Q_Data) }}
                                </td>
                                @php
                                    $linkData1 = array($Q_ID,$qt_id);
                                    $stringLinkData1 = implode(",",$linkData1);
                                @endphp
                                <td style='text-align: center;'>
                                    <a href='/adminEditQuestion/{{ $stringLinkData1 }}'><i class="fas fa-comment-alt-edit"></i></a> &nbsp; &nbsp; &nbsp;
                                    <a href='/adminEditMCQ/{{ $Q_ID }}'><i class="fas fa-eye"></i></a>
                                    {{-- <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#viewModal{{ $Exam->e_id }}"><i class="fas fa-eye"></i></button> --}}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection