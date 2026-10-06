@extends('admin.adminlayout')
@section('exams')
<div class="page-wrapper">
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col">
                    <h3 class="page-title">Exams</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">Exams</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->
        <?php
            if($e_id != "0")
                {
                    echo '<div class="card">';
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
                }
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
                                    @foreach ($Exams as $Exam)
                                        <tr>
                                            <td style='text-align: center;'>{{$loop->iteration}}</td>
                                            <td><a href="/admin-innerexams/{{$Exam->e_id}}">{{$Exam->e_name}}</a></td>
                                            <td style='text-align: center;'>
                                                @php
                                                    $Types = explode(';', $Exam->e_qt_id);
                                                    $TypesCount = count($Types);
                                                    $TypeString = "";
                                                    for($i = 0; $i < $TypesCount; $i++)
                                                        {
                                                            $QTs = DB::table('question_type')->select('qt_name')->where('qt_id', $Types[$i])->get();
                                                            if($i != 0 ) $TypeString .= ' , ';
                                                            $TypeString .= $QTs->first()->qt_name ?? 'No Record Found';
                                                            
                                                            
                                                        }
                                                @endphp
                                            {{ $TypeString }}</td>
                                            <td style='text-align: center;'>{{$Exam->e_price3m}}</td>
                                            <td style='text-align: center;'>{{$Exam->e_price6m}}</td>
                                            <td style='text-align: center;'>{{$Exam->e_price1y}}</td>
                                            <td style='text-align:center;'>
                                                <a href='/adminEditExam/{{ $Exam->e_id }}'><i class="fas fa-comment-alt-edit"></i></a>
                                                <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#viewModal{{ $Exam->e_id }}"><i class="fas fa-eye"></i></button>
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