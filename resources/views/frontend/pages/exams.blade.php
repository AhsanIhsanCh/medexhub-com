	@if(Auth::check())
    	@include('frontend.headerAuth')
	@else
		@include('frontend.header')
	@endif
    <style>
                :root {
        --navy: #17243c;
        --navy-deep: #111b30;
        --green: #4b9b51;
        --green-dark: #377a3d;
        --green-pale: #edf7ee;
        --gold: #f0b429;
        --rose: #d93273;
        --blue: #5067b2;
        --text: #5d6575;
        --heading: #1a2438;
        --line: #e8ebf1;
        --surface: #ffffff;
        --surface-alt: #f7f9fc;
        --shadow: 0 16px 45px rgba(25, 36, 56, .10);
        --shadow-soft: 0 8px 28px rgba(25, 36, 56, .07);
        --radius: 14px;
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
        button, input, select, textarea { font: inherit; }
        svg { fill: none; stroke: currentColor; stroke-width: 1.8; stroke-linecap: round; stroke-linejoin: round; }
        .container { width: min(calc(100% - 40px), var(--container)); margin: 0 auto; }
        .narrow-container { width: min(calc(100% - 40px), 980px); }
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

        .topbar { background: var(--navy-deep); color: rgba(255,255,255,.82); font-size: 13px; }
        .topbar-inner { min-height: 43px; display: flex; align-items: center; justify-content: space-between; gap: 20px; }
        .topbar a { transition: color .2s ease; }
        .topbar a:hover { color: #fff; }
        .topbar-email { display: inline-flex; align-items: center; gap: 8px; white-space: nowrap; }
        .topbar-email svg { width: 16px; height: 16px; }
        .topbar-promo { display: inline-flex; align-items: center; gap: 8px; text-align: right; }

        .site-header { position: sticky; top: 0; z-index: 100; background: rgba(255,255,255,.97); border-bottom: 1px solid transparent; transition: box-shadow .25s ease, border-color .25s ease; backdrop-filter: blur(12px); }
        .site-header.scrolled { border-color: var(--line); box-shadow: 0 10px 30px rgba(17,27,48,.07); }
        .header-inner { min-height: 88px; display: grid; grid-template-columns: 210px 1fr auto; align-items: center; gap: 28px; }
        .brand img { width: 180px; height: auto; }
        .primary-nav { display: flex; justify-content: center; align-items: center; gap: 30px; }
        .primary-nav a { color: var(--heading); font-weight: 700; font-size: 15px; position: relative; padding: 31px 0; }
        .primary-nav a::after { content: ""; position: absolute; left: 0; bottom: 24px; width: 0; height: 2px; background: var(--green); transition: width .2s ease; }
        .primary-nav a:hover::after, .primary-nav a.active::after { width: 100%; }
        .primary-nav a:hover, .primary-nav a.active { color: var(--green-dark); }
        .header-actions { display: flex; align-items: center; gap: 10px; }
        .menu-toggle { display: none; width: 42px; height: 42px; border: 1px solid var(--line); background: #fff; border-radius: 9px; padding: 9px; cursor: pointer; }
        .menu-toggle span { display: block; height: 2px; background: var(--heading); margin: 5px 0; transition: transform .2s ease, opacity .2s ease; }

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

        .page-hero { min-height: 390px; position: relative; overflow: hidden; background: linear-gradient(135deg, #f3f8f1 0%, #f8fbff 55%, #f3f4fb 100%); display: flex; align-items: center; }
        .page-hero::before { content: ""; position: absolute; inset: 0; background-image: radial-gradient(rgba(80,103,178,.13) 1px, transparent 1px); background-size: 24px 24px; mask-image: linear-gradient(to right, #000, transparent 75%); }
        .page-hero-content { position: relative; z-index: 2; padding: 70px 0; }
        .page-hero h1 { margin: 8px 0 14px; max-width: 700px; color: var(--heading); font-family: Georgia, "Times New Roman", serif; font-size: clamp(46px, 7vw, 76px); line-height: 1.06; letter-spacing: -.025em; }
        .hero-copy { max-width: 680px; margin: 0 0 22px; font-size: 18px; }
        .eyebrow { margin: 0; color: var(--green-dark); font-size: 13px; font-weight: 800; letter-spacing: .16em; text-transform: uppercase; }
        .eyebrow.light { color: #bfe4c2; }
        .breadcrumbs { display: flex; gap: 10px; align-items: center; color: #767e8d; font-size: 14px; font-weight: 700; }
        .breadcrumbs a:hover { color: var(--green-dark); }
        .page-hero-shape { position: absolute; border-radius: 50%; filter: blur(.1px); }
        .shape-one { width: 420px; height: 420px; right: -100px; top: -150px; border: 70px solid rgba(75,155,81,.08); }
        .shape-two { width: 200px; height: 200px; right: 22%; bottom: -100px; background: rgba(240,180,41,.09); }

        .section-heading h2 { margin: 7px 0 0; color: var(--heading); font-family: Georgia, "Times New Roman", serif; font-size: clamp(34px, 4vw, 50px); line-height: 1.16; }
        .split-heading { display: grid; grid-template-columns: 1fr 420px; align-items: end; gap: 60px; margin-bottom: 36px; }
        .split-heading > p { margin: 0; font-size: 17px; }
        .centered-heading { max-width: 730px; margin: 0 auto 42px; text-align: center; }
        .centered-heading > p:last-child { margin: 14px auto 0; font-size: 17px; }

        .filter-row { display: flex; gap: 10px; flex-wrap: wrap; margin-bottom: 32px; }
        .filter-button { border: 1px solid var(--line); border-radius: 999px; background: #fff; color: #687082; padding: 9px 17px; font-size: 14px; font-weight: 800; cursor: pointer; transition: background .2s ease, color .2s ease, border-color .2s ease; }
        .filter-button:hover, .filter-button.active { color: #fff; background: var(--green); border-color: var(--green); }

        .course-grid { display: grid; grid-template-columns: repeat(3, minmax(0,1fr)); gap: 28px; }
        .course-card { background: #fff; border: 1px solid var(--line); border-radius: var(--radius); overflow: hidden; box-shadow: var(--shadow-soft); transition: transform .25s ease, box-shadow .25s ease; }
        .course-card:hover { transform: translateY(-7px); box-shadow: var(--shadow); }
        .course-card.is-hidden { display: none; }
        .course-image { display: block; position: relative; height: 220px; overflow: hidden; background: #e9eef6; }
        .course-image img { width: 100%; height: 100%; object-fit: cover; transition: transform .5s ease; }
        .course-card:hover .course-image img { transform: scale(1.05); }
        .course-badge { position: absolute; left: 18px; top: 18px; padding: 6px 11px; border-radius: 999px; background: rgba(255,255,255,.94); color: var(--green-dark); font-size: 12px; font-weight: 800; text-transform: uppercase; letter-spacing: .06em; box-shadow: 0 5px 15px rgba(17,27,48,.12); }
        .course-image-gradient { display: flex; align-items: center; justify-content: center; background: linear-gradient(135deg, #ecf8ed, #edf1fb); }
        .course-image-gradient.alt-gradient { background: linear-gradient(135deg, #f9eef3, #f0f3fb); }
        .course-icon { width: 105px; height: 105px; border-radius: 24px; display: grid; place-items: center; background: rgba(255,255,255,.8); color: var(--green); box-shadow: 0 12px 35px rgba(17,27,48,.10); transform: rotate(-3deg); }
        .alt-gradient .course-icon { color: var(--rose); transform: rotate(3deg); }
        .course-icon svg { width: 62px; height: 62px; stroke-width: 2; }
        .course-card-body { padding: 24px 24px 22px; }
        .course-price { color: var(--green-dark); font-size: 21px; font-weight: 800; line-height: 1.2; }
        .course-price span { color: #959cab; font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: .09em; }
        .course-price small { font-size: 11px; letter-spacing: .08em; }
        .course-card h3 { margin: 12px 0 10px; color: var(--heading); font-size: 21px; line-height: 1.35; }
        .course-card h3 a:hover { color: var(--green-dark); }
        .course-card p { margin: 0; min-height: 79px; }
        .course-meta { display: flex; gap: 12px; flex-wrap: wrap; padding: 17px 0 18px; margin-top: 18px; border-top: 1px solid var(--line); border-bottom: 1px solid var(--line); color: #757d8c; font-size: 12px; font-weight: 700; }
        .course-meta span { display: inline-flex; gap: 6px; align-items: center; }
        .course-meta svg { width: 16px; height: 16px; color: var(--green); }
        .course-link { display: inline-flex; align-items: center; gap: 8px; margin-top: 17px; color: var(--heading); font-weight: 800; }
        .course-link span { color: var(--green); transition: transform .2s ease; }
        .course-link:hover { color: var(--green-dark); }
        .course-link:hover span { transform: translateX(4px); }

        .benefits-section { padding-top: 30px; background: linear-gradient(#fff 0 34%, var(--surface-alt) 34% 100%); }
        .benefits-panel { display: grid; grid-template-columns: 1.05fr .95fr; background: var(--navy); color: rgba(255,255,255,.74); border-radius: 20px; overflow: hidden; box-shadow: var(--shadow); }
        .benefits-copy { padding: 64px; position: relative; overflow: hidden; }
        .benefits-copy::after { content: ""; position: absolute; width: 280px; height: 280px; border: 55px solid rgba(255,255,255,.045); border-radius: 50%; right: -110px; bottom: -120px; }
        .benefits-copy h2 { margin: 8px 0 18px; color: #fff; font-family: Georgia, "Times New Roman", serif; font-size: clamp(32px, 4vw, 45px); line-height: 1.2; }
        .benefits-copy p { margin-bottom: 26px; font-size: 16px; }
        .benefits-list { display: grid; grid-template-columns: 1fr 1fr; background: rgba(255,255,255,.035); }
        .benefit-item { padding: 35px 28px; border-left: 1px solid rgba(255,255,255,.08); border-bottom: 1px solid rgba(255,255,255,.08); }
        .benefit-number { display: block; margin-bottom: 22px; color: #83c889; font-size: 13px; font-weight: 800; letter-spacing: .12em; }
        .benefit-item h3 { margin: 0 0 8px; color: #fff; font-size: 19px; }
        .benefit-item p { margin: 0; font-size: 14px; }

        .details-section { background: var(--surface-alt); }
        .course-accordions { display: grid; gap: 16px; }
        .course-detail { background: #fff; border: 1px solid var(--line); border-radius: 12px; box-shadow: 0 5px 20px rgba(25,36,56,.04); overflow: hidden; scroll-margin-top: 115px; }
        .course-detail summary { list-style: none; min-height: 84px; display: grid; grid-template-columns: 1fr auto 24px; gap: 22px; align-items: center; padding: 20px 24px; cursor: pointer; color: var(--heading); font-size: 19px; font-weight: 800; }
        .course-detail summary::-webkit-details-marker { display: none; }
        .course-detail summary > span:first-child { display: flex; flex-direction: column; }
        .course-detail summary small { color: var(--green-dark); font-size: 11px; line-height: 1.3; letter-spacing: .13em; text-transform: uppercase; }
        .summary-price { color: #737b89; font-size: 14px; font-weight: 700; }
        .summary-icon { width: 20px; height: 20px; position: relative; }
        .summary-icon::before, .summary-icon::after { content: ""; position: absolute; left: 50%; top: 50%; width: 15px; height: 2px; background: var(--green); transform: translate(-50%,-50%); transition: transform .2s ease; }
        .summary-icon::after { transform: translate(-50%,-50%) rotate(90deg); }
        .course-detail[open] .summary-icon::after { transform: translate(-50%,-50%) rotate(0); }
        .course-detail[open] summary { border-bottom: 1px solid var(--line); background: #fbfdfb; }
        .detail-content { padding: 30px 28px 34px; }
        .detail-intro { display: grid; grid-template-columns: 1fr 1fr; gap: 28px; margin-bottom: 28px; }
        .detail-intro p { margin: 0; }
        .pricing-grid { display: grid; grid-template-columns: repeat(4,1fr); gap: 12px; margin: 0 0 30px; }
        .pricing-grid > div { padding: 18px; border: 1px solid var(--line); border-radius: 10px; background: var(--surface-alt); }
        .pricing-grid strong, .pricing-grid span { display: block; }
        .pricing-grid strong { color: var(--heading); font-size: 14px; }
        .pricing-grid span { margin-top: 4px; color: var(--green-dark); font-size: 18px; font-weight: 800; }
        .detail-content h3 { margin: 0 0 15px; color: var(--heading); font-size: 18px; }
        .detail-columns { display: grid; grid-template-columns: 1fr 1fr; gap: 40px; }
        .topic-list, .check-list { margin: 0; padding: 0; list-style: none; }
        .topic-list li { padding: 10px 0; border-bottom: 1px solid var(--line); }
        .topic-list li:last-child { border-bottom: 0; }
        .topic-list strong, .topic-list span { display: block; }
        .topic-list strong { color: var(--heading); }
        .topic-list span { font-size: 13px; }
        .two-column-list { display: grid; grid-template-columns: 1fr 1fr; gap: 0 20px; }
        .check-list { display: grid; gap: 11px; }
        .check-list li { position: relative; padding-left: 28px; }
        .check-list li::before { content: "✓"; position: absolute; left: 0; top: 1px; width: 19px; height: 19px; border-radius: 50%; display: grid; place-items: center; background: var(--green-pale); color: var(--green-dark); font-size: 11px; font-weight: 900; }
        .horizontal-check-list { grid-template-columns: repeat(3,1fr); }
        .numbered-topic-grid { margin: 0; padding: 0; list-style: none; display: grid; grid-template-columns: repeat(3,1fr); gap: 9px 22px; counter-reset: topics; }
        .numbered-topic-grid li { counter-increment: topics; position: relative; min-height: 38px; padding: 8px 6px 8px 38px; border-bottom: 1px solid var(--line); }
        .numbered-topic-grid li::before { content: counter(topics, decimal-leading-zero); position: absolute; left: 0; top: 9px; color: var(--green); font-size: 11px; font-weight: 800; }
        .detail-actions { display: flex; gap: 12px; flex-wrap: wrap; margin-top: 30px; padding-top: 25px; border-top: 1px solid var(--line); }

        .cta-section { background: linear-gradient(120deg, var(--green-dark), var(--green)); color: #fff; }
        .cta-inner { min-height: 270px; display: flex; align-items: center; justify-content: space-between; gap: 50px; padding-top: 45px; padding-bottom: 45px; }
        .cta-inner h2 { max-width: 720px; margin: 8px 0 0; font-family: Georgia, "Times New Roman", serif; font-size: clamp(32px, 4vw, 48px); line-height: 1.18; }
        .cta-actions { display: flex; gap: 12px; flex-wrap: wrap; }

        .site-footer { background: var(--navy-deep); color: rgba(255,255,255,.65); padding-top: 74px; }
        .footer-grid { display: grid; grid-template-columns: 1.4fr 1fr 1fr 1fr; gap: 54px; padding-bottom: 58px; }
        .footer-logo { width: 185px; margin-bottom: 21px; filter: brightness(0) invert(1); opacity: .92; }
        .footer-about p { max-width: 360px; margin: 0 0 16px; }
        .footer-email { color: #fff; font-weight: 700; }
        .footer-email:hover { color: #91cf96; }
        .site-footer h2 { margin: 0 0 20px; color: #fff; font-size: 16px; }
        .site-footer ul { margin: 0; padding: 0; list-style: none; display: grid; gap: 10px; }
        .site-footer li a { transition: color .2s ease, padding-left .2s ease; }
        .site-footer li a:hover { color: #fff; padding-left: 4px; }
        .footer-bottom { min-height: 76px; border-top: 1px solid rgba(255,255,255,.09); display: flex; justify-content: space-between; align-items: center; gap: 20px; font-size: 13px; }
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
        .course-grid { grid-template-columns: repeat(2,minmax(0,1fr)); }
        .benefits-copy { padding: 50px; }
        .footer-grid { grid-template-columns: 1.3fr 1fr 1fr; }
        .footer-grid > div:last-child { grid-column: 2 / 4; }
        }

        @media (max-width: 820px) {
        .topbar-promo { display: none; }
        .header-inner { grid-template-columns: 1fr auto; gap: 14px; min-height: 78px; }
        .header-actions { display: none; }
        .primary-nav { top: 78px; }
        .page-hero { min-height: 340px; }
        .split-heading { grid-template-columns: 1fr; gap: 16px; }
        .benefits-panel { grid-template-columns: 1fr; }
        .benefits-list { min-height: 330px; }
        .detail-intro, .detail-columns { grid-template-columns: 1fr; }
        .pricing-grid { grid-template-columns: 1fr 1fr; }
        .numbered-topic-grid, .horizontal-check-list { grid-template-columns: 1fr 1fr; }
        .cta-inner { align-items: flex-start; flex-direction: column; gap: 26px; }
        .footer-grid { grid-template-columns: 1fr 1fr; }
        .footer-grid > div:last-child { grid-column: auto; }
        }

        @media (max-width: 600px) {
        .container, .narrow-container { width: min(calc(100% - 28px), var(--container)); }
        .section { padding: 70px 0; }
        .topbar-inner { justify-content: center; }
        .brand img { width: 150px; }
        .page-hero-content { padding: 55px 0; }
        .course-grid { grid-template-columns: 1fr; }
        .course-image { height: 230px; }
        .course-card p { min-height: 0; }
        .benefits-section { padding-top: 10px; }
        .benefits-copy { padding: 38px 28px; }
        .benefits-list { grid-template-columns: 1fr; }
        .benefit-item { padding: 28px; border-left: 0; }
        .course-detail summary { grid-template-columns: 1fr 22px; padding: 18px; }
        .summary-price { grid-column: 1; grid-row: 2; }
        .summary-icon { grid-column: 2; grid-row: 1 / span 2; }
        .detail-content { padding: 24px 18px 28px; }
        .pricing-grid, .numbered-topic-grid, .horizontal-check-list, .two-column-list { grid-template-columns: 1fr; }
        .detail-actions .btn { width: 100%; }
        .footer-grid { grid-template-columns: 1fr; gap: 35px; }
        .footer-bottom { padding: 20px 0; align-items: flex-start; flex-direction: column; }
        }

        @media (prefers-reduced-motion: reduce) {
        html { scroll-behavior: auto; }
        *, *::before, *::after { animation-duration: .01ms !important; transition-duration: .01ms !important; }
        }
    </style>
<section class="details-section section" id="course-details">
      <div class="container narrow-container">
        <div class="section-heading centered-heading">
          <p class="eyebrow">Course information</p>
          <h2>Subscriptions, topics and inclusions</h2>
          <p>Open a course below for the full details from the existing MedExHub exams page.</p>
        </div>

        <div class="course-accordions">
          <details class="course-detail" id="acem-primary" open>
            <summary>
              <span><small>ACEM</small>ACEM Primary Examination</span>
              <span class="summary-price">From $299 AUD</span>
              <span class="summary-icon" aria-hidden="true"></span>
            </summary>
            <div class="detail-content">
              <div class="detail-intro">
                <p>The ACEM Primary Examination is the first major milestone toward a career in emergency medicine. MedExHub brings the relevant learning material together to support directed preparation.</p>
                <p>The module contains more than 1,826 clinically oriented MCQs and EMQs designed to mirror the ACEM primary examination blueprint and syllabus. Subscribers can access the full question database and create customised timed exams or revision sessions.</p>
              </div>
              <div class="pricing-grid">
                <div><strong>Free trial</strong><span>1 hour</span></div>
                <div><strong>3 months</strong><span>$299 AUD</span></div>
                <div><strong>6 months</strong><span>$399 AUD</span></div>
                <div><strong>1 year</strong><span>$599 AUD</span></div>
              </div>
              <div class="detail-columns">
                <div>
                  <h3>Subjects</h3>
                  <ul class="topic-list two-column-list">
                    <li><strong>Anatomy</strong><span>603+ MCQs and EMQs</span></li>
                    <li><strong>Physiology</strong><span>434+ MCQs and EMQs</span></li>
                    <li><strong>Pathology</strong><span>323+ MCQs and EMQs</span></li>
                    <li><strong>Pharmacology</strong><span>443+ MCQs and EMQs</span></li>
                  </ul>
                </div>
                <div>
                  <h3>Highlights</h3>
                  <ul class="check-list">
                    <li>More than 1,800 questions based on frequently tested themes</li>
                    <li>Study and exam modes</li>
                    <li>Flexible subject selection and peer comparison</li>
                    <li>Visually rich content with full explanations</li>
                  </ul>
                </div>
              </div>
              <div class="detail-actions">
                <a class="btn btn-primary" href="/buyexam/2">Purchase subscription</a>
                <a class="btn btn-primary" href="https://medextech.com.au/register">Start free trial</a>
              </div>
            </div>
          </details>

          <details class="course-detail" id="acem-fellowship">
            <summary>
              <span><small>ACEM</small>ACEM Fellowship Examination</span>
              <span class="summary-price">From $99 AUD</span>
              <span class="summary-icon" aria-hidden="true"></span>
            </summary>
            <div class="detail-content">
              <div class="detail-intro">
                <p>The fellowship examination is the final examination milestone toward a career as an emergency physician. This resource contains more than 578 multiple-choice and extended matched questions designed around the ACEM fellowship blueprint.</p>
                <p>Questions are based on commonly examined and encountered clinical scenarios in Australian emergency departments.</p>
              </div>
              <div class="pricing-grid">
                <div><strong>Free trial</strong><span>1 hour</span></div>
                <div><strong>3 months</strong><span>$99 AUD</span></div>
                <div><strong>6 months</strong><span>$149 AUD</span></div>
                <div><strong>1 year</strong><span>$199 AUD</span></div>
              </div>
              <h3>Topics covered</h3>
              <ol class="numbered-topic-grid">
                <li>Cardiovascular</li><li>Trauma</li><li>Toxicology</li><li>Oncology &amp; Haematology</li><li>Infectious Diseases</li><li>Rheumatology</li><li>Paediatrics</li><li>Orthopaedics</li><li>Psychiatry</li><li>Gastrointestinal</li><li>Pulmonology</li><li>Neurology</li><li>ECG</li><li>Obstetrics &amp; Gynaecology</li><li>Eye</li><li>ENT</li><li>Radiology</li><li>Acid–base, metabolic &amp; electrolytes</li><li>Anaesthesia</li><li>Chest and abdominal surgery / urology</li><li>Dermatology</li><li>Burns &amp; wounds</li><li>Surgical specialties</li><li>Endocrine</li><li>Pre-hospital, disaster &amp; administration</li><li>Resuscitation</li><li>Environmental emergencies</li>
              </ol>
              <div class="detail-actions">
                <a class="btn btn-primary" href="/buyexam/42">Purchase subscription</a>
                <a class="btn btn-primary" href="https://medextech.com.au/register">Start free trial</a>
              </div>
            </div>
          </details>

          <details class="course-detail" id="racgp-akt">
            <summary>
              <span><small>RACGP</small>RACGP Applied Knowledge Test (AKT)</span>
              <span class="summary-price">From $120 AUD</span>
              <span class="summary-icon" aria-hidden="true"></span>
            </summary>
            <div class="detail-content">
              <div class="detail-intro">
                <p>This RACGP fellowship resource contains more than 700 MCQs and extended matched questions that mirror common examination themes and clinical presentations in Australian general practice.</p>
              </div>
              <div class="pricing-grid">
                <div><strong>Free trial</strong><span>1 hour</span></div>
                <div><strong>3 months</strong><span>$120 AUD</span></div>
                <div><strong>6 months</strong><span>$199 AUD</span></div>
                <div><strong>1 year</strong><span>$299 AUD</span></div>
              </div>
              <h3>Topics covered</h3>
              <ol class="numbered-topic-grid">
                <li>Dermatology in general practice</li><li>Chronic disorder continuing management</li><li>Accident and emergency medicine</li><li>Sex-related problems</li><li>Child and adolescent health</li><li>Basics of general practice</li><li>Common presentations</li><li>Diagnostic approach</li><li>Men's health</li><li>Women's health</li><li>Nephrology and urology</li><li>Elderly population</li><li>Mental health</li><li>Cardiovascular health</li><li>Metabolic problems</li><li>Musculoskeletal problems</li><li>Drug and alcohol misuse</li><li>Respiratory problems</li><li>Digestive health</li><li>Neurological problems</li><li>Ophthalmology</li><li>ENT and facial problems</li><li>Rheumatology</li><li>Infectious diseases</li>
              </ol>
              <div class="detail-actions">
                <a class="btn btn-primary" href="https://medextech.com.au/register">Start free trial</a>
                <a class="btn btn-outline" href="https://www.medexhub.com/index.php?P=7">Purchase subscription</a>
              </div>
            </div>
          </details>

          <details class="course-detail" id="amc-mcq">
            <summary>
              <span><small>AMC</small>AMC MCQs</span>
              <span class="summary-price">From $100 AUD</span>
              <span class="summary-icon" aria-hidden="true"></span>
            </summary>
            <div class="detail-content">
              <div class="detail-intro">
                <p>More than 1,000 MCQs and EMQs based on frequently tested themes, with flexible study and exam modes, visual content and full explanations.</p>
              </div>
              <div class="pricing-grid">
                <div><strong>Free trial</strong><span>1 hour</span></div>
                <div><strong>3 months</strong><span>$100 AUD</span></div>
                <div><strong>6 months</strong><span>$199 AUD</span></div>
                <div><strong>1 year</strong><span>$299 AUD</span></div>
              </div>
              <ul class="check-list horizontal-check-list">
                <li>Study and exam modes</li><li>Flexible topic selection</li><li>Curriculum-focused questions</li><li>Visually rich content</li><li>Full explanations</li><li>CAT examination preparation</li>
              </ul>
              <div class="detail-actions">
                <a class="btn btn-primary" href="/buyexam/92">Purchase subscription</a>
                <a class="btn btn-primary" href="https://medextech.com.au/register">Start free trial</a>
              </div>
            </div>
          </details>

          <details class="course-detail" id="acem-flashcards">
            <summary>
              <span><small>Flash cards</small>ACEM Primary Exam Flash Cards</span>
              <span class="summary-price">Focused revision</span>
              <span class="summary-icon" aria-hidden="true"></span>
            </summary>
            <div class="detail-content">
              <div class="detail-intro">
                <p>Curriculum-focused facts designed to improve knowledge and performance in the ACEM Primary Examination.</p>
              </div>
              <div class="detail-columns">
                <div><h3>Subjects</h3><ul class="topic-list"><li><strong>Anatomy</strong></li><li><strong>Physiology</strong></li></ul></div>
                <div><h3>Highlights</h3><ul class="check-list"><li>High-yield facts</li><li>Visually rich content</li><li>Full explanations</li></ul></div>
              </div>
              <div class="detail-actions"><a class="btn btn-primary" href="https://medextech.com.au/register">Register</a></div>
            </div>
          </details>

          <details class="course-detail" id="racgp-flashcards">
            <summary>
              <span><small>Flash cards</small>RACGP Flash Cards</span>
              <span class="summary-price">From $99 AUD</span>
              <span class="summary-icon" aria-hidden="true"></span>
            </summary>
            <div class="detail-content">
              <div class="detail-intro">
                <p>More than 700 updated, curriculum-based facts and descriptions designed to support active recall and long-term memory for RACGP fellowship preparation.</p>
              </div>
              <div class="pricing-grid">
                <div><strong>Free trial</strong><span>1 hour</span></div><div><strong>3 months</strong><span>$99 AUD</span></div><div><strong>6 months</strong><span>$160 AUD</span></div><div><strong>1 year</strong><span>$200 AUD</span></div>
              </div>
              <h3>Topics covered</h3>
              <ol class="numbered-topic-grid">
                <li>Dermatology</li><li>Chronic disorder management</li><li>Accident and emergency medicine</li><li>Child and adolescent health</li><li>Basics of general practice</li><li>Common presentations</li><li>Diagnostic approach</li><li>Men's health</li><li>Women's health</li><li>Nephrology and urology</li><li>Elderly population</li><li>Mental health</li><li>Cardiovascular health</li><li>Metabolic problems</li><li>Musculoskeletal problems</li><li>Drug and alcohol misuse</li><li>Digestive health</li><li>Neurological problems</li><li>Ophthalmology</li><li>ENT and facial problems</li><li>Rheumatology</li><li>Infectious diseases</li>
              </ol>
              <div class="detail-actions"><a class="btn btn-primary" href="https://medextech.com.au/register">Start free trial</a><a class="btn btn-outline" href="https://www.medexhub.com/index.php?P=7">Purchase subscription</a></div>
            </div>
          </details>

          <details class="course-detail" id="racgp-kfp">
            <summary>
              <span><small>RACGP</small>RACGP KFP</span>
              <span class="summary-price">Key feature problems</span>
              <span class="summary-icon" aria-hidden="true"></span>
            </summary>
            <div class="detail-content">
              <div class="detail-intro"><p>Key feature problem preparation across common general practice domains.</p></div>
              <h3>Topics covered</h3>
              <ol class="numbered-topic-grid">
                <li>Dermatology</li><li>Chronic disorder management</li><li>Accident and emergency medicine</li><li>Child and adolescent health</li><li>Diagnostic approach</li><li>Men's health</li><li>Women's health</li><li>Nephrology and urology</li><li>Elderly population</li><li>Mental health</li><li>Cardiovascular health</li><li>Metabolic problems</li><li>Musculoskeletal problems</li><li>Respiratory problems</li><li>Digestive health</li><li>Neurological problems</li><li>Ophthalmology</li><li>ENT and facial problems</li>
              </ol>
              <div class="detail-actions"><a class="btn btn-primary" href="https://medextech.com.au/register">Register</a></div>
            </div>
          </details>

          <details class="course-detail" id="acem-saq">
            <summary>
              <span><small>ACEM</small>ACEM Fellowship SAQs</span>
              <span class="summary-price">Short-answer practice</span>
              <span class="summary-icon" aria-hidden="true"></span>
            </summary>
            <div class="detail-content">
              <div class="detail-intro"><p>Short-answer question practice for ACEM fellowship preparation. Current listed content includes oncology and haematology.</p></div>
              <ul class="topic-list"><li><strong>Oncology &amp; Haematology</strong></li></ul>
              <div class="detail-actions"><a class="btn btn-primary" href="https://medextech.com.au/register">Register</a></div>
            </div>
          </details>
        </div>
      </div>
    </section>



    @include('frontend.footer')
	@include('frontend.index_footer')