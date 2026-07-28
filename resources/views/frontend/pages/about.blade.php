	@if(Auth::check())
    	@include('frontend.headerAuth')
	@else
		@include('frontend.header')
	@endif
    <style>
        :root {
  --navy: #17243c;
  --navy-deep: #101a2e;
  --green: #4b9b51;
  --green-dark: #377a3d;
  --green-pale: #edf7ee;
  --gold: #f0b429;
  --rose: #d93273;
  --blue: #5067b2;
  --heading: #19243a;
  --text: #626a79;
  --line: #e7ebf1;
  --surface: #ffffff;
  --surface-alt: #f7f9fc;
  --shadow: 0 20px 55px rgba(20, 31, 51, .11);
  --shadow-soft: 0 10px 32px rgba(20, 31, 51, .07);
  --radius: 16px;
  --container: 1180px;
}

*, *::before, *::after { box-sizing: border-box; }
html { scroll-behavior: smooth; }
body {
  margin: 0;
  font-family: "Avenir Next", "Segoe UI", Arial, sans-serif;
  color: var(--text);
  background: #fff;
  line-height: 1.65;
  -webkit-font-smoothing: antialiased;
}
img { display: block; max-width: 100%; }
a { color: inherit; text-decoration: none; }
button { font: inherit; }
svg { fill: none; stroke: currentColor; stroke-width: 1.8; stroke-linecap: round; stroke-linejoin: round; }
.container { width: min(calc(100% - 40px), var(--container)); margin-inline: auto; }
.section { padding: 96px 0; }

.skip-link {
  position: fixed;
  left: 16px;
  top: -80px;
  z-index: 1000;
  padding: 10px 14px;
  background: #fff;
  color: var(--navy);
  border-radius: 8px;
  box-shadow: var(--shadow-soft);
}
.skip-link:focus { top: 16px; }

.topbar { background: var(--navy-deep); color: rgba(255,255,255,.78); font-size: 13px; }
.topbar-inner { min-height: 43px; display: flex; align-items: center; justify-content: space-between; gap: 24px; }
.topbar p { margin: 0; }
.topbar-links { display: flex; gap: 22px; }
.topbar a:hover { color: #fff; }

.site-header {
  position: sticky;
  top: 0;
  z-index: 100;
  background: rgba(255,255,255,.97);
  border-bottom: 1px solid transparent;
  backdrop-filter: blur(12px);
  transition: box-shadow .25s ease, border-color .25s ease;
}
.site-header.scrolled { border-color: var(--line); box-shadow: 0 10px 30px rgba(17,27,48,.07); }
.header-inner { min-height: 88px; display: grid; grid-template-columns: 210px 1fr auto; align-items: center; gap: 28px; }
.brand img { width: 180px; height: auto; }
.primary-nav { display: flex; justify-content: center; align-items: center; gap: 28px; }
.primary-nav a { position: relative; padding: 31px 0; color: var(--heading); font-size: 15px; font-weight: 750; }
.primary-nav a::after { content: ""; position: absolute; left: 0; bottom: 24px; width: 0; height: 2px; background: var(--green); transition: width .2s ease; }
.primary-nav a:hover, .primary-nav a.active { color: var(--green-dark); }
.primary-nav a:hover::after, .primary-nav a.active::after { width: 100%; }
.header-actions { display: flex; align-items: center; gap: 8px; }
.menu-toggle { display: none; width: 42px; height: 42px; border: 1px solid var(--line); background: #fff; border-radius: 9px; padding: 9px; cursor: pointer; }
.menu-toggle span { display: block; height: 2px; background: var(--heading); margin: 5px 0; }

.btn { min-height: 45px; display: inline-flex; justify-content: center; align-items: center; gap: 8px; padding: 10px 20px; border: 1px solid transparent; border-radius: 7px; font-weight: 800; line-height: 1.2; transition: transform .2s ease, background .2s ease, color .2s ease, border-color .2s ease, box-shadow .2s ease; }
.btn:hover { transform: translateY(-2px); }
.btn-primary { color: #fff; background: var(--green); box-shadow: 0 8px 20px rgba(75,155,81,.22); }
.btn-primary:hover { background: var(--green-dark); }
.btn-ghost { color: var(--heading); background: transparent; }
.btn-ghost:hover { color: var(--green-dark); }
.btn-outline { color: var(--green-dark); border-color: #b9d8bc; background: #fff; }
.btn-outline:hover { border-color: var(--green); background: var(--green-pale); }
.btn-light { color: var(--navy); background: #fff; }
.btn-light:hover { background: #f5f8ff; }
.btn-transparent { color: #fff; border-color: rgba(255,255,255,.5); }
.btn-transparent:hover { background: rgba(255,255,255,.1); border-color: #fff; }

.eyebrow { margin: 0; color: var(--green-dark); font-size: 13px; font-weight: 800; letter-spacing: .16em; text-transform: uppercase; }
.eyebrow.light { color: #bfe4c2; }

.page-hero {
  position: relative;
  overflow: hidden;
  background: linear-gradient(135deg, #f3f8f1 0%, #f8fbff 57%, #f1f3fb 100%);
}
.page-hero::before { content: ""; position: absolute; inset: 0; background-image: radial-gradient(rgba(80,103,178,.12) 1px, transparent 1px); background-size: 24px 24px; mask-image: linear-gradient(to right, #000, transparent 78%); }
.hero-orb { position: absolute; border-radius: 50%; pointer-events: none; }
.hero-orb-one { width: 430px; height: 430px; right: -130px; top: -155px; border: 72px solid rgba(75,155,81,.08); }
.hero-orb-two { width: 210px; height: 210px; right: 31%; bottom: -125px; background: rgba(240,180,41,.09); }
.hero-grid { position: relative; z-index: 2; min-height: 610px; display: grid; grid-template-columns: 1.07fr .93fr; align-items: center; gap: 80px; padding-top: 76px; padding-bottom: 76px; }
.hero-copy-wrap h1 { max-width: 710px; margin: 10px 0 20px; color: var(--heading); font-family: Georgia, "Times New Roman", serif; font-size: clamp(46px, 5.8vw, 72px); line-height: 1.05; letter-spacing: -.035em; }
.hero-copy { max-width: 680px; margin: 0; font-size: 18px; }
.hero-actions { display: flex; gap: 12px; flex-wrap: wrap; margin-top: 30px; }
.breadcrumbs { display: flex; gap: 10px; align-items: center; margin-top: 36px; color: #7a8290; font-size: 14px; font-weight: 700; }
.breadcrumbs a:hover { color: var(--green-dark); }

.hero-panel { position: relative; padding: 30px; border: 1px solid rgba(255,255,255,.85); border-radius: 22px; background: rgba(255,255,255,.86); box-shadow: var(--shadow); backdrop-filter: blur(8px); }
.hero-panel::before { content: ""; position: absolute; inset: -12px 26px auto -12px; height: 100%; z-index: -1; border-radius: 22px; background: linear-gradient(135deg, rgba(75,155,81,.12), rgba(80,103,178,.09)); }
.panel-heading { display: flex; gap: 15px; align-items: center; padding-bottom: 23px; border-bottom: 1px solid var(--line); }
.panel-icon { width: 52px; height: 52px; flex: 0 0 52px; display: grid; place-items: center; border-radius: 13px; color: var(--green-dark); background: var(--green-pale); }
.panel-icon svg { width: 28px; height: 28px; }
.panel-heading p { margin: 0 0 3px; color: #8a919e; font-size: 12px; font-weight: 800; letter-spacing: .08em; text-transform: uppercase; }
.panel-heading strong { display: block; color: var(--heading); font-size: 17px; line-height: 1.35; }
.progress-card { margin-top: 24px; padding: 18px; background: var(--surface-alt); border-radius: 13px; }
.progress-card-top { display: flex; justify-content: space-between; gap: 20px; color: var(--heading); font-size: 14px; font-weight: 800; }
.progress-card-top strong { color: var(--green-dark); }
.progress-track { height: 8px; margin-top: 12px; overflow: hidden; border-radius: 999px; background: #e4e9ef; }
.progress-track span { display: block; width: 72%; height: 100%; border-radius: inherit; background: linear-gradient(90deg, var(--green), #78b77d); }
.mini-stats { display: grid; grid-template-columns: repeat(3,1fr); gap: 10px; margin-top: 13px; }
.mini-stats div { padding: 15px 12px; border: 1px solid var(--line); border-radius: 11px; text-align: center; }
.mini-stats strong, .mini-stats span { display: block; }
.mini-stats strong { color: var(--heading); font-size: 13px; }
.mini-stats span { margin-top: 3px; font-size: 11px; }
.question-preview { margin-top: 13px; padding: 17px 18px; color: rgba(255,255,255,.78); border-radius: 13px; background: var(--navy); }
.question-label { display: flex; justify-content: space-between; gap: 16px; color: #bfe4c2; font-size: 11px; font-weight: 800; letter-spacing: .08em; text-transform: uppercase; }
.question-preview p { margin: 10px 0 0; font-size: 13px; line-height: 1.55; }

.section-heading h2 { margin: 8px 0 0; color: var(--heading); font-family: Georgia, "Times New Roman", serif; font-size: clamp(35px, 4vw, 50px); line-height: 1.16; letter-spacing: -.02em; }
.about-grid { display: grid; grid-template-columns: .85fr 1.15fr; gap: 100px; align-items: start; }
.about-copy { padding-top: 8px; }
.about-copy p { margin: 0 0 18px; }
.about-copy .lead { color: var(--heading); font-size: 22px; line-height: 1.5; }
.text-link { display: inline-flex; align-items: center; gap: 8px; margin-top: 10px; color: var(--green-dark); font-weight: 800; }
.text-link span { transition: transform .2s ease; }
.text-link:hover span { transform: translateX(4px); }

.highlights-section { background: var(--surface-alt); }
.split-heading { display: grid; grid-template-columns: 1fr 420px; align-items: end; gap: 60px; margin-bottom: 42px; }
.split-heading > p { margin: 0; font-size: 17px; }
.highlight-grid { display: grid; grid-template-columns: repeat(4,1fr); gap: 20px; }
.highlight-card { position: relative; min-height: 335px; padding: 28px 25px; overflow: hidden; border: 1px solid var(--line); border-radius: var(--radius); background: #fff; box-shadow: 0 8px 28px rgba(25,36,56,.055); transition: transform .25s ease, box-shadow .25s ease; }
.highlight-card:hover { transform: translateY(-7px); box-shadow: var(--shadow); }
.highlight-card.featured { color: rgba(255,255,255,.76); border-color: var(--navy); background: var(--navy); }
.highlight-card.featured h3 { color: #fff; }
.highlight-card.featured .card-number { color: rgba(255,255,255,.12); }
.highlight-card.featured .card-icon { color: #fff; background: rgba(255,255,255,.1); }
.card-number { position: absolute; right: 18px; top: 5px; color: #eef1f5; font-family: Georgia, "Times New Roman", serif; font-size: 70px; font-weight: 700; line-height: 1; }
.card-icon { width: 56px; height: 56px; display: grid; place-items: center; margin-bottom: 48px; border-radius: 14px; color: var(--green-dark); background: var(--green-pale); }
.card-icon svg { width: 29px; height: 29px; }
.highlight-card h3 { position: relative; margin: 0 0 12px; color: var(--heading); font-size: 20px; line-height: 1.35; }
.highlight-card p { position: relative; margin: 0; font-size: 14px; }

.approach-section { background: linear-gradient(#fff 0 30%, var(--surface-alt) 30% 100%); }
.approach-panel { display: grid; grid-template-columns: 1.05fr .95fr; overflow: hidden; color: rgba(255,255,255,.74); border-radius: 21px; background: var(--navy); box-shadow: var(--shadow); }
.approach-copy { position: relative; padding: 65px; overflow: hidden; }
.approach-copy::after { content: ""; position: absolute; width: 300px; height: 300px; right: -120px; bottom: -135px; border: 58px solid rgba(255,255,255,.045); border-radius: 50%; }
.approach-copy h2 { position: relative; z-index: 1; margin: 9px 0 18px; color: #fff; font-family: Georgia, "Times New Roman", serif; font-size: clamp(34px, 4vw, 48px); line-height: 1.17; }
.approach-copy p { position: relative; z-index: 1; }
.approach-copy .btn { position: relative; z-index: 1; margin-top: 18px; }
.approach-list { display: grid; background: #1d2b46; }
.approach-item { display: grid; grid-template-columns: 48px 1fr; gap: 14px; align-items: start; padding: 32px 34px; border-bottom: 1px solid rgba(255,255,255,.09); }
.approach-item:last-child { border-bottom: 0; }
.approach-item > span { color: #83c889; font-size: 13px; font-weight: 800; letter-spacing: .12em; }
.approach-item h3 { margin: 0 0 7px; color: #fff; font-size: 19px; }
.approach-item p { margin: 0; font-size: 14px; }

.centered-heading { max-width: 760px; margin: 0 auto 43px; text-align: center; }
.centered-heading > p:last-child { margin: 15px auto 0; font-size: 17px; }
.steps-grid { display: grid; grid-template-columns: repeat(3,1fr); gap: 24px; counter-reset: steps; }
.steps-grid article { position: relative; padding: 32px; border: 1px solid var(--line); border-radius: var(--radius); background: #fff; box-shadow: var(--shadow-soft); }
.steps-grid article > span { width: 44px; height: 44px; display: grid; place-items: center; margin-bottom: 27px; border-radius: 50%; color: #fff; background: var(--green); font-weight: 800; }
.steps-grid h3 { margin: 0 0 9px; color: var(--heading); font-size: 20px; }
.steps-grid p { margin: 0; }
.steps-grid article::after { content: ""; position: absolute; top: 53px; right: -25px; width: 25px; height: 1px; background: #cfd6df; }
.steps-grid article:last-child::after { display: none; }

.cta-section { color: #fff; background: linear-gradient(120deg, var(--green-dark), var(--green)); }
.cta-inner { min-height: 278px; display: flex; align-items: center; justify-content: space-between; gap: 50px; padding-top: 48px; padding-bottom: 48px; }
.cta-inner h2 { max-width: 760px; margin: 8px 0 0; font-family: Georgia, "Times New Roman", serif; font-size: clamp(32px, 4vw, 48px); line-height: 1.18; }
.cta-actions { display: flex; gap: 12px; flex-wrap: wrap; }

.site-footer { padding-top: 74px; color: rgba(255,255,255,.65); background: var(--navy-deep); }
.footer-grid { display: grid; grid-template-columns: 1.45fr 1fr 1fr 1fr; gap: 54px; padding-bottom: 58px; }
.footer-logo { width: 185px; margin-bottom: 21px; filter: brightness(0) invert(1); opacity: .92; }
.footer-about p { max-width: 370px; margin: 0; }
.site-footer h2 { margin: 0 0 20px; color: #fff; font-size: 16px; }
.site-footer ul { display: grid; gap: 10px; margin: 0; padding: 0; list-style: none; }
.site-footer li a { transition: color .2s ease, padding-left .2s ease; }
.site-footer li a:hover { padding-left: 4px; color: #fff; }
.footer-bottom { min-height: 76px; display: flex; align-items: center; justify-content: space-between; gap: 20px; border-top: 1px solid rgba(255,255,255,.09); font-size: 13px; }
.footer-bottom p { margin: 0; }
.footer-bottom a { color: #fff; font-weight: 700; }

@media (max-width: 1100px) {
  .header-inner { grid-template-columns: 180px auto 1fr; }
  .brand img { width: 165px; }
  .menu-toggle { display: block; justify-self: end; order: 3; }
  .header-actions { justify-self: end; }
  .primary-nav { display: none; position: absolute; top: 88px; left: 20px; right: 20px; padding: 12px 22px 20px; flex-direction: column; align-items: stretch; gap: 0; background: #fff; border: 1px solid var(--line); border-radius: 12px; box-shadow: var(--shadow); }
  .primary-nav.open { display: flex; }
  .primary-nav a { padding: 13px 0; border-bottom: 1px solid var(--line); }
  .primary-nav a:last-child { border-bottom: 0; }
  .primary-nav a::after { display: none; }
  .hero-grid { gap: 44px; }
  .highlight-grid { grid-template-columns: repeat(2,1fr); }
  .footer-grid { grid-template-columns: 1.3fr 1fr 1fr; }
  .footer-grid > div:last-child { grid-column: 2 / 4; }
}

@media (max-width: 850px) {
  .topbar-inner { justify-content: center; }
  .topbar-links { display: none; }
  .header-inner { min-height: 78px; grid-template-columns: 1fr auto; gap: 14px; }
  .header-actions { display: none; }
  .primary-nav { top: 78px; }
  .hero-grid { min-height: auto; grid-template-columns: 1fr; padding-top: 65px; padding-bottom: 72px; }
  .hero-panel { max-width: 620px; }
  .about-grid, .split-heading, .approach-panel { grid-template-columns: 1fr; }
  .about-grid { gap: 35px; }
  .split-heading { gap: 18px; }
  .approach-copy { padding: 52px; }
  .steps-grid { grid-template-columns: 1fr; }
  .steps-grid article::after { display: none; }
  .cta-inner { align-items: flex-start; flex-direction: column; gap: 27px; }
  .footer-grid { grid-template-columns: 1fr 1fr; }
  .footer-grid > div:last-child { grid-column: auto; }
}

@media (max-width: 600px) {
  .container { width: min(calc(100% - 28px), var(--container)); }
  .section { padding: 70px 0; }
  .topbar { text-align: center; }
  .brand img { width: 150px; }
  .hero-grid { padding-top: 52px; padding-bottom: 58px; }
  .hero-copy-wrap h1 { font-size: clamp(41px, 14vw, 56px); }
  .hero-actions .btn { width: 100%; }
  .hero-panel { padding: 22px; }
  .hero-panel::before { display: none; }
  .mini-stats { grid-template-columns: 1fr; }
  .highlight-grid { grid-template-columns: 1fr; }
  .highlight-card { min-height: 0; }
  .card-icon { margin-bottom: 32px; }
  .approach-copy { padding: 40px 28px; }
  .approach-item { grid-template-columns: 36px 1fr; padding: 28px 24px; }
  .steps-grid article { padding: 27px; }
  .cta-actions, .cta-actions .btn { width: 100%; }
  .footer-grid { grid-template-columns: 1fr; gap: 35px; }
  .footer-bottom { padding: 20px 0; align-items: flex-start; flex-direction: column; }
}

@media (prefers-reduced-motion: reduce) {
  html { scroll-behavior: auto; }
  *, *::before, *::after { animation-duration: .01ms !important; transition-duration: .01ms !important; }
}
    </style>
<main id="main-content">
    <section class="page-hero">
      <div class="hero-orb hero-orb-one"></div>
      <div class="hero-orb hero-orb-two"></div>
      <div class="container hero-grid">
        <div class="hero-copy-wrap">
          <p class="eyebrow">About MedExHub</p>
          <h1>Medical revision resources created by practising doctors.</h1>
          <p class="hero-copy">Relevant, high-quality medical examination questions, explanatory notes and flexible learning tools designed to make exam preparation clearer.</p>
          <div class="hero-actions">
            <a class="btn btn-primary" href="https://www.medexhub.com/index.php?P=7">Explore question banks</a>
            <a class="btn btn-outline" href="https://www.medexhub.com/index.php?D=4&amp;P=4">Contact us</a>
          </div>
          <nav class="breadcrumbs" aria-label="Breadcrumb">
            <a href="https://medextech.com.au/">Home</a>
            <span aria-hidden="true">/</span>
            <span>About us</span>
          </nav>
        </div>

        <div class="hero-panel" aria-label="MedExHub learning features">
          <div class="panel-heading">
            <span class="panel-icon" aria-hidden="true">
              <svg viewBox="0 0 24 24"><path d="M4 5h16v14H4z"/><path d="M8 9h8M8 13h5"/><path d="m15 17 2 2 4-5"/></svg>
            </span>
            <div>
              <p>Built for focused revision</p>
              <strong>Clear learning, one question at a time</strong>
            </div>
          </div>
          <div class="progress-card">
            <div class="progress-card-top">
              <span>Study progress</span>
              <strong>72%</strong>
            </div>
            <div class="progress-track"><span></span></div>
          </div>
          <div class="mini-stats">
            <div><strong>MCQ + EMQ</strong><span>Exam-style practice</span></div>
            <div><strong>Detailed</strong><span>Explanatory notes</span></div>
            <div><strong>Flexible</strong><span>Study and exam modes</span></div>
          </div>
          <div class="question-preview">
            <div class="question-label"><span>Question review</span><span>✓ Explained</span></div>
            <p>Practise clinically relevant questions, review the reasoning and identify areas for further revision.</p>
          </div>
        </div>
      </div>
    </section>

    <section class="about-section section">
      <div class="container about-grid">
        <div class="section-heading">
          <p class="eyebrow">Who we are</p>
          <h2>Experienced clinicians supporting your exam preparation.</h2>
        </div>

        <div class="about-copy">
          <p class="lead">MCQs and EMQs are prepared by practising doctors with extensive experience in medical education.</p>
          <p>We are committed to providing relevant, high-quality questions with explanatory notes that help candidates understand the reasoning behind each answer.</p>
          <p>We are also developing innovative features such as customisable flash cards, quality feedback, external links and statistics. Our content is regularly updated so candidates can access comprehensive exam support in one place.</p>
          <a class="text-link" href="https://www.medexhub.com/index.php?P=7">Put us to the test and explore our revision resources <span aria-hidden="true">→</span></a>
        </div>
      </div>
    </section>

    <section class="highlights-section section" id="highlights">
      <div class="container">
        <div class="section-heading split-heading">
          <div>
            <p class="eyebrow">Highlights</p>
            <h2>A more useful way to test and strengthen your knowledge.</h2>
          </div>
          <p>Every feature is designed to support targeted learning, exam-style practice and a clearer understanding of clinically important concepts.</p>
        </div>

        <div class="highlight-grid">
          <article class="highlight-card featured">
            <span class="card-number">01</span>
            <div class="card-icon" aria-hidden="true">
              <svg viewBox="0 0 24 24"><path d="M5 4h14v16H5z"/><path d="M8 8h8M8 12h8M8 16h5"/><path d="m16 15 2 2 3-4"/></svg>
            </div>
            <h3>Multiple testing modes</h3>
            <p>Test your knowledge in different ways, including flexible Study mode and structured Exam mode.</p>
          </article>

          <article class="highlight-card">
            <span class="card-number">02</span>
            <div class="card-icon" aria-hidden="true">
              <svg viewBox="0 0 24 24"><path d="M4 19V7l8-4 8 4v12"/><path d="M8 19v-6h8v6M9 8h.01M15 8h.01"/></svg>
            </div>
            <h3>Focused, flexible study</h3>
            <p>Select a specific area of the basic sciences or fellowship examination, then compare your performance with your peers.</p>
          </article>

          <article class="highlight-card">
            <span class="card-number">03</span>
            <div class="card-icon" aria-hidden="true">
              <svg viewBox="0 0 24 24"><path d="M3 6h18M5 6v14h14V6"/><path d="m8 14 3 3 5-7"/></svg>
            </div>
            <h3>Curriculum-aligned questions</h3>
            <p>Quality questions reflect the curriculum, thoroughly test your knowledge and help improve examination performance.</p>
          </article>

          <article class="highlight-card">
            <span class="card-number">04</span>
            <div class="card-icon" aria-hidden="true">
              <svg viewBox="0 0 24 24"><path d="M4 5h16v14H4z"/><circle cx="9" cy="10" r="2"/><path d="m6 17 4-4 3 3 2-2 3 3"/></svg>
            </div>
            <h3>Rich explanations and visuals</h3>
            <p>Visually rich content and full explanations support understanding, retention and confident revision.</p>
          </article>
        </div>
      </div>
    </section>

    <section class="approach-section section">
      <div class="container approach-panel">
        <div class="approach-copy">
          <p class="eyebrow light">Our approach</p>
          <h2>Question banks that build understanding—not just recall.</h2>
          <p>MedExHub combines clinically oriented questions, concise explanations and targeted performance feedback so candidates can identify gaps and revise with purpose.</p>
          <a class="btn btn-light" href="https://www.medexhub.com/index.php?P=7">Choose your exam</a>
        </div>

        <div class="approach-list">
          <div class="approach-item">
            <span>01</span>
            <div><h3>Clinician-written</h3><p>Content is prepared by practising doctors experienced in medical education.</p></div>
          </div>
          <div class="approach-item">
            <span>02</span>
            <div><h3>Regularly updated</h3><p>Questions and explanations are reviewed to keep preparation relevant.</p></div>
          </div>
          <div class="approach-item">
            <span>03</span>
            <div><h3>Designed around candidates</h3><p>Flexible study tools let users focus on the subjects that need the most attention.</p></div>
          </div>
        </div>
      </div>
    </section>

    <section class="steps-section section">
      <div class="container">
        <div class="section-heading centered-heading">
          <p class="eyebrow">Start revising</p>
          <h2>Put MedExHub to the test.</h2>
          <p>Choose your exam, create a focused revision session and use detailed explanations to improve your next study block.</p>
        </div>
        <div class="steps-grid">
          <article><span>1</span><h3>Select your exam</h3><p>Choose the question bank or flash-card resource that matches your training pathway.</p></article>
          <article><span>2</span><h3>Build a session</h3><p>Select a subject, question volume and study mode that suits your revision goal.</p></article>
          <article><span>3</span><h3>Review and improve</h3><p>Study the explanations, monitor performance and return to weaker curriculum areas.</p></article>
        </div>
      </div>
    </section>

    <section class="cta-section">
      <div class="container cta-inner">
        <div>
          <p class="eyebrow light">Ready to begin?</p>
          <h2>Find the revision resource that matches your next medical exam.</h2>
        </div>
        <div class="cta-actions">
          <a class="btn btn-light" href="https://www.medexhub.com/index.php?P=7">Browse exams</a>
          <a class="btn btn-transparent" href="https://www.medexhub.com/index.php?D=4&amp;P=4">Contact us</a>
        </div>
      </div>
    </section>
  </main>

    @include('frontend.footer')
	@include('frontend.index_footer')