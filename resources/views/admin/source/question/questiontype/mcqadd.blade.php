 
<!-- Page Heading -->
<div class='row align-items-center justify-content-between pt-3 mb-3'>
    <div class='col-auto mb-0 h3 text-gray-800'>Add MCQ</div>
</div>    
{{-- @if(session('success'))
    <div class="successAlert">
        {{ session('success') }}
    </div>
@endif --}}
@php
    $Question = DB::table('questions_mcq')->select('*')->where('mcq_id', $q_id)->get();
    $OpptionCount = $Question->first()->mcq_op_count ?? '0';
@endphp
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="container">
                <form action="{{ route('adminEditUMCQOption') }}"  method="POST">
                @csrf
                <div class="row mt-4">
                    <div class="col-md-7 pt-2 h5">Question Setting</div>
                    <div class="col-md-3 mt-2 text-right"><a href='#' class='btn btn-warning btn-sm'><i class="fas fa-exchange-alt fa-sm"></i>&nbsp;&nbsp;Change Exam OR Subsection</a></div>
                    <div class="col-md-2 mt-2 text-right"><a href='#' onclick='window.history.back()' class='btn btn-success btn-sm'><i class="fas fa-backward fa-sm "></i>&nbsp;&nbsp;Back</a></div>
                </div> 
                <div class="row mt-4">
                    <input type="hidden" name="q_id" value="{{$q_id}}">
                    <input type="hidden" name="qt_id" value="{{$qt_id}}">
                    <div class="col-md-2 mt-2">No of Option</div>
                    <div class="col-md-2">
                        <select class="form-select" aria-label="Default select example" name="MCQOptions" onchange="this.form.submit()" >
                            <option value="0">Select Answer</option>
                            @for($i = 1; $i <= 8; $i++)
                                <option value="{{$i}}" @if($OpptionCount == $i) selected @endif>{{$i}}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="col-md-2 mt-2">Exam Year</div>
                    <div class="col-md-3">
                        <select class="form-select" aria-label="Default select example"  name="MCQExamYear" onchange="this.form.submit()" >
                            <option value="0">Select Exam</option>
                            @php
                                $ExamYears = DB::table('examyear')->select('*')->where('ey_status', '1')->get();
                            @endphp
                            @foreach ($ExamYears as $Examyear)
                                @php
                                $ExamYear_ID = $Examyear->ey_id ?? '0';
                                $ExamYearName = $Examyear->ey_name ?? 'No Exam Found';    
                                @endphp
                                <option value="{{ $ExamYear_ID }}" @if($Question->first()->mcq_ey_id == $ExamYear_ID) selected @endif>{{ $ExamYearName }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 mt-2 text-right"></div>
                </div>
                </form>
                <form action="{{ route('adminEditUMCQ') }}"  method="POST">
                @csrf
                    <input type="hidden" name="q_id" value="{{$q_id}}">
                    <input type="hidden" name="qt_id" value="{{$qt_id}}">
                    <input type="hidden" name="OptionCount" value="{{$OpptionCount}}">
                    <div class="row mt-4">
                        <div class="col">
                            <label for="exampleFormControlTextarea1" class="form-label">Question</label>
                            <textarea class="form-control"  rows="5"  name="TextQuestion">{{ strip_tags($Question->first()->mcq_question ?? 'No Question Found') }}</textarea>
                        </div>
                    </div>
                    @for($i = 1; $i <= $OpptionCount; $i++)
                        @php
                            $Alphabet = chr(64 + $i);
                        @endphp
                    <div class="row mt-4">
                        <div class="col">
                            <label for="exampleFormControlTextarea1" class="form-label">Option {{$Alphabet}}</label>
                            <textarea class="form-control"  rows="3" name="TextOption{{$i}}">{{ strip_tags($Question->first()->{"mcq_op_$i"} ?? 'No Option Found') }}</textarea>
                        </div>
                    </div>   
                    @endfor
                    <div class="row mt-4">
                        <div class="col">
                            <label for="exampleFormControlTextarea1" class="form-label">Correct Answer</label>
                            <select class="form-select" aria-label="Default select example" name="TextCorrectAns"  >
                                <option value="0">Select Answer</option>
                                @for($i = 1; $i <= $OpptionCount; $i++)
                                    @php
                                        $Alphabet = chr(64 + $i);
                                    @endphp
                                    <option value="{{$Alphabet}}" @if($Question->first()->mcq_a == $Alphabet) selected @endif>{{$Alphabet}}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col">
                            <label for="exampleFormControlTextarea1" class="form-label">Explanation</label>
                            <textarea class="form-control"  rows="5" name="TextDescription">{{ strip_tags($Question->first()->mcq_d ?? 'No Description Found') }}</textarea>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col">
                            <label for="exampleFormControlTextarea1" class="form-label">Links</label>
                            <textarea class="form-control"  rows="5" name="TextLink">{{ strip_tags($Question->first()->mcq_link ?? 'No Link Found') }}</textarea>
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
    <script type="text/javascript"> CKEDITOR.replace( 'TextOption1', { height:"100", width:"100%", skin : 'kama'});</script>
    <script type="text/javascript"> CKEDITOR.replace( 'TextOption2', { height:"100", width:"100%", skin : 'kama'});</script>
    <script type="text/javascript"> CKEDITOR.replace( 'TextOption3', { height:"100", width:"100%", skin : 'kama'});</script>
    <script type="text/javascript"> CKEDITOR.replace( 'TextOption4', { height:"100", width:"100%", skin : 'kama'});</script>
    <script type="text/javascript"> CKEDITOR.replace( 'TextOption5', { height:"100", width:"100%", skin : 'kama'});</script>
    <script type="text/javascript"> CKEDITOR.replace( 'TextOption6', { height:"100", width:"100%", skin : 'kama'});</script>
    <script type="text/javascript"> CKEDITOR.replace( 'TextOption7', { height:"100", width:"100%", skin : 'kama'});</script>
    <script type="text/javascript"> CKEDITOR.replace( 'TextOption8', { height:"100", width:"100%", skin : 'kama'});</script>
    <script type="text/javascript"> CKEDITOR.replace( 'TextDescription', { height:"180", width:"100%", skin : 'kama'});</script>
    <script type="text/javascript"> CKEDITOR.replace( 'TextLink', { height:"180", width:"100%", skin : 'kama'});</script>
    
 