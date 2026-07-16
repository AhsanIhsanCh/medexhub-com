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


<section class="content-panel">
    <div class="title-row">
        <div>
            <span class="title-kicker">Exam dashboard</span>
            <h1>ACEM Primary Examination</h1>
            <p class="title-subtitle">Prepare with structure, revise with purpose, and track every step of your exam journey.</p>
        </div>
        <div class="db-actions">
            <a href="/createnew/2" class=" btn db-btn btn-sm">< Back</a>
        </div>
    </div>
     


      <div class="exam-builder" aria-label="Exam setup">
        <div class="exam-builder-grid">
          <div class="curriculum-panel" aria-label="Select curriculum">
            <h3>Select Curriculum</h3>
            <p class="curriculum-note">
              To focus on a specific subsection, select that subsection only.<br />
              Selecting a parent curriculum area, such as Anatomy, will include questions from all of its subsections.
            </p>

            <button
              type="button"
              class="curriculum-group-title"
              id="acemPrimaryToggle"
              aria-expanded="true"
              aria-controls="acemPrimaryTree"
              onclick="toggleAcemPrimarySection()"
            >
              <span>ACEM Primary Examination</span>
              <span class="caret" id="acemPrimaryCaret" aria-hidden="true">▲</span>
            </button>

            <div class="tree-list" id="acemPrimaryTree">
              <div class="tree-row parent">
                <label class="tree-label"><input type="checkbox" class="curriculum-check" /> <span>Anatomy</span></label>
                <button
                  type="button"
                  class="subsection-toggle"
                  aria-expanded="true"
                  aria-controls="anatomyChildren"
                  onclick="toggleCurriculumSubsection(this, 'anatomyChildren', 'anatomyCaret')"
                  aria-label="Open or close Anatomy subsections"
                >
                  <span class="caret" id="anatomyCaret" aria-hidden="true">▲</span>
                </button>
              </div>
              <div class="subsection-list" id="anatomyChildren">
                <div class="tree-row child">
                  <label class="tree-label"><input type="checkbox" class="curriculum-check" /> <span>Upper Limb</span></label>
                  <span class="caret" aria-hidden="true">▼</span>
                </div>
                <div class="tree-row child">
                  <label class="tree-label"><input type="checkbox" class="curriculum-check" /> <span>Lower Limb</span></label>
                  <span class="caret" aria-hidden="true">▼</span>
                </div>
                <div class="tree-row child">
                  <label class="tree-label"><input type="checkbox" class="curriculum-check" /> <span>Thorax</span></label>
                  <span class="caret" aria-hidden="true">▼</span>
                </div>
                <div class="tree-row child">
                  <label class="tree-label"><input type="checkbox" class="curriculum-check" /> <span>Abdomen and Pelvis</span></label>
                  <span class="caret" aria-hidden="true">▼</span>
                </div>
                <div class="tree-row child">
                  <label class="tree-label"><input type="checkbox" class="curriculum-check" /> <span>Head and Neck</span></label>
                  <span class="caret" aria-hidden="true">▼</span>
                </div>
                <div class="tree-row child">
                  <label class="tree-label"><input type="checkbox" class="curriculum-check" /> <span>General Anatomy</span></label>
                  <span class="caret" aria-hidden="true">▼</span>
                </div>
              </div>

              <div class="tree-row parent">
                <label class="tree-label"><input type="checkbox" class="curriculum-check" /> <span>Physiology</span></label>
                <button
                  type="button"
                  class="subsection-toggle"
                  aria-expanded="true"
                  aria-controls="physiologyChildren"
                  onclick="toggleCurriculumSubsection(this, 'physiologyChildren', 'physiologyCaret')"
                  aria-label="Open or close Physiology subsections"
                >
                  <span class="caret" id="physiologyCaret" aria-hidden="true">▲</span>
                </button>
              </div>
              <div class="subsection-list" id="physiologyChildren">
                <div class="tree-row child">
                  <label class="tree-label"><input type="checkbox" class="curriculum-check" /> <span>Blood as a Circulatory Fluid &amp; Lymph Flow</span></label>
                  <span class="caret" aria-hidden="true">▼</span>
                </div>
                <div class="tree-row child">
                  <label class="tree-label"><input type="checkbox" class="curriculum-check" /> <span>Cardiovascular Physiology</span></label>
                  <span class="caret" aria-hidden="true">▼</span>
                </div>
                <div class="tree-row child">
                  <label class="tree-label"><input type="checkbox" class="curriculum-check" /> <span>Gastrointestinal Physiology</span></label>
                  <span class="caret" aria-hidden="true">▼</span>
                </div>
                <div class="tree-row child">
                  <label class="tree-label"><input type="checkbox" class="curriculum-check" /> <span>Nerve, Muscle and Cellular Physiology</span></label>
                  <span class="caret" aria-hidden="true">▼</span>
                </div>
                <div class="tree-row child">
                  <label class="tree-label"><input type="checkbox" class="curriculum-check" /> <span>Central &amp; Peripheral Neurophysiology</span></label>
                  <span class="caret" aria-hidden="true">▼</span>
                </div>
                <div class="tree-row child">
                  <label class="tree-label"><input type="checkbox" class="curriculum-check" /> <span>Endocrine Physiology</span></label>
                  <span class="caret" aria-hidden="true">▼</span>
                </div>
                <div class="tree-row child">
                  <label class="tree-label"><input type="checkbox" class="curriculum-check" /> <span>Respiratory Physiology</span></label>
                  <span class="caret" aria-hidden="true">▼</span>
                </div>
                <div class="tree-row child">
                  <label class="tree-label"><input type="checkbox" class="curriculum-check" /> <span>Renal Physiology</span></label>
                  <span class="caret" aria-hidden="true">▼</span>
                </div>
                <div class="tree-row child">
                  <label class="tree-label"><input type="checkbox" class="curriculum-check" /> <span>Acid Base Physiology</span></label>
                  <span class="caret" aria-hidden="true">▼</span>
                </div>
                <div class="tree-row child">
                  <label class="tree-label"><input type="checkbox" class="curriculum-check" /> <span>Circulation and Homeostasis</span></label>
                  <span class="caret" aria-hidden="true">▼</span>
                </div>
              </div>

              <div class="tree-row parent">
                <label class="tree-label"><input type="checkbox" class="curriculum-check" /> <span>Pathology</span></label>
                <span class="caret" aria-hidden="true">▼</span>
              </div>
              <div class="tree-row parent">
                <label class="tree-label"><input type="checkbox" class="curriculum-check" /> <span>Pharmacology</span></label>
                <span class="caret" aria-hidden="true">▼</span>
              </div>
              <div class="tree-row plain">
                <span>AMC MCQs</span>
                <span class="caret" aria-hidden="true">▲</span>
              </div>
            </div>
          </div>

          <div class="setup-stack" aria-label="Exam options">
            
          
            <div class="setup-panel">
              <h3>Select Mode</h3>
              <div class="option-row" role="radiogroup" aria-label="Select mode">
                <label class="option-label"><input type="radio" name="examMode" value="exam" /> <span>Exam Mode</span></label>
                <label class="option-label"><input type="radio" name="examMode" value="revision" /> <span>Revision Mode</span></label>
              </div>
            </div>

            <div class="setup-panel compact">
              <h3>Select Question Type</h3>
              <div class="option-row" aria-label="Select question type">
                <label class="option-label"><input type="checkbox" name="questionType" value="mcq" /> <span>MCQ's</span></label>
                <label class="option-label"><input type="checkbox" name="questionType" value="emq" /> <span>EMQ's</span></label>
              </div>
            </div>

            <div class="setup-panel">
              <h3>Question Reviewed</h3>
              <div class="option-row" role="radiogroup" aria-label="Question reviewed">
                <label class="option-label"><input type="radio" name="reviewStatus" value="reviewed" /> <span>Reviewed earlier</span></label>
                <label class="option-label"><input type="radio" name="reviewStatus" value="not-reviewed" /> <span>Not reviewed yet</span></label>
              </div>
            </div>

            <div class="setup-panel" id="questionCountPanel">
              <h3>Select Number of Questions</h3>
              <p class="helper-text" id="questionCountHint">Please select curriculum first.</p>
              <div class="question-count-options" id="questionCountOptions" aria-label="Select number of questions">
                <button class="count-choice" type="button">10</button>
                <button class="count-choice" type="button">20</button>
                <button class="count-choice" type="button">30</button>
                <button class="count-choice" type="button">50</button>
                <button class="count-choice" type="button">100</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    
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