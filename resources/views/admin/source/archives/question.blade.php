@extends('admin.adminlayout')
@section('mcq')
<?php
$QuestionType = DB::table('question_type')->where('qt_id', $qt_id )->get();
?>
<div class="page-wrapper">
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col">
                    <h3 class="page-title">{{ $QuestionType->first()->qt_name ?? 'Question' }}</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">{{ $QuestionType->first()->qt_name ?? 'Question' }}</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->
        <?php
            echo '<div class="card">';
                echo '<div class="card-header">';
                    echo '<div class="row align-items-center">';
                        echo '<div class="col-auto">';
                            echo '<h5 class="card-title mb-0">Select Exam</h5>';
                        echo '</div>';
                        echo '<div class="col">';
                            echo '<form action="/admin-innerquestion" method="POST">';
                                echo '<input type="hidden" name="_token" value="'.csrf_token().'">';
                                echo '<input type="hidden" name="qt_id" value="'.$qt_id.'">';
                                echo '<input type="hidden" name="limitShow" value="'.$limitShow.'">';
                                echo '<select class="select" style="max-width: 250px !important;" name="examOption" onchange="this.form.submit()" >';
                                    echo '<option value="0">Select Exam</option>';
                                    $ExamOptions = DB::table('exams')->select('e_id','e_name')->where('e_level', $e_id)->get();
                                    foreach ($ExamOptions as $ExamOption)
                                        {
                                            $Exam_ID = $ExamOption->e_id ?? '0';
                                            $ExamName = $ExamOption->e_name ?? 'No Exam Found';    
                                            echo '<option value="'.$Exam_ID.'">'.$ExamName.'</option>';
                                        }
                                echo '</select>';
                            echo '</form>';
                        echo '    </div>';
                    echo '  </div>';
                echo '</div>';
                echo '<div class="card-body py-2">';
                    echo '<nav aria-label="breadcrumb">';
                        echo '<ol class="breadcrumb breadcrumb-arrow mb-0 py-2">';
                        echo '<h5 class="card-title">Selected Exams &nbsp;: &nbsp;&nbsp;</h5>';
                            $ExamString = DB::table('exams')->where('e_id', $e_id)->get();
                            $varone = $ExamString->first()->e_inner_level ?? '0';
                            $Levels = explode(".",$varone);
                            $Count = count($Levels);
                            $String = "";
                            $Create = "";
                            for ($i = 0; $i < $Count; $i++)
                                {
                                    $Create .= $Levels[$i].".";
                                    $ExamString2 = DB::table('exams')->where('e_inner_level', substr($Create,0,strlen($Create)-1))->get();
                                    $NewCatName = $ExamString2->first()->e_name ?? '0';
                                    $CatPathe = $ExamString2->first()->e_id ?? '0';
                                    $linkData = array($qt_id, $CatPathe, $limitShow);
                                    $linkDataString = implode(",", $linkData);
                                    if($i == 0)
                                        {
                                            $String = "<a href='/admin-question/$qt_id'>".$NewCatName."</a>";
                                            echo "<li class='breadcrumb-item'><a href='#'>$String</a></li>";
                                        }
                                    else
                                        {
                                            $String = "<a href='/admin-innerquestionlink/$linkDataString'>".$NewCatName."</a>";
                                            echo "<li class='breadcrumb-item'><a href='#'>$String</a></li>";
                                        }
                                }
                        echo '</ol>';
                    echo '</nav>';
                echo '</div>';
            echo '</div>';
        ?>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between flex-wrap row-gap-3">
                        <div class="search-set">
                            <div class="search-input"><span class="btn-searchset"><i class="ti ti-search fs-14 feather-search"></i></span></div>
                        </div>
                        <div class="d-flex table-dropdown my-xl-auto right-content align-items-center flex-wrap row-gap-3">
                            <div class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle btn btn-white btn-md d-inline-flex align-items-center" data-bs-toggle="dropdown">Show No of Questions</a>
                                <ul class="dropdown-menu  dropdown-menu-end p-3">
                                    <li><a href="/admin-innerquestionlink/{{$qt_id}},{{$e_id}},100" class="dropdown-item rounded-1">100 Questions</a></li>
                                    <li><a href="/admin-innerquestionlink/{{$qt_id}},{{$e_id}},250" class="dropdown-item rounded-1">250 Questions</a></li>
                                    <li><a href="/admin-innerquestionlink/{{$qt_id}},{{$e_id}},500" class="dropdown-item rounded-1">500 Questions</a></li>
                                    <li><a href="/admin-innerquestionlink/{{$qt_id}},{{$e_id}},1000" class="dropdown-item rounded-1">1000 Questions</a></li>
                                    <li><a href="/admin-innerquestionlink/{{$qt_id}},{{$e_id}},99999" class="dropdown-item rounded-1">All Questions</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table datatable on-search">
                                <thead class="thead-light">
                                    <tr>
                                        <th style="width: 50px;text-align: center;">Sr #</th>
                                        <th>Question</th>
                                        <th style="width: 150px;text-align: center;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($Questions as $Question)
                                        <?php
                                        $QuestionMCQ = DB::table('questions_mcq')->where('mcq_id', $Question->q_question_id)->get();
                                        ?>
                                        <tr>
                                            <td style='text-align: center;'>{{$loop->iteration}}</td>
                                            <td style='max-width: 300px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;'><a href="#">{!! $QuestionMCQ->first()->mcq_question ?? 'Question not found' !!}</a></td>
                                            <td style='text-align:center;'>
                                                <a href='/adminEditExam/{{ $loop->iteration }}'><i class="fas fa-comment-alt-edit"></i></a>
                                                <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#viewModal{{ $loop->iteration }}"><i class="fas fa-eye"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright-footer d-flex align-items-center justify-content-between border-top bg-white gap-3 flex-wrap">
        <p class="fs-13 text-gray-9 mb-0">© 2015–{{ date('Y') }} <a href="https://www.medexhub.com" target="_blank" class="link-primary">MedExHub</a>. All Right Reserved</p>
        <p>Designed & Developed By <a href="https://www.it-ocean.net" target="_blank" class="link-primary">It-Ocean.Net</a></p>
    </div>
</div>
@endsection