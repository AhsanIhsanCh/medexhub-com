 
<!-- Page Heading -->
<div class='row align-items-center justify-content-between pt-3 mb-3'>
    <div class='col-auto mb-0 h3 text-gray-800'>Add Flash Card's</div>
</div>    
{{-- @if(session('success'))
    <div class="successAlert">
        {{ session('success') }}
    </div>
@endif --}}
@php
    $Question = DB::table('questions_fc')->select('*')->where('fc_id', $q_id)->get();
    $FcQuestion = $Question->first()->fc_question ?? '0';
    $FcAnswer = $Question->first()->fc_answer ?? '0';
    $FcExplanation = $Question->first()->fc_description ?? '0';
    $FcLink = $Question->first()->fc_link ?? '0';
@endphp
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="container">
                <form action="{{ route('adminEditUFCOption') }}"  method="POST">
                @csrf
                <div class="row mt-4">
                    <div class="col-md-7 pt-2 h5">Question Setting</div>
                    <div class="col-md-3 mt-2 text-right"><a href='#' class='btn btn-warning btn-sm'><i class="fas fa-exchange-alt fa-sm"></i>&nbsp;&nbsp;Change Exam OR Subsection</a></div>
                    <div class="col-md-2 mt-2 text-right"><a href='#' onclick='window.history.back()' class='btn btn-success btn-sm'><i class="fas fa-backward fa-sm "></i>&nbsp;&nbsp;Back</a></div>
                </div> 
                <div class="row mt-4">
                    <input type="hidden" name="q_id" value="{{$q_id}}">
                    <input type="hidden" name="qt_id" value="{{$qt_id}}">
                    
                    <div class="col-md-2 mt-2">Exam Year</div>
                    <div class="col-md-3">
                        <select class="form-select" aria-label="Default select example"  name="FCExamYear" onchange="this.form.submit()" >
                            <option value="0">Select Exam</option>
                            @php
                                $ExamYears = DB::table('examyear')->select('*')->where('ey_status', '1')->get();
                            @endphp
                            @foreach ($ExamYears as $Examyear)
                                @php
                                $ExamYear_ID = $Examyear->ey_id ?? '0';
                                $ExamYearName = $Examyear->ey_name ?? 'No Exam Found';    
                                @endphp
                                <option value="{{ $ExamYear_ID }}" @if($Question->first()->fc_ey_id == $ExamYear_ID) selected @endif>{{ $ExamYearName }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 mt-2 text-right"></div>
                </div>
                </form>
                <form action="{{ route('adminEditUFC') }}"  method="POST">
                @csrf
                    <input type="hidden" name="q_id" value="{{$q_id}}">
                    <input type="hidden" name="qt_id" value="{{$qt_id}}">
                    
                    <div class="row mt-4">
                        <div class="col">
                            <label for="exampleFormControlTextarea1" class="form-label">Question</label>
                            <textarea class="form-control"  rows="5"  name="TextQuestion">{{ strip_tags($FcQuestion) }}</textarea>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col">
                            <label for="exampleFormControlTextarea1" class="form-label">Answer</label>
                            <textarea class="form-control"  rows="5"  name="TextAnswer">{{ strip_tags($FcAnswer) }}</textarea>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col">
                            <label for="exampleFormControlTextarea1" class="form-label">Explanation</label>
                            <textarea class="form-control"  rows="5"  name="TextExplanation">{{ strip_tags($FcExplanation) }}</textarea>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col">
                            <label for="exampleFormControlTextarea1" class="form-label">Link</label>
                            <textarea class="form-control"  rows="5"  name="TextLink">{{ strip_tags($FcLink) }}</textarea>
                        </div>
                    </div>


                    



                    
                 
                    
                    <div class="row mt-4">
                        <div class="col">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                    </form>
                       
            </div>
        </div>
    </div>
    <script type="text/javascript"> CKEDITOR.replace( 'TextQuestion', { height:"180", width:"100%", skin : 'kama'});</script>
    <script type="text/javascript"> CKEDITOR.replace( 'TextAnswer', { height:"100", width:"100%", skin : 'kama'});</script>
    <script type="text/javascript"> CKEDITOR.replace( 'TextExplanation', { height:"100", width:"100%", skin : 'kama'});</script>
    <script type="text/javascript"> CKEDITOR.replace( 'TextLink', { height:"100", width:"100%", skin : 'kama'});</script>
    
    
 