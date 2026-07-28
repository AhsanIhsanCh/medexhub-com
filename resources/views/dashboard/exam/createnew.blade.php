@php
use Carbon\Carbon;    
@endphp
@extends('dashboard.layoutDashboard')
@section('createnew')
  @php
      $Checkvalue = "0";
      $Exam = DB::table('exams')->select('e_name','e_qt_id')->where('e_id', $e_id)->get();
      $ExamName = $Exam->first()->e_name ?? 'No Category Found';
      $ExamTypeId = $Exam->first()->e_qt_id ?? 'No Qt Id Found';
  @endphp
  <section class="content-panel">
    <div class="title-row">
      <div>
        <span class="title-kicker">Exam dashboard</span>
        <h1>{{$ExamName}}</h1>
        <p class="title-subtitle">Prepare with structure, revise with purpose, and track every step of your exam journey.</p>
      </div>
      <div class="db-actions">
          <a href="/createnew/2" class=" btn db-btn btn-sm">< Back</a>
      </div>
    </div>
    <form method="POST" action="{{ route('makeexam') }}">
    @csrf
      <div class="exam-builder" aria-label="Exam setup">
        <div class="exam-builder-grid">
          <div class="curriculum-panel" aria-label="Select curriculum">
            <h3>Select Curriculum</h3>
            <p class="curriculum-note">
              To focus on a specific subsection, select that subsection only.<br />
              Selecting a parent curriculum area, such as Anatomy, will include questions from all of its subsections.
            </p>
            @php
            $Category = DB::table('exams')->select('e_id','e_name','e_inner_level')->where('e_id', $e_id)->get();
            echo "<div class='examtree'>";
              echo "<ul>";
                echo "<li>";
                  echo "<details>";
                    echo "<summary class='bgone'><input type='checkbox' class='curriculum-check' name='TopicSelection[]' value='".$Category->first()->e_inner_level."' >&nbsp;&nbsp;".$Category->first()->e_name."</summary>";
                    $CLevel1 = DB::table('exams')->select('e_id','e_name','e_inner_level')->where('e_level', $Category->first()->e_id)->where('e_status', '1')->get();
                    foreach ($CLevel1 as $Level1) 
                      {
                        echo "<ul>";
                          echo "<li>";
                            echo "<details>";
                              echo "<summary class='bgtwo'><input type='checkbox' class='curriculum-check' name='TopicSelection[]' value='".$Level1->e_inner_level."' >&nbsp;&nbsp;".$Level1->e_name."</summary>";
                              $CLevel2 = DB::table('exams')->select('e_id','e_name','e_inner_level')->where('e_level', $Level1->e_id)->where('e_status', '1')->get();
                              foreach ($CLevel2 as $Level2)
                                {
                                  echo "<ul>";
                                    echo "<li>";
                                      echo "<details>";
                                        echo "<summary><input type='checkbox' class='curriculum-check' name='TopicSelection[]' value='".$Level2->e_inner_level."' >&nbsp;&nbsp;".$Level2->e_name."</summary>";
                                        $CLevel3 = DB::table('exams')->select('e_id','e_name','e_inner_level')->where('e_level', $Level2->e_id)->where('e_status', '1')->get();
                                        foreach ($CLevel3 as $Level3) 
                                          {
                                            echo "<ul>";
                                              echo "<li>";
                                                echo "<details>";
                                                  echo "<summary><input type='checkbox' class='curriculum-check' name='TopicSelection[]' value='".$Level3->e_inner_level."' >&nbsp;&nbsp;".$Level3->e_name."</summary>";
                                                  $CLevel4 = DB::table('exams')->select('e_id','e_name','e_inner_level')->where('e_level', $Level3->e_id)->where('e_status', '1')->get();
                                                  foreach ($CLevel4 as $Level4) 
                                                    {
                                                      echo "<ul>";
                                                        echo "<li>";
                                                          echo "<details>";
                                                            echo "<summary><input type='checkbox' class='curriculum-check' name='TopicSelection[]' value='".$Level4->e_inner_level."' >&nbsp;&nbsp;".$Level4->e_name."</summary>";
                                                            $CLevel5 = DB::table('exams')->select('e_id','e_name','e_inner_level')->where('e_level', $Level4->e_id)->where('e_status', '1')->get();
                                                            foreach ($CLevel5 as $Level5) 
                                                              {
                                                                echo "<ul>";
                                                                  echo "<li>";
                                                                    echo "<details>";
                                                                      echo "<summary><input type='checkbox' class='curriculum-check' name='TopicSelection[]' value='".$Level5->e_inner_level."' >&nbsp;&nbsp;".$Level5->e_name."</summary>";
                                                                      $CLevel6 = DB::table('exams')->select('e_id','e_name','e_inner_level')->where('e_level', $Level5->e_id)->where('e_status', '1')->get();
                                                                      foreach ($CLevel6 as $Level6)
                                                                        {
                                                                          echo "<ul>";
                                                                            echo "<li>";
                                                                              echo "<details>";
                                                                                echo "<summary><input type='checkbox' class='curriculum-check' name='TopicSelection[]' value='".$Level6->e_inner_level."' >&nbsp;&nbsp;".$Level6->e_name."</summary>";
                                                                                $CLevel7 = DB::table('exams')->select('e_id','e_name','e_inner_level')->where('e_level', $Level6->e_id)->where('e_status', '1')->get();
                                                                                foreach ($CLevel7 as $Level7)
                                                                                  {
                                                                                    echo "<ul>";
                                                                                      echo "<li>";
                                                                                        echo "<details>";
                                                                                          echo "<summary><input type='checkbox' class='curriculum-check' name='TopicSelection[]' value='".$Level7->e_inner_level."' >&nbsp;&nbsp;".$Level7->e_name."</summary>";
                                                                                        echo "</details>";
                                                                                      echo "</li>";
                                                                                    echo "</ul>";
                                                                                  }
                                                                              echo "</details>";
                                                                            echo "</li>";
                                                                          echo "</ul>";
                                                                        }
                                                                    echo "</details>";
                                                                  echo "</li>";
                                                                echo "</ul>";
                                                              }
                                                          echo "</details>";
                                                        echo "</li>";
                                                      echo "</ul>";
                                                    }
                                                echo "</details>";
                                              echo "</li>";
                                            echo "</ul>";
                                          }
                                      echo "</details>";
                                    echo "</li>";
                                  echo "</ul>";
                                }
                            echo "</details>";
                          echo "</li>";
                        echo "</ul>";
                      }
                  echo "</details>";
                echo "</li>";
              echo "</ul>";
            echo "</div>";
            @endphp
          </div>
          <div class="setup-stack" aria-label="Exam options">
            <div class="setup-panel">
              <h3>Select Mode</h3>
              <div class="option-row" role="radiogroup" aria-label="Select mode">
                @if($ExamTypeId == 3)
                  <input type="hidden" name="Mode" value="2"> 
                @else
                  <label class="option-label"><input type="radio" name="Mode" value="1" /> <span>Exam Mode</span></label>
                  <label class="option-label"><input type="radio" name="Mode" value="2" /> <span>Revision Mode</span></label>
                @endif
              </div>
            </div>
            <div class="setup-panel ">
              <h3>Select Question Type</h3>
              <div class="option-row" aria-label="Select question type">
                @if (!empty($ExamTypeId))
                  @foreach(explode(';', $ExamTypeId) as $QTypeId)
                    @php
                      $QT = DB::table('question_type')->select('qt_name')->where('qt_id', $QTypeId)->get();
                      $QTName = $QT->first()->qt_name ?? 'No Category Found';    
                    @endphp
                    @if($loop->first)
                      <label class="option-label"><input type="checkbox" name="QueType[]" value="{{ $QTypeId }}" /> <span>{{ $QTName }}</span></label>
                    @else
                      <label class="option-label"><input type="checkbox" name="QueType[]" value="{{ $QTypeId }}" /> <span>{{ $QTName }}</span></label>
                    @endif
                  @endforeach
                @endif
              </div>
            </div>
            <div class="setup-panel">
              <h3>Question Reviewed</h3>
              <div class="option-row" role="radiogroup" aria-label="Question reviewed">
                <label class="option-label"><input type="radio" name="Reviewed" value="1" /> <span>Reviewed earlier</span></label>
                <label class="option-label"><input type="radio" name="Reviewed" value="2" /> <span>Not reviewed yet</span></label>
              </div>
            </div>
            <div class="setup-panel">
              <h3>Select Number of Questions</h3>
              <p class="helper-text" id="questionCountHint">Please select curriculum first.</p>
              <div class="question-count-options" id="questionCountOptions" aria-label="Select number of questions">
                <label class="option-label" style="max-width:70px;"><input type="radio" name="NoOfQue" value="10" /> <span>10</span></label>
                <label class="option-label" style="max-width:70px;"><input type="radio" name="NoOfQue" value="20" /> <span>20</span></label>
                <label class="option-label" style="max-width:70px;"><input type="radio" name="NoOfQue" value="30" /> <span>30</span></label>
                <label class="option-label" style="max-width:70px;"><input type="radio" name="NoOfQue" value="40" /> <span>40</span></label>
                <label class="option-label" style="max-width:70px;"><input type="radio" name="NoOfQue" value="50" /> <span>50</span></label>
                <label class="option-label" style="max-width:70px;"><input type="radio" name="NoOfQue" value="60" /> <span>60</span></label>
              </div>
            </div>
          </div>
        </div>
        <div class="row mt-4">
          <div class="col-md-12" style="text-align: center;">
            <input type="hidden" name="e_id" value="{{ $e_id }}">
            
            <button type="submit" class="btn btn-dashboard btn-sm">Generate</button>
          </div>
        </div>
      </div>
    </form>
  </section>





    <script>
    const curriculumChecks = Array.from(document.querySelectorAll('.curriculum-check'));
    const questionCountHint = document.getElementById('questionCountHint');
    const questionCountOptions = document.getElementById('questionCountOptions');
    const countChoices = Array.from(document.querySelectorAll('.count-choice'));

    function updateQuestionCountPanel() {
      const hasCurriculum = curriculumChecks.some(input => input.checked);
      questionCountHint.style.display = hasCurriculum ? 'none' : '';
      questionCountOptions.classList.toggle('visible', hasCurriculum);
    }

    function toggleAcemPrimarySection() {
      const toggleButton = document.getElementById('acemPrimaryToggle');
      const section = document.getElementById('acemPrimaryTree');
      const caret = document.getElementById('acemPrimaryCaret');
      const isOpen = toggleButton.getAttribute('aria-expanded') === 'true';

      toggleButton.setAttribute('aria-expanded', String(!isOpen));
      section.hidden = isOpen;
      caret.textContent = isOpen ? '▼' : '▲';
    }

    function toggleCurriculumSubsection(toggleButton, subsectionId, caretId) {
      const subsection = document.getElementById(subsectionId);
      const caret = document.getElementById(caretId);
      const isOpen = toggleButton.getAttribute('aria-expanded') === 'true';

      toggleButton.setAttribute('aria-expanded', String(!isOpen));
      subsection.hidden = isOpen;
      caret.textContent = isOpen ? '▼' : '▲';
    }

    curriculumChecks.forEach(input => input.addEventListener('change', updateQuestionCountPanel));
    countChoices.forEach(button => {
      button.addEventListener('click', () => {
        countChoices.forEach(choice => choice.classList.remove('selected'));
        button.classList.add('selected');
      });
    });
  </script>
@endsection