@extends('admin.adminlayout')
@section('mcq')
<div class="page-wrapper">
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col">
                    <h3 class="page-title">MCQ's</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">MCQ's</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->
        <?php
            $e_id = "2";
            echo '<div class="card">';
                echo '<div class="card-header">';
                    echo '<div class="row align-items-center">';
                        echo '<div class="col-auto">';
                            echo '<h5 class="card-title mb-0">Selected Exams</h5>';
                        echo '</div>';
                        echo '<div class="col">';
                            
                        
                        
                        
                            echo '<form action="/admin-mcq/'.$e_id.'" method="POST">';
                                echo '<input type="hidden" name="_token" value="'.csrf_token().'">';
                                echo '<select class="select" style="max-width: 250px !important;" name="examOpption" onchange="this.form.submit()" >';
                                    echo '<option value="0">Select Exam</option>';
                                    $Exams = DB::table('exams')->select('e_id','e_name')->where('e_level', $e_id)->get();
                                    foreach ($Exams as $Exam)
                                        {
                                            $Exam_ID = $Exam->e_id ?? '0';
                                            $ExamName = $Exam->e_name ?? 'No Exam Found';    
                                            echo '<option value="'.$Exam_ID.'">'.$ExamName.'</option>';
                                        }
                                echo '</select>';
                            echo '</form>';











echo '    </div>';
echo '  </div>';
echo '</div>';




                        echo '<div class="card-header">';
                            echo '<h5 class="card-title">Selected Exams</h5>';

                           



                        echo '</div>';
                        echo '<div class="card-body py-2">';
                            echo '<nav aria-label="breadcrumb">';
                                echo '<ol class="breadcrumb breadcrumb-arrow mb-0 py-2">';
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
                                            if($i == 0)
                                                {
                                                    $String = "<a href='/admin-exams'>".$NewCatName."</a>";
                                                    echo "<li class='breadcrumb-item'><a href='#'>$String</a></li>";
                                                }
                                            else
                                                {
                                                    $String = "<a href='/admin-innerexams/$CatPathe'>".$NewCatName."</a>";
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
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table datatable">
                                <thead class="thead-light">
                                    <tr>
                                        <th style="width: 50px;text-align: center;">Sr #</th>
                                        <th>Name</th>
                                        <th style='text-align: center;'>Question Type</th>
                                        <th style='text-align: center;'>3(M) Price</th>
                                        <th style='text-align: center;'>6(M) Price</th>
                                        <th style='text-align: center;'>1(Y) Price</th>
                                        <th style="width: 150px;text-align: center;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($Questions as $Question)
                                        <tr>
                                            <td style='text-align: center;'>{{$loop->iteration}}</td>
                                            <td><a href="/admin-innerexams/{{$loop->iteration}}">{{$loop->iteration}}</a></td>
                                            <td style='text-align: center;'>
                                               
                                            {{ $loop->iteration }}</td>
                                            <td style='text-align: center;'>{{$loop->iteration}}</td>
                                            <td style='text-align: center;'>{{$loop->iteration}}</td>
                                            <td style='text-align: center;'>{{$loop->iteration}}</td>
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