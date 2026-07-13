<script>
    const mobileToggle = document.getElementById('mobileToggle');
    const navLinks = document.getElementById('navLinks');
    if (mobileToggle && navLinks) {
      mobileToggle.addEventListener('click', () => {
        const open = navLinks.classList.toggle('open');
        mobileToggle.setAttribute('aria-expanded', String(open));
      });
      navLinks.querySelectorAll('a').forEach(link => link.addEventListener('click', () => {
        navLinks.classList.remove('open');
        mobileToggle.setAttribute('aria-expanded', 'false');
      }));
    }

    const filterButtons = document.querySelectorAll('.filter-btn');
    const examCards = document.querySelectorAll('.exam-card');
    filterButtons.forEach(button => button.addEventListener('click', () => {
      filterButtons.forEach(btn => btn.classList.remove('active'));
      button.classList.add('active');
      const filter = button.dataset.filter;
      examCards.forEach(card => {
        const categories = card.dataset.category.split(' ');
        card.classList.toggle('hidden', filter !== 'all' && !categories.includes(filter));
      });
    }));

    const demoAnswers = Array.from(document.querySelectorAll('.exam-demo-answer'));
    const demoSubmit = document.getElementById('demoSubmit');
    const demoClear = document.getElementById('demoClear');
    const demoFeedback = document.getElementById('demoFeedback');
    const demoDiscussionBtn = document.getElementById('demoDiscussionBtn');
    const demoDiscussion = document.getElementById('demoDiscussion');
    const demoAnsweredCount = document.getElementById('demoAnsweredCount');
    const demoRemainingCount = document.getElementById('demoRemainingCount');
    const demoProgressPercent = document.getElementById('demoProgressPercent');
    let selectedDemoAnswer = null;
    let demoSubmitted = false;

    function resetDemoQuestion() {
      selectedDemoAnswer = null;
      demoSubmitted = false;
      demoAnswers.forEach(answer => {
        answer.disabled = false;
        answer.classList.remove('selected', 'correct', 'incorrect');
      });
      demoSubmit.disabled = true;
      demoSubmit.textContent = 'Submit answer';
      demoFeedback.className = 'exam-demo-feedback';
      demoFeedback.textContent = '';
      demoDiscussionBtn.hidden = true;
      demoDiscussion.hidden = true;
      demoAnsweredCount.textContent = '2';
      demoRemainingCount.textContent = '8';
      demoProgressPercent.textContent = '20%';
    }

    demoAnswers.forEach(answer => answer.addEventListener('click', () => {
      if (demoSubmitted) return;
      selectedDemoAnswer = answer;
      demoAnswers.forEach(item => item.classList.remove('selected'));
      answer.classList.add('selected');
      demoSubmit.disabled = false;
    }));

    demoSubmit.addEventListener('click', () => {
      if (!selectedDemoAnswer || demoSubmitted) return;
      demoSubmitted = true;
      const correct = selectedDemoAnswer.dataset.correct === 'true';
      demoAnswers.forEach(answer => {
        answer.disabled = true;
        if (answer.dataset.correct === 'true') answer.classList.add('correct');
      });
      if (!correct) selectedDemoAnswer.classList.add('incorrect');
      demoFeedback.className = `exam-demo-feedback show ${correct ? 'success' : 'error'}`;
      demoFeedback.textContent = correct
        ? 'Correct. A prion is an abnormally folded infectious protein that contains no nucleic acid and propagates by inducing abnormal folding in normal proteins.'
        : 'Incorrect. The correct answer is Prion. The stem describes an infectious protein with no bacterial DNA or viral RNA.';
      demoSubmit.textContent = 'Answer submitted';
      demoSubmit.disabled = true;
      demoDiscussionBtn.hidden = false;
      demoAnsweredCount.textContent = '3';
      demoRemainingCount.textContent = '7';
      demoProgressPercent.textContent = '30%';
    });

    demoClear.addEventListener('click', resetDemoQuestion);
    demoDiscussionBtn.addEventListener('click', () => {
      demoDiscussion.hidden = !demoDiscussion.hidden;
      demoDiscussionBtn.textContent = demoDiscussion.hidden ? 'Discussion' : 'Hide discussion';
    });

    let seconds = 357;
    const timerText = document.getElementById('timerText');
    setInterval(() => {
      if (!timerText) return;
      if (seconds > 0) seconds--;
      const min = String(Math.floor(seconds / 60)).padStart(2, '0');
      const sec = String(seconds % 60).padStart(2, '0');
      timerText.textContent = `${min}:${sec}`;
    }, 1000);
  </script>
</body>
</html>