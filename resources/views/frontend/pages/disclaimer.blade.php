	@if(Auth::check())
    	@include('frontend.headerAuth')
	@else
		@include('frontend.header')
	@endif
  @include('messages')
<style>
    :root{--primary:#0f766e;--dark:#115e59;--soft:#e8f6f4;--accent:#14b8a6;--navy:#102a43;--text:#334e68;--muted:#627d98;--line:#d9e2ec;--surface:#fff;--bg:#f6faf9;--shadow:0 18px 50px rgba(16,42,67,.08)}
    *{box-sizing:border-box}html{scroll-behavior:smooth;scroll-padding-top:105px}body{margin:0;background:var(--bg);color:var(--text);font-family:Inter,ui-sans-serif,-apple-system,BlinkMacSystemFont,"Segoe UI",sans-serif;line-height:1.72}a{color:inherit;text-decoration:none}

    .progress{position:fixed;top:0;left:0;right:0;height:3px;z-index:100}.progress span{display:block;height:100%;width:0;background:linear-gradient(90deg,var(--primary),var(--accent))}

    header{position:sticky;top:0;z-index:60;background:rgba(255,255,255,.96);border-bottom:1px solid rgba(217,226,236,.85);backdrop-filter:blur(14px)}

    .nav{min-height: 78px;display: flex;align-items: center;justify-content: space-between;gap: 28px;}
    .brand{display:inline-flex;align-items:center;gap:11px;color:var(--navy);font-size:23px;font-weight:800}
    .mark{width:38px;height:38px;display:grid;place-items:center;border-radius:12px;color:#fff;background:linear-gradient(135deg,var(--primary),var(--accent));box-shadow:0 8px 24px rgba(15,118,110,.24)}
    .links{display:flex;align-items:center;gap:28px;font-size:15px;font-weight:650}
    .links a:hover{color:var(--primary)}
    .actions{display:flex;gap:12px}.btn{min-height:44px;display:inline-flex;align-items:center;justify-content:center;padding:0 20px;border:1px solid transparent;border-radius:12px;font-weight:750;cursor:pointer;background:#fff}.btn-outline{border-color:var(--line);color:var(--navy)}.btn-primary{background:var(--primary);color:#fff;box-shadow:0 10px 24px rgba(15,118,110,.22)}.menu{display:none;width:44px;height:44px;border:1px solid var(--line);border-radius:12px;background:#fff;color:var(--navy)}
    .hero{position:relative;overflow:hidden;padding:78px 0 68px;border-bottom:1px solid #e7f0ef;background:radial-gradient(circle at 15% 25%,rgba(20,184,166,.16),transparent 28%),radial-gradient(circle at 85% 10%,rgba(15,118,110,.11),transparent 25%),linear-gradient(180deg,#f4fbfa,#fff)}.hero-content{max-width:700px;text-align:center}.eyebrow{display:inline-flex;align-items:center;gap:8px;margin-bottom:18px;padding:7px 12px;border:1px solid #bfe7e1;border-radius:999px;color:var(--dark);background:rgba(255,255,255,.86);font-size:13px;font-weight:800;text-transform:uppercase;letter-spacing:.04em}.dot{width:8px;height:8px;border-radius:50%;background:var(--accent)}h1{margin:0;color:var(--navy);font-size:clamp(38px,5vw,58px);line-height:1.08;letter-spacing:-2px}.lead{max-width:710px;margin:22px auto 0;color:var(--muted);font-size:18px}.chips{margin-top:28px;display:flex;justify-content:center;flex-wrap:wrap;gap:10px}.chip{padding:8px 12px;border:1px solid #d3e3e1;border-radius:999px;background:rgba(255,255,255,.9);font-size:13px;font-weight:700}
    main{padding:64px 0 88px}.layout{display:grid;grid-template-columns:280px minmax(0,1fr);gap:44px;align-items:start}.sidebar{position:sticky;top:108px}.toc-card{padding:22px;border:1px solid var(--line);border-radius:16px;background:#fff;box-shadow:0 12px 34px rgba(16,42,67,.05)}.toc-card h2{margin:0 0 14px;color:var(--navy);font-size:15px}.toc{display:grid;gap:3px}.toc a{display:block;padding:7px 11px;border-left:2px solid transparent;border-radius:0 9px 9px 0;color:var(--muted);font-size:13px;line-height:1.35}.toc a:hover,.toc a.active{border-left-color:var(--primary);color:var(--dark);background:var(--soft)}.side-actions{display:grid;gap:10px;margin-top:16px}.side-actions .btn{width:100%}
    .summary{margin-bottom:28px;padding:28px;border:1px solid #bfe7e1;border-radius:24px;background:linear-gradient(120deg,#effaf8,#fff)}.summary h2{margin:0 0 10px;color:var(--navy);font-size:22px}.summary p{margin:0}.summary ul{margin:16px 0 0;padding-left:20px}.summary li+li{margin-top:7px}.notice{margin-bottom:28px;padding:18px 20px;display:flex;gap:13px;border:1px solid #f4d27a;border-radius:14px;color:#7a5a00;background:#fff9e8}.notice strong{color:#614800}
    .section{margin-bottom:18px;padding:30px;border:1px solid var(--line);border-radius:16px;background:#fff;box-shadow:0 9px 28px rgba(16,42,67,.04)}.heading{display:flex;gap:14px;align-items:flex-start;margin-bottom:16px}.num{flex:0 0 34px;width:34px;height:34px;display:grid;place-items:center;border-radius:10px;color:var(--dark);background:var(--soft);font-size:13px;font-weight:850}.section h2{margin:1px 0 0;color:var(--navy);font-size:23px;line-height:1.3}.section h3{margin:24px 0 8px;color:var(--navy);font-size:17px}.section p{margin:0}.section p+p,.section ul+p,.section ol+p{margin-top:13px}.section ul,.section ol{margin:13px 0 0;padding-left:23px}.section li+li{margin-top:8px}.section a{color:var(--dark);font-weight:700;text-decoration:underline;text-underline-offset:3px}.definitions{display:grid;gap:12px}.definition{padding:15px 17px;border:1px solid #e5ecef;border-radius:12px;background:#fbfdfd}.definition strong{color:var(--navy)}
    .contact{padding:28px;border-radius:24px;color:#fff;background:linear-gradient(145deg,var(--navy),#173f5f)}.contact h2{margin:0 0 8px;font-size:23px}.contact p{margin:0;color:#c8d9e8}.contact-grid{margin-top:20px;display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:14px}.contact-item{padding:15px;border:1px solid rgba(255,255,255,.14);border-radius:12px;background:rgba(255,255,255,.06)}.contact-item span{display:block;color:#8df0df;font-size:12px;font-weight:800;text-transform:uppercase}.contact-item strong,.contact-item a{display:block;margin-top:4px;color:#fff;font-size:14px;word-break:break-word}
    footer{padding:54px 0 24px;color:#c8d9e8;background:var(--navy)}.footer-grid{display:grid;grid-template-columns:1.7fr repeat(3,1fr);gap:48px}.footer-brand p{max-width:360px;margin:18px 0 0;color:#9fb3c8;font-size:14px}.footer-title{margin:0 0 14px;color:#fff;font-size:14px}.footer-links{display:grid;gap:9px;font-size:14px}.footer-links a{color:#b7cadb}.footer-links a:hover,.footer-links .active{color:#fff}.footer-bottom{margin-top:42px;padding-top:22px;display:flex;justify-content:space-between;gap:20px;border-top:1px solid rgba(255,255,255,.12);color:#8da2b5;font-size:13px}.up{position:fixed;right:24px;bottom:24px;width:46px;height:46px;border:0;border-radius:14px;color:#fff;background:var(--primary);box-shadow:0 12px 28px rgba(15,118,110,.28);cursor:pointer;opacity:0;pointer-events:none;transform:translateY(10px);transition:.2s}.up.show{opacity:1;pointer-events:auto;transform:none}
    .hero-meta {display: flex;flex-wrap: wrap;gap: 12px 24px;margin-top: 28px;color: var(--muted);font-size: 14px;}
    .hero-meta span {display: inline-flex;align-items: center;gap: 8px;}
    .hero-meta svg {width: 17px;height: 17px;color: var(--primary);}
    .notice svg {flex: 0 0 auto;width: 22px;height: 22px;margin-top: 2px;color: var(--primary);}
    .notice p {margin: 0;font-size: 14px;}
    @media(max-width:980px){.links{position:absolute;top:76px;left:20px;right:20px;display:none;padding:18px;flex-direction:column;align-items:stretch;gap:8px;border:1px solid var(--line);border-radius:16px;background:#fff;box-shadow:var(--shadow)}.links.open{display:flex}.links a{padding:9px 10px}.actions .btn-outline{display:none}.menu{display:block}.layout{grid-template-columns:1fr}.sidebar{position:static}.toc-card{overflow-x:auto}.toc{display:flex;min-width:max-content;gap:6px}.toc a{border-left:0;border-bottom:2px solid transparent;border-radius:9px 9px 0 0}.toc a:hover,.toc a.active{border-bottom-color:var(--primary)}.side-actions{display:none}.footer-grid{grid-template-columns:1.5fr 1fr 1fr}.footer-grid>div:last-child{grid-column:2/4}}
    @media(max-width:700px){.container{width:min(100% - 28px,1180px)}.topbar{display:none}.nav{min-height:68px}.links{top:68px;left:14px;right:14px}.actions .btn-primary{display:none}.hero{padding:58px 0 52px}.lead{font-size:16px}main{padding:46px 0 64px}.summary,.section,.contact{padding:22px}.section h2{font-size:20px}.contact-grid{grid-template-columns:1fr}.footer-grid{grid-template-columns:1fr 1fr;gap:34px 26px}.footer-brand{grid-column:1/-1}.footer-grid>div:last-child{grid-column:auto}.footer-bottom{flex-direction:column}.up{right:15px;bottom:15px}}
    @media print{.progress,.topbar,header,.sidebar,.up,footer{display:none!important}body{background:#fff;color:#111827;font-size:11pt}.hero{padding:24px 0;border:0;background:#fff}.eyebrow{display:none}main{padding:0}.layout{display:block}.section,.summary,.notice,.contact{break-inside:avoid;box-shadow:none}.contact,.contact p,.contact-item span,.contact-item strong,.contact-item a{color:#111827;background:#fff}}
</style>
<section class="hero">
    <div class="container hero-content">
        <div class="eyebrow"><span class="dot"></span>Legal information</div>
        <h1>Disclaimer</h1>
        <p class="lead">Important information about the educational purpose, limitations and appropriate use of MedExHub resources.</p>
        <div class="hero-meta">
            <span>
                <svg viewBox="0 0 24 24" fill="none">
                    <path d="M8 3v3M16 3v3M4 9h16M5 5h14a1 1 0 0 1 1 1v13a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1Z"
                            stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                </svg>
                Last updated: 6 August 2026
            </span>

            <span>
                <svg viewBox="0 0 24 24" fill="none">
                    <path d="M12 22a10 10 0 1 0 0-20 10 10 0 0 0 0 20Zm0-14v4l3 2"
                            stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                </svg>
                Approximately 6 minutes to read
            </span>
        </div>
    </div>
</section>
<main>
    <div class="container layout">
        <aside class="sidebar">
            <div class="toc-card">
                <h2>On this page</h2>
                <nav class="toc" id="toc">
                    <a href="#educational-purpose">1. Educational purpose</a>
                    <a href="#independence">2. Independence</a>
                    <a href="#medical-advice">3. No medical advice</a>
                    <a href="#accuracy">4. Accuracy of content</a>
                    <a href="#exam-results">5. Examination outcomes</a>
                    <a href="#performance">6. Performance information</a>
                    <a href="#external-links">7. External links</a>
                    <a href="#intellectual-property">8. Intellectual property</a>
                    <a href="#availability">9. Website availability</a>
                    <a href="#liability">10. Limitation of liability</a>
                    <a href="#consumer-law">11. Consumer law</a>
                    <a href="#changes">12. Changes and contact</a>                    
                </nav>
            </div>
            <div class="side-actions">
                <button class="btn btn-outline" onclick="window.print()">Print terms</button>
                <a class="btn btn-primary" href="/contact">Contact us</a>
            </div>
        </aside>
        <article>
            <div class="notice" >
                <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M12 8v5M12 17h.01M10.3 4.7 2.8 18a2 2 0 0 0 1.74 3h14.92a2 2 0 0 0 1.74-3L13.7 4.7a2 2 0 0 0-3.4 0Z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/> </svg>
                <p>MedExHub is an educational examination-preparation platform. Its content is not a substitute for clinical assessment, current authoritative guidance or independent professional judgement.</p>
            </div>
            <section class="section" id="educational-purpose" style="padding: 28px;">
                <div class="heading"><span class="num">1</span><h2>Educational purpose</h2></div>
                <p>MedExHub provides online revision resources, examination-style questions, explanations, study modes, flash cards, performance insights and related learning materials for medical practitioners, trainees, students and other healthcare professionals.</p>
                <p>All content available through the MedExHub website, applications and services is provided for general education, revision and examination-preparation purposes only.</p>
            </section>
            <section class="section" id="independence" style="padding: 28px;">
                <div class="heading"><span class="num">2</span><h2>Independent educational platform</h2></div>
                <p>MedExHub is an independent educational platform. Unless expressly stated otherwise, MedExHub is not affiliated with, endorsed by, sponsored by or officially connected with:</p>
                <ul>
                    <li>the Australasian College for Emergency Medicine (ACEM);</li>
                    <li>the Royal Australian College of General Practitioners (RACGP);</li>
                    <li>the Australian Medical Council (AMC); or</li>
                    <li>any other medical college, examination authority, university, hospital or healthcare organisation.</li>
                </ul>
                <p>
                    College names, examination names, curricula and trademarks are used only to identify the area of study for which the relevant educational resources have been developed. All third-party names and trademarks remain the property of their respective owners.</p>
            </section>
            <section class="section" id="medical-advice" style="padding: 28px;">
                <div class="heading"><span class="num">3</span><h2>No medical advice or medical services</h2></div>
                <p>MedExHub does not practise medicine, provide healthcare services or establish a doctor–patient, clinician–patient, supervisory or other professional relationship with a user.</p>
                <p>The content must not be used as medical advice or as the sole basis for diagnosis, investigation, prescribing, treatment or management of any patient. It must not replace:</p>
                <ul>
                    <li>an appropriate individual clinical assessment;</li>
                    <li>current clinical guidelines and medication references;</li>
                    <li>professional supervision or specialist advice;</li>
                    <li>hospital, health service or workplace policies; or</li>
                    <li>the independent judgement of a suitably qualified healthcare professional.</li>
                </ul>
                <p>In a medical emergency, contact the appropriate local emergency service or seek urgent assessment from a qualified healthcare professional.</p>
            </section>
            <section class="section" id="accuracy" style="padding: 28px;">
                <div class="heading"><span class="num">4</span><h2>Accuracy and currency of content</h2></div>
                <p>MedExHub takes reasonable steps to prepare useful and accurate educational materials. However, medicine, clinical guidance, medication information, examination requirements and professional standards may change over time.</p>
                <p>We do not warrant that all information is complete, error-free, current or appropriate for every user, patient, jurisdiction or clinical setting.</p>
                <p>Users must independently verify important information, including medication doses, contraindications, investigation strategies, management recommendations and professional requirements, againstcurrent authoritative sources before relying on it.</p>
            </section>
            <section class="section" id="exam-results" style="padding: 28px;">
                <div class="heading"><span class="num">5</span><h2>Examination content and outcomes</h2></div>
                <p>MedExHub questions and learning resources are independently developed educational materials. They are not official examination questions and should not be understood as reproducing or predicting the content of any future examination.</p>
                <p>Use of MedExHub does not guarantee:</p>
                <ul>
                    <li>eligibility or admission to an examination;</li>
                    <li>a particular score or successful examination result;</li>
                    <li>registration, accreditation, employment or promotion;</li>
                    <li>achievement of a qualification; or</li>
                    <li>clinical competence or readiness for independent practice.</li>
                </ul>
                <p>Examination bodies may change their curricula, formats, policies, eligibility criteria and assessment standards without notice. Users are responsible for confirming current requirements directly with the relevant examination body.</p>
            </section>
            <section class="section" id="performance" style="padding: 28px;">
                <div class="heading"><span class="num">6</span><h2>Scores and performance information</h2></div>
                <p>Scores, rankings, peer comparisons, progress reports, completion data and other performance information generated by MedExHub are intended only to support personal study and revision.</p>
                <p>They are not formal assessments of clinical competence, professional performance or fitness to practise. Performance on MedExHub may not predict performance in an official examination or clinical setting.</p>
            </section>
            <section class="section" id="external-links" style="padding: 28px;">
                <div class="heading"><span class="num">7</span><h2>External links and third-party content</h2></div>
                <p>The website may contain links to third-party websites, publications, guidelines, videos, images or other resources. These links are provided for convenience and educational reference only.</p>
                <p>A link does not imply endorsement, approval, partnership or responsibility for the third party or its content. MedExHub does not control and is not responsible for the accuracy, availability,security, accessibility or privacy practices of external websites.Users access third-party resources at their own discretion.</p>
            </section>
            <section class="section" id="intellectual-property" style="padding: 28px;">
                <div class="heading"><span class="num">8</span><h2>Copyright and intellectual property</h2></div>
                <p>Unless otherwise stated, the website design, software, question banks, explanations, text, graphics, branding and other original materials are owned by or licensed to MedExHub and are protected by applicable intellectual property laws.</p>
                <p>Users may access and use the materials for their own lawful, personal and non-commercial study. Users must not copy, reproduce, republish, upload, distribute, sell, scrape, modify or create derivative materials from MedExHub content except where expressly authorised in writing or permitted by law.</p>
                <p>Third-party content remains subject to the rights and licence terms of its respective owner.</p>
            </section>
            <section class="section" id="availability" style="padding: 28px;">
                <div class="heading"><span class="num">9</span><h2>Website operation and availability</h2></div>
                <p>MedExHub may update, correct, replace, restrict, suspend or remove content or website functions at any time. We do not guarantee that  the website will always be uninterrupted, error-free, secure or compatible with every device, browser or network.</p>
                <p>Users are responsible for maintaining suitable devices, internet access, security controls and copies of any information they are permitted to retain.</p>
            </section>
            <section class="section" id="liability" style="padding: 28px;">
                <div class="heading"><span class="num">10</span><h2>Limitation of liability</h2></div>
                <p>To the maximum extent permitted by law, MedExHub and its owners, directors, employees, authors, contributors, licensors and contractors exclude liability for loss, injury, damage, cost or expense arising from or connected with:</p>
                <ul>
                    <li>use of or reliance on website content;</li>
                    <li>clinical, educational or professional decisions made by a user;</li>
                    <li>examination results or other academic or professional outcomes;</li>
                    <li>inaccurate, incomplete or outdated information;</li>
                    <li>website interruption, delay, technical failure or data loss;</li>
                    <li>unauthorised access to an account; or</li>
                    <li>third-party websites, products, content or services.</li>
                </ul>
                <p>Users remain responsible for exercising independent judgement and obtaining appropriate professional advice before acting on any information made available through the website.</p>
            </section>
            <section class="section" id="consumer-law" style="padding: 28px;">
                <div class="heading"><span class="num">11</span><h2>Australian Consumer Law</h2></div>    
                <p>Nothing in this Disclaimer excludes, restricts or modifies any consumer guarantee, right or remedy under the Australian Consumer Law or any other applicable law that cannot lawfully be excluded, restricted or modified.</p>
                <p>Where MedExHub's liability cannot legally be excluded, that liability is limited only to the extent permitted by applicable law.</p>
            </section>
            <section class="section" id="changes" style="padding: 28px;">
                <div class="heading"><span class="num">12</span><h2>Changes to this Disclaimer and contact</h2></div>
                <p>MedExHub may update this Disclaimer when its services, business practices or legal requirements change. The revised version will be published on this page with an updated effective date.</p>
                <p>Continued use of the website after an updated Disclaimer is published constitutes acknowledgement of the revised terms.</p>
                <p>Questions about this Disclaimer may be submitted through the<a href="/contact" style="color: var(--primary); font-weight: 800;"> MedExHub contact page</a>.</p>
            </section>
        </article>
    </div>
</main>
<script>
document.addEventListener('DOMContentLoaded',()=>{const menu=document.getElementById('menu'),nav=document.getElementById('nav'),bar=document.getElementById('progress'),up=document.getElementById('up'),links=[...document.querySelectorAll('#toc a')],sections=links.map(a=>document.querySelector(a.getAttribute('href'))).filter(Boolean);menu.addEventListener('click',()=>{const open=nav.classList.toggle('open');menu.textContent=open?'✕':'☰'});document.addEventListener('click',e=>{if(innerWidth<=980&&!nav.contains(e.target)&&!menu.contains(e.target)){nav.classList.remove('open');menu.textContent='☰'}});function update(){const h=document.documentElement.scrollHeight-innerHeight;bar.style.width=(h>0?Math.min(100,scrollY/h*100):0)+'%';up.classList.toggle('show',scrollY>600);let id='';sections.forEach(s=>{if(s.getBoundingClientRect().top<=150)id=s.id});links.forEach(a=>a.classList.toggle('active',a.getAttribute('href')==='#'+id))}addEventListener('scroll',update,{passive:true});addEventListener('resize',update);update();up.addEventListener('click',()=>scrollTo({top:0,behavior:'smooth'}))});
</script>
@include('frontend.footer')
@include('frontend.index_footer')