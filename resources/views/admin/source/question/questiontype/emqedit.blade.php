 
<!-- Page Heading -->
<div class='row align-items-center justify-content-between pt-3 mb-3'>
    <div class='col-auto mb-0 h3 text-gray-800'>Edit EMQ's</div>
</div>    
{{-- @if(session('success'))
    <div class="successAlert">
        {{ session('success') }}
    </div>
@endif --}}
@php
    $Question = DB::table('questions_emq')->select('*')->where('emq_id', $q_id)->get();
    $OpptionCount = $Question->first()->emq_op_count ?? '0';
    $QuestionCount = $Question->first()->emq_q_count ?? '0';
@endphp
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="container">
                <form action="{{ route('adminEditUEMQOption') }}"  method="POST">
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
                        <select class="form-select" aria-label="Default select example" name="EMQOptions" onchange="this.form.submit()" >
                            <option value="0">Select Answer</option>
                            @for($i = 1; $i <= 25; $i++)
                                <option value="{{$i}}" @if($OpptionCount == $i) selected @endif>{{$i}}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="col-md-2 mt-2">No of Question</div>
                    <div class="col-md-2">
                        <select class="form-select" aria-label="Default select example" name="EMQQuestion" onchange="this.form.submit()" >
                            <option value="0">Select Answer</option>
                            @for($j = 1; $j <= 10; $j++)
                                <option value="{{$j}}" @if($QuestionCount == $j) selected @endif>{{$j}}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="col-md-2 mt-2">Exam Year</div>
                    <div class="col-md-2">
                        <select class="form-select" aria-label="Default select example"  name="EMQExamYear" onchange="this.form.submit()" >
                            <option value="0">Select Exam</option>
                            @php
                                $ExamYears = DB::table('examyear')->select('*')->where('ey_status', '1')->get();
                            @endphp
                            @foreach ($ExamYears as $Examyear)
                                @php
                                $ExamYear_ID = $Examyear->ey_id ?? '0';
                                $ExamYearName = $Examyear->ey_name ?? 'No Exam Found';    
                                @endphp
                                <option value="{{ $ExamYear_ID }}" @if($Question->first()->emq_ey_id == $ExamYear_ID) selected @endif>{{ $ExamYearName }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                </form>
                <form action="{{ route('adminEditUEMQ') }}"  method="POST">
                @csrf
                    <input type="hidden" name="q_id" value="{{$q_id}}">
                    <input type="hidden" name="qt_id" value="{{$qt_id}}">
                    <input type="hidden" name="OptionCount" value="{{$OpptionCount}}">
                    <input type="hidden" name="QuestionCount" value="{{$QuestionCount}}">
                    <div class="row mt-4">
                        <div class="col">
                            <label for="exampleFormControlTextarea1" class="form-label">Theme</label>
                            <textarea class="form-control"  rows="5"  name="TextTheme">{{ strip_tags($Question->first()->emq_theme ?? 'No Question Found') }}</textarea>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col">
                            <label for="exampleFormControlTextarea1" class="form-label">Reference</label>
                            <textarea class="form-control"  rows="5"  name="TextReference">{{ strip_tags($Question->first()->emq_reference ?? 'No Question Found') }}</textarea>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col">
                            <label for="exampleFormControlTextarea1" class="form-label">Lead In</label>
                            <textarea class="form-control"  rows="5"  name="TextLeadIn">{{ strip_tags($Question->first()->emq_lead_in ?? 'No Question Found') }}</textarea>
                        </div>
                    </div>
                    @for($k = 1; $k <= $OpptionCount; $k++)
                        @php
                            $Alphabet = chr(64 + $k);
                        @endphp
                    <div class="row mt-4">
                        <div class="col">
                            <label for="exampleFormControlTextarea1" class="form-label">Option {{$Alphabet}}</label>
                            <textarea class="form-control"  rows="3" name="TextOption{{$k}}">{{ strip_tags($Question->first()->{"emq_op_$k"} ?? 'No Option Found') }}</textarea>
                        </div>
                    </div>   
                    @endfor
                    @for($l = 1; $l <= $QuestionCount; $l++)
                        @php
                            $Alphabet = chr(64 + $l);
                        @endphp
                        @if ($l % 2)
                            <div class="row" style="background-color: #c7fcff; padding: 10px; border-radius: 15px; margin-top: 20px;">
                        @else
                            <div class="row" style="background-color: #ecfeff; padding: 10px; border-radius: 15px; margin-top: 20px;">

                        @endif
                        <div class="col">
                            <div class="row mt-4">
                                <div class="col">
                                    <label for="exampleFormControlTextarea1" class="form-label">Question No {{$l}}</label>
                                    <textarea class="form-control"  rows="3" name="TextQuestion{{$l}}">{{ strip_tags($Question->first()->{"emq_q_$l"} ?? 'No Option Found') }}</textarea>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col">
                                    <label for="exampleFormControlTextarea1" class="form-label">Correct Answer for Question No {{$l}}</label>
                                    <select class="form-select" aria-label="Default select example" name="TextCorrectAns{{$l}}"  >
                                        <option value="0">Select Answer</option>
                                        @for($m = 1; $m <= $OpptionCount; $m++)
                                            @php
                                                $Alphabet2 = chr(64 + $m);
                                            @endphp
                                            <option value="{{$Alphabet2}}" @if($Question->first()->{"emq_a_$l"} == $Alphabet2) selected @endif>{{$Alphabet2}}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col">
                                    <label for="exampleFormControlTextarea1" class="form-label">Explanation Question No {{$l}}</label>
                                    <textarea class="form-control"  rows="3" name="TextExplanation{{$l}}">{{ strip_tags($Question->first()->{"emq_d_$l"} ?? 'No Option Found') }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endfor
                    <div class="row mt-4">
                        <div class="col">
                            <label for="exampleFormControlTextarea1" class="form-label">Links</label>
                            <textarea class="form-control"  rows="5" name="TextLink">{{ strip_tags($Question->first()->emq_link ?? 'No Link Found') }}</textarea>
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
    <script type="text/javascript"> CKEDITOR.replace( 'TextTheme', { height:"180", width:"100%", skin : 'kama'});</script>
    <script type="text/javascript"> CKEDITOR.replace( 'TextReference', { height:"180", width:"100%", skin : 'kama'});</script>
    <script type="text/javascript"> CKEDITOR.replace( 'TextLeadIn', { height:"180", width:"100%", skin : 'kama'});</script>
    <script type="text/javascript"> CKEDITOR.replace( 'TextOption1', { height:"100", width:"100%", skin : 'kama'});</script>
    <script type="text/javascript"> CKEDITOR.replace( 'TextOption2', { height:"100", width:"100%", skin : 'kama'});</script>
    <script type="text/javascript"> CKEDITOR.replace( 'TextOption3', { height:"100", width:"100%", skin : 'kama'});</script>
    <script type="text/javascript"> CKEDITOR.replace( 'TextOption4', { height:"100", width:"100%", skin : 'kama'});</script>
    <script type="text/javascript"> CKEDITOR.replace( 'TextOption5', { height:"100", width:"100%", skin : 'kama'});</script>
    <script type="text/javascript"> CKEDITOR.replace( 'TextOption6', { height:"100", width:"100%", skin : 'kama'});</script>
    <script type="text/javascript"> CKEDITOR.replace( 'TextOption7', { height:"100", width:"100%", skin : 'kama'});</script>
    <script type="text/javascript"> CKEDITOR.replace( 'TextOption8', { height:"100", width:"100%", skin : 'kama'});</script>
    <script type="text/javascript"> CKEDITOR.replace( 'TextOption9', { height:"100", width:"100%", skin : 'kama'});</script>
    <script type="text/javascript"> CKEDITOR.replace( 'TextOption10', { height:"100", width:"100%", skin : 'kama'});</script>
    <script type="text/javascript"> CKEDITOR.replace( 'TextOption11', { height:"100", width:"100%", skin : 'kama'});</script>
    <script type="text/javascript"> CKEDITOR.replace( 'TextOption12', { height:"100", width:"100%", skin : 'kama'});</script>
    <script type="text/javascript"> CKEDITOR.replace( 'TextOption13', { height:"100", width:"100%", skin : 'kama'});</script>
    <script type="text/javascript"> CKEDITOR.replace( 'TextOption14', { height:"100", width:"100%", skin : 'kama'});</script>
    <script type="text/javascript"> CKEDITOR.replace( 'TextOption15', { height:"100", width:"100%", skin : 'kama'});</script>
    <script type="text/javascript"> CKEDITOR.replace( 'TextOption16', { height:"100", width:"100%", skin : 'kama'});</script>
    <script type="text/javascript"> CKEDITOR.replace( 'TextOption17', { height:"100", width:"100%", skin : 'kama'});</script>
    <script type="text/javascript"> CKEDITOR.replace( 'TextOption18', { height:"100", width:"100%", skin : 'kama'});</script>
    <script type="text/javascript"> CKEDITOR.replace( 'TextOption19', { height:"100", width:"100%", skin : 'kama'});</script>
    <script type="text/javascript"> CKEDITOR.replace( 'TextOption20', { height:"100", width:"100%", skin : 'kama'});</script>
    <script type="text/javascript"> CKEDITOR.replace( 'TextOption21', { height:"100", width:"100%", skin : 'kama'});</script>
    <script type="text/javascript"> CKEDITOR.replace( 'TextOption22', { height:"100", width:"100%", skin : 'kama'});</script>
    <script type="text/javascript"> CKEDITOR.replace( 'TextOption23', { height:"100", width:"100%", skin : 'kama'});</script>
    <script type="text/javascript"> CKEDITOR.replace( 'TextOption24', { height:"100", width:"100%", skin : 'kama'});</script>
    <script type="text/javascript"> CKEDITOR.replace( 'TextOption25', { height:"100", width:"100%", skin : 'kama'});</script>
    <script type="text/javascript"> CKEDITOR.replace( 'TextQuestion1', { height:"180", width:"100%", skin : 'kama'});</script>
    <script type="text/javascript"> CKEDITOR.replace( 'TextQuestion2', { height:"180", width:"100%", skin : 'kama'});</script>
    <script type="text/javascript"> CKEDITOR.replace( 'TextQuestion3', { height:"180", width:"100%", skin : 'kama'});</script>
    <script type="text/javascript"> CKEDITOR.replace( 'TextQuestion4', { height:"180", width:"100%", skin : 'kama'});</script>
    <script type="text/javascript"> CKEDITOR.replace( 'TextQuestion5', { height:"180", width:"100%", skin : 'kama'});</script>
    <script type="text/javascript"> CKEDITOR.replace( 'TextQuestion6', { height:"180", width:"100%", skin : 'kama'});</script>
    <script type="text/javascript"> CKEDITOR.replace( 'TextQuestion7', { height:"180", width:"100%", skin : 'kama'});</script>
    <script type="text/javascript"> CKEDITOR.replace( 'TextQuestion8', { height:"180", width:"100%", skin : 'kama'});</script>
    <script type="text/javascript"> CKEDITOR.replace( 'TextQuestion9', { height:"180", width:"100%", skin : 'kama'});</script>
    <script type="text/javascript"> CKEDITOR.replace( 'TextQuestion10', { height:"180", width:"100%", skin : 'kama'});</script>
    <script type="text/javascript"> CKEDITOR.replace( 'TextExplanation1', { height:"180", width:"100%", skin : 'kama'});</script>
    <script type="text/javascript"> CKEDITOR.replace( 'TextExplanation2', { height:"180", width:"100%", skin : 'kama'});</script>
    <script type="text/javascript"> CKEDITOR.replace( 'TextExplanation3', { height:"180", width:"100%", skin : 'kama'});</script>
    <script type="text/javascript"> CKEDITOR.replace( 'TextExplanation4', { height:"180", width:"100%", skin : 'kama'});</script>
    <script type="text/javascript"> CKEDITOR.replace( 'TextExplanation5', { height:"180", width:"100%", skin : 'kama'});</script>
    <script type="text/javascript"> CKEDITOR.replace( 'TextExplanation6', { height:"180", width:"100%", skin : 'kama'});</script>
    <script type="text/javascript"> CKEDITOR.replace( 'TextExplanation7', { height:"180", width:"100%", skin : 'kama'});</script>
    <script type="text/javascript"> CKEDITOR.replace( 'TextExplanation8', { height:"180", width:"100%", skin : 'kama'});</script>
    <script type="text/javascript"> CKEDITOR.replace( 'TextExplanation9', { height:"180", width:"100%", skin : 'kama'});</script>
    <script type="text/javascript"> CKEDITOR.replace( 'TextExplanation10', { height:"180", width:"100%", skin : 'kama'});</script>
    <script type="text/javascript"> CKEDITOR.replace( 'TextLink', { height:"180", width:"100%", skin : 'kama'});</script>