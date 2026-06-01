@php
use Carbon\Carbon; 
$DefaltExamid = "1";   
@endphp
@extends('admin.assets.adminlayout')
@section('content')
    <div class="container-fluid">
<!-- Page Heading -->
<div class='row align-items-center justify-content-between pt-3 mb-3'>
    <div class='col-auto mb-0 h3 text-gray-800'>Exam's</div>
    <div class='col-12 col-xl-auto mb-0'>
        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addExamModal" data-bs-id="{{ $DefaltExamid }}" ><i class='fas fa-clipboard-list fa-sm text-white-50'></i>&nbsp;&nbsp;Add New Exam</button>
    </div>
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
                                        $NewCatName = $ExamString2->first()->e_name;
                                        $CatPathe = $ExamString2->first()->e_id;
                                        if($i == 0)
                                            $String .= "<a href='/adminExams'>".$NewCatName."</a>";
                                        else
                                            $String .= "&nbsp;&nbsp;&nbsp;&nbsp;>>&nbsp;&nbsp;&nbsp;&nbsp;<a href='/adminExamInner/$CatPathe'>".$NewCatName."</a>";
                                    }
                                    echo $String;
                            echo '</div>';
                            echo '<div class="col-2 mb-3">';
                                echo "<button type='button' class='btn btn-success btn-sm' data-bs-toggle='modal' data-bs-target='#addSubExamModal' data-bs-id='".$CatPathe."'><i class='fas fa-clipboard-list fa-sm text-white-50'></i>&nbsp;&nbsp;Add Exam Sub Sections</button>";
                            echo '</div>';
                        echo '</div>';                                    
                    }
            @endphp
            <div class="table-responsive">
                @if($displaytype == "1")
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th style="width: 50px;">Sr #</th>
                            <th>Name</th>
                            <th>Question Type</th>
                            <th>3(M) Price</th>
                            <th>6(M) Price</th>
                            <th>1(Y) Price</th>
                            <th style="width: 150px;">Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Sr #</th>
                            <th>Name</th>
                            <th>Question Type</th>
                            <th>3(M) Price</th>
                            <th>6(M) Price</th>
                            <th>1(Y) Price</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($Exams as $Exam)
                            <tr>
                                <td style='text-align: center;'>{{$loop->iteration}}</td>
                                <td><a href='/adminExamInner/{{ $Exam->e_id }}'>{{$Exam->e_name}}</a></td>
                                <td >
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
            @else
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th style="width: 50px;">Sr #</th>
                            <th>Name</th>
                            <th style="width: 150px;">Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Sr #</th>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($Exams as $Exam)
                            <tr>
                                <td style='text-align: center;'>{{$loop->iteration}}</td>
                                <td><a href='/adminExamInner/{{ $Exam->e_id }}'>{{$Exam->e_name}}</a></td>
                                <td style='text-align:center;'>
                                    <a href='/adminEditExam/{{ $Exam->e_id }}'><i class="fas fa-comment-alt-edit"></i></a>
                                    <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#viewModal{{ $Exam->e_id }}"><i class="fas fa-eye"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
            </div>
        </div>
    </div>
</div>
{{-- Modals --}}
{{-- Add Exam Start --}}
<div class="modal" id="addExamModal"  style="width:500px;height:320px;">
    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Exam</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('adminAddExam') }}"  method="POST" >
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Exam Name</label>
                        <input type="text" class="form-control" id="modalUserName" name="catname">
                    </div>
                    <input type="hidden" name="catinner_id" id="modalCatId">
                    <button type="submit" class="btn btn-success">Add Exam</button>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- Add Exam End --}}
{{-- Add Exam Sub Sections Start --}}
<div class="modal" id="addSubExamModal"  style="width:500px;height:320px;">
    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Exam Sub Sections</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('adminAddExamSubSection') }}"  method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Sub Sections Name</label>
                        <input type="text" class="form-control" id="modalUserName" name="catname">
                    </div>
                    <input type="hidden" name="catinner_id" id="modalSubCatId">
                    <button type="submit" class="btn btn-success">Add Sub Section</button>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- Add Exam Sub Sections End --}}
<script>
const addExamModal = document.getElementById('addExamModal');
addExamModal.addEventListener('show.bs.modal', function (event) {
    const button = event.relatedTarget;
    const catId = button.getAttribute('data-bs-id');
    const inputCatId = addExamModal.querySelector('#modalCatId');
    inputCatId.value = catId;
});
const addSubExamModal = document.getElementById('addSubExamModal');
addSubExamModal.addEventListener('show.bs.modal', function (event) {
    const button = event.relatedTarget;
    const subcatId = button.getAttribute('data-bs-id');
    const inputSubCatId = addSubExamModal.querySelector('#modalSubCatId');
    inputSubCatId.value = subcatId;
});
</script>
@endsection