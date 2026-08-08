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
        <div class="eyebrow"><span class="dot"></span>Legal</div>
        <h1>Terms and Conditions</h1>
        <p class="lead">These terms govern your access to and use of MedExHub’s websites, question banks, subscriptions and related learning services.</p>
        <div class="chips">
            <span class="chip">Effective: 5 August 2026</span>
            <span class="chip">Australian service</span>
            <span class="chip">MedExHub Pty Ltd</span>
        </div>
    </div>
</section>
<main>
    <div class="container layout">
        <aside class="sidebar">
            <div class="toc-card">
                <h2>On this page</h2>
                <nav class="toc" id="toc">
                    <a href="#acceptance">1. Acceptance</a>
                    <a href="#definitions">2. Definitions</a>
                    <a href="#eligibility">3. Eligibility</a>
                    <a href="#service">4. The service</a>
                    <a href="#accounts">5. Accounts</a>
                    <a href="#subscriptions">6. Subscriptions</a>
                    <a href="#payments">7. Payments</a>
                    <a href="#refunds">8. Refunds</a>
                    <a href="#acceptable-use">9. Acceptable use</a>
                    <a href="#discussions">10. Discussions</a>
                    <a href="#ip">11. Intellectual property</a>
                    <a href="#disclaimer">12. Education disclaimer</a>
                    <a href="#availability">13. Availability</a>
                    <a href="#third-parties">14. Third parties</a>
                    <a href="#privacy">15. Privacy</a>
                    <a href="#suspension">16. Suspension</a>
                    <a href="#liability">17. Liability</a>
                    <a href="#indemnity">18. Responsibility</a>
                    <a href="#changes">19. Changes</a>
                    <a href="#general">20. General</a>
                    <a href="#contact">21. Contact</a>
                </nav>
            </div>
            <div class="side-actions">
                <button class="btn btn-outline" onclick="window.print()">Print terms</button>
                <a class="btn btn-primary" href="https://medextech.com.au/contact">Contact us</a>
            </div>
        </aside>
        <article>
            <section class="summary" style="padding: 28px;">
                <h2>Terms at a glance</h2>
                <p>This summary is for convenience. The complete terms below apply if there is any difference.</p>
                <ul>
                    <li>Your account and subscription are for your personal use only.</li>
                    <li>Do not copy, share, scrape, publish or resell MedExHub questions or explanations.</li>
                    <li>MedExHub is an exam-preparation service, not a clinical decision-making tool.</li>
                    <li>Access periods, prices and renewal arrangements are shown before checkout.</li>
                    <li>Your rights under the Australian Consumer Law are not excluded or restricted.</li>
                </ul>
            </section>
            <div class="notice" >
                <span>ⓘ</span>
                <div>
                    <strong>Please read these terms before using MedExHub.</strong>
                    By creating an account, purchasing access or continuing to use the Service, you agree to be bound by them.
                </div>
            </div>
            <section class="section" id="acceptance" style="padding: 28px;" >
                <div class="heading">
                    <span class="num">1</span>
                    <h2>Acceptance of these terms</h2>
                </div>
                <p>These Terms and Conditions form an agreement between you and <strong>MedExHub Pty Ltd (ACN 603 739 902)</strong> (“MedExHub”, “we”, “us” or “our”).</p>
                <p>They apply to your use of medextech.com.au, medexhub.com and any related page, feature, question bank, flash-card resource, discussion area, account, subscription or service we make available (collectively, the “Service”).</p>
                <p>By accessing or using the Service, registering an account or purchasing access, you confirm that you have read, understood and accepted these terms. If you do not agree, you must not use the Service.</p>
            </section>
            <section class="section" id="definitions" style="padding: 28px;">
                <div class="heading">
                    <span class="num">2</span>
                    <h2>Definitions</h2>
                </div>
                <div class="definitions">
                    <div class="definition">
                        <strong>Account</strong>
                        means the personal user account created to access free or paid parts of the Service.
                    </div>
                    <div class="definition">
                        <strong>Content</strong>
                        includes questions, answer choices, explanations, images, illustrations, videos, flash cards, comments, performance information, software, text, graphics and other material made available through the Service.
                    </div>
                    <div class="definition">
                        <strong>Subscription</strong>
                        means paid access to a selected resource for the access period stated at checkout.
                    </div>
                    <div class="definition">
                        <strong>User Content</strong>
                        means comments, questions, feedback, messages or other material submitted by a user.
                    </div>
                </div>
            </section>
            <section class="section" id="eligibility" style="padding: 28px;">
                <div class="heading">
                    <span class="num">3</span>
                    <h2>Eligibility and authority</h2>
                </div>
                <p>You must be at least 18 years old and legally capable of entering into a contract. A person under 18 may only use the Service with the consent and supervision of a parent or legal guardian who accepts these terms on their behalf.</p>
                <p>If you use or purchase the Service for an organisation, you confirm that you have authority to bind that organisation to these terms.</p>
            </section>
            <section class="section" id="service" style="padding: 28px;">
                <div class="heading">
                    <span class="num">4</span>
                    <h2>The MedExHub service</h2>
                </div>
                <p>MedExHub provides online educational resources for medical examination preparation. Depending on the selected resource, the Service may include:</p>
                <ul>
                    <li>ACEM, RACGP and AMC-oriented question banks;</li>
                    <li>study mode and timed exam-style sessions;</li>
                    <li>answer explanations and linked educational material;</li>
                    <li>flash cards and saved revision lists;</li>
                    <li>performance, completion and topic-level information; and</li>
                    <li>user discussion or question-comment features.</li>
                </ul>
                <p>Features, question numbers, subjects, availability and access periods may differ between products and may change as resources are updated.</p>
            </section>
            <section class="section" id="accounts" style="padding: 28px;">
                <div class="heading">
                    <span class="num">5</span>
                    <h2>Accounts and security</h2>
                </div>
                <p>You must provide accurate and current registration information and keep it updated. Your Account is personal, non-transferable and must not be shared.</p>
                <p>You are responsible for:</p>
                <ul>
                    <li>keeping your sign-in details and password confidential;</li>
                    <li>all activity occurring through your Account;</li>
                    <li>signing out of shared or public devices; and</li>
                    <li>notifying us promptly if you suspect unauthorised access.</li>
                </ul>
                <p>We may require password changes, additional verification or other reasonable security steps to protect the Service and its users.</p>
            </section>
            <section class="section" id="subscriptions" style="padding: 28px;">
                <div class="heading">
                    <span class="num">6</span>
                    <h2>Subscriptions and access periods</h2>
                </div>
                <p>The product, price, currency, access period and any material conditions applying to a Subscription will be displayed before you complete checkout.</p>
                <p>Unless checkout expressly states that a Subscription renews automatically, access is provided for the fixed period purchased and expires at the end of that period. You may purchase another available access period to continue using the paid resource.</p>
                <p>Access generally begins after payment is successfully processed. Promotional, complimentary and trial access may have separate limits or eligibility requirements stated when offered.</p>
                <p>A Subscription gives you a limited right to access the selected resource. It does not transfer ownership of any Content to you.</p>
            </section>
            <section class="section" id="payments" style="padding: 28px;">
                <div class="heading">
                    <span class="num">7</span>
                    <h2>Prices, taxes and payments</h2>
                </div>
                <p>Prices are displayed in Australian dollars unless otherwise stated. Any applicable taxes or charges will be disclosed before payment.</p>
                <p>Payments may be processed by PayPal or another third-party payment provider. Your use of a payment provider may also be governed by that provider’s terms and privacy policy.</p>
                <p>You authorise the payment provider to charge the amount shown at checkout. You must use a valid payment method that you are authorised to use.</p>
                <p>We may correct an obvious pricing or description error before accepting an order. If payment has already been taken for an order we cannot fulfil because of such an error, we will provide an appropriate remedy, which may include cancellation and refund.</p>
            </section>
            <section class="section" id="refunds" style="padding: 28px;">
                <div class="heading">
                    <span class="num">8</span>
                    <h2>Refunds and Australian Consumer Law</h2>
                </div>
                <p>Our services come with guarantees that cannot be excluded under the Australian Consumer Law. Nothing in these terms excludes, restricts or modifies any right or remedy that cannot lawfully be excluded, restricted or modified.</p>
                <p>If the Service has a major failure, is materially different from its description or otherwise does not comply with an applicable consumer guarantee, you may be entitled to a remedy under law.</p>
                <p>We are generally not required to provide a refund merely because you changed your mind, selected the wrong resource, did not use the Service or your personal circumstances changed. However, we may consider a discretionary request based on its circumstances.</p>
                <p>To request assistance, contact us with your Account email, order details, the affected resource and a clear description of the issue. We may request reasonable information needed to assess the request.</p>
            </section>
            <section class="section" id="acceptable-use" style="padding: 28px;">
                <div class="heading">
                    <span class="num">9</span>
                    <h2>Acceptable use</h2>
                </div>
                <p>You must use the Service lawfully and only for personal educational purposes.</p>
                <p>You must not:</p>
                <ul>
                    <li>share, sell, lend, transfer or permit another person to use your Account;</li>
                    <li>copy, reproduce, photograph, record, download, publish, transmit or distribute Content except where expressly permitted;</li>
                    <li>compile, extract or create a competing question bank, dataset, model-training dataset or derivative commercial resource from the Content;</li>
                    <li>use scraping, crawling, bots, automation, data-mining or similar methods to access or collect Content;</li>
                    <li>bypass, disable or interfere with access controls, security, usage limits or technical protections;</li>
                    <li>introduce malware, harmful code or an unreasonable load on the Service;</li>
                    <li>attempt to gain unauthorised access to another account, server or system;</li>
                    <li>use the Service to harass, threaten, defame or unlawfully discriminate against another person;</li>
                    <li>impersonate another person or misrepresent your identity or affiliation; or</li>
                    <li>use the Content in a live or formal examination where doing so would breach examination rules or academic integrity requirements.</li>
                </ul>
            </section>
            <section class="section" id="discussions" style="padding: 28px;">
                <div class="heading">
                    <span class="num">10</span>
                    <h2>User discussions and submissions</h2>
                </div>
                <p>Where discussion, comment or feedback features are available, you remain responsible for your User Content. Do not post personal health information, confidential patient information, examination material obtained in breach of an exam rule, or material that infringes another person’s rights.</p>
                <p>You grant us a non-exclusive, worldwide, royalty-free licence to host, store, reproduce, format and display your User Content only as reasonably necessary to operate, moderate and improve the Service. This licence ends when the User Content is deleted from our systems, except for lawful backups, records or content incorporated into anonymised service-improvement data.</p>
                <p>We may moderate, hide or remove User Content that we reasonably consider unlawful, unsafe, misleading, abusive, irrelevant, infringing or inconsistent with these terms.</p>
            </section>
            <section class="section" id="ip" style="padding: 28px;">
                <div class="heading">
                    <span class="num">11</span>
                    <h2>Intellectual property</h2>
                </div>
                <p>The Service and its Content are owned by or licensed to MedExHub and are protected by copyright, trade mark and other intellectual property laws.</p>
                <p>Subject to these terms and payment of any applicable fee, we grant you a limited, revocable, non-exclusive, non-transferable licence to access and use the purchased Content for your personal, non-commercial examination preparation during the applicable access period.</p>
                <p>You may make limited personal study notes. You must not reproduce substantial parts of the question bank or distribute questions, answers, explanations, screenshots or other Content to another person or platform.</p>
                <p>Third-party materials remain owned by their respective owners and may be subject to separate attribution or licence conditions.</p>
            </section>
            <section class="section" id="disclaimer" style="padding: 28px;">
                <div class="heading">
                    <span class="num">12</span>
                    <h2>Educational and medical disclaimer</h2>
                </div>
                <p>MedExHub is an educational examination-preparation service. It is not a medical service, clinical decision-support system or substitute for professional judgement, current guidelines, institutional policies, supervision or independent verification.</p>
                <p>Content must not be used to diagnose, treat or manage a patient or as the sole basis for any clinical decision. Medication doses, clinical recommendations, classifications and guidelines may change over time and must be checked against authoritative current sources before clinical use.</p>
                <p>While we take reasonable care in developing and updating Content, we do not guarantee that all Content is complete, error-free or current at every time. You should report suspected errors so they can be reviewed.</p><p>We do not guarantee examination eligibility, examination results, a passing score, employment, registration or any particular outcome. Your performance depends on multiple factors outside our control.</p>
                <p>MedExHub is not affiliated with, endorsed by or acting for the Australasian College for Emergency Medicine (ACEM), the Royal Australian College of General Practitioners (RACGP), the Australian Medical Council (AMC) or any other examination body unless expressly stated.</p>
            </section>
            <section class="section" id="availability" style="padding: 28px;">
                <div class="heading">
                    <span class="num">13</span>
                    <h2>Availability, maintenance and changes to the Service</h2>
                </div>
                <p>We aim to provide reliable access but do not guarantee uninterrupted, error-free or continuous availability. Access may be affected by maintenance, updates, faults, internet conditions, third-party services, security events or circumstances beyond our reasonable control.</p>
                <p>We may update, replace, reorganise or remove individual questions, explanations or features to maintain quality, security and relevance. We will not materially reduce the core paid service during an active access period without a legitimate reason and an appropriate remedy where required by law.</p>
            </section>
            <section class="section" id="third-parties" style="padding: 28px;">
                <div class="heading">
                    <span class="num">14</span>
                    <h2>Third-party services and links</h2>
                </div>
                <p>The Service may contain links, embedded content or integrations provided by third parties. These are supplied for convenience or educational context and do not necessarily indicate endorsement.</p>
                <p>We do not control third-party websites or services. Your use of them is subject to their own terms, availability, security and privacy practices.</p>
            </section>
            <section class="section" id="privacy" style="padding: 28px;">
                <div class="heading">
                    <span class="num">15</span>
                    <h2>Privacy and communications</h2>
                </div>
                <p>Our collection, use, disclosure, storage and handling of personal information are described in our <a href="https://medextech.com.au/privacy">Privacy Policy</a>. Where applicable, we handle personal information in accordance with the Privacy Act 1988 (Cth) and the Australian Privacy Principles.</p>
                <p>We may send transactional communications needed to operate your Account or Subscription, including registration, payment, security, expiry and service messages. Marketing communications will be handled in accordance with applicable law and available preference controls.</p>
            </section>
            <section class="section" id="suspension" style="padding: 28px;">
                <div class="heading">
                    <span class="num">16</span>
                    <h2>Suspension and termination</h2>
                </div>
                <p>We may temporarily restrict, suspend or terminate access where we reasonably believe that:</p>
                <ul>
                    <li>you have materially or repeatedly breached these terms;</li>
                    <li>your Account is being shared, compromised or used fraudulently;</li>
                    <li>your conduct threatens the security, integrity or availability of the Service;</li>
                    <li>payment has been reversed, disputed or not validly completed; or</li>
                    <li>restriction is required by law or to protect another person’s rights.</li>
                </ul>
                <p>Where appropriate, we will provide notice and a reasonable opportunity to respond or correct the issue. Immediate action may be taken for serious security, fraud, unlawful conduct or intellectual property concerns.</p>
                <p>On expiry or termination, your right to access paid Content ends. Clauses intended by their nature to continue—including intellectual property, disclaimers, liability, indemnity and dispute provisions—survive termination.</p>
            </section>
            <section class="section" id="liability" style="padding: 28px;">
                <div class="heading">
                    <span class="num">17</span>
                    <h2>Consumer guarantees and limitation of liability</h2>
                </div>
                <p>Nothing in these terms excludes, restricts or modifies a consumer guarantee, right or remedy under the Australian Consumer Law or any other law where doing so would be unlawful.</p>
                <p>To the maximum extent permitted by law, MedExHub is not liable for indirect, incidental, special or consequential loss, loss of opportunity, loss of data, loss of income, examination failure or reputational loss arising from use of or inability to use the Service.</p>
                <p>Where our liability for a failure to comply with a guarantee can lawfully be limited, our liability is limited, at our option, to supplying the relevant service again or paying the reasonable cost of having the service supplied again.</p>
                <p>This clause does not apply to liability that cannot legally be excluded or limited, including liability arising from our fraud, wilful misconduct or any other matter for which limitation is prohibited by law.</p>
            </section>
            <section class="section" id="indemnity" style="padding: 28px;">
                <div class="heading">
                    <span class="num">18</span>
                    <h2>Your responsibility to us</h2>
                </div>
                <p>To the extent permitted by law, you are responsible for reasonable loss, damage, liability or expense we incur because of your unlawful use of the Service, infringement of another person’s rights, misuse of Content or material breach of these terms.</p>
                <p>This responsibility will be reduced to the extent that our acts or omissions caused or contributed to the loss.</p>
            </section>
            <section class="section" id="changes" style="padding: 28px;">
                <div class="heading">
                    <span class="num">19</span>
                    <h2>Changes to these terms</h2>
                </div>
                <p>We may update these terms to reflect changes to the Service, law, security practices or business operations. The updated version will be posted on this page with a revised effective date.</p>
                <p>Where a change materially affects an active paid Subscription, we will take reasonable steps to notify affected users before the change takes effect, unless urgent action is needed for legal or security reasons.</p>
                <p>Continued use after an updated version takes effect constitutes acceptance of the updated terms. This does not remove any rights or remedies you have under applicable law.</p>
            </section>
            <section class="section" id="general" style="padding: 28px;">
                <div class="heading">
                    <span class="num">20</span>
                    <h2>General provisions</h2>
                </div>
                <h3>Governing law</h3>
                <p>These terms are governed by the laws of Queensland, Australia. You and MedExHub submit to the non-exclusive jurisdiction of the courts of Queensland and courts entitled to hear appeals from them.</p>
                <h3>Severability</h3>
                <p>If any provision is invalid or unenforceable, it will be read down to the minimum extent necessary or severed, and the remaining provisions will continue.</p>
                <h3>No waiver</h3>
                <p>A delay or failure to enforce a right does not waive that right.</p>
                <h3>Assignment</h3>
                <p>You may not transfer your rights or obligations under these terms without our written consent. We may transfer our rights or obligations as part of a genuine business restructure, sale or transfer, provided this does not reduce your non-excludable legal rights.</p>
                <h3>Entire agreement</h3>
                <p>These terms, the Privacy Policy, the applicable checkout information and any additional terms expressly presented for a product form the agreement governing your use of the Service.</p>
            </section>
            <section class="contact" id="contact" style="padding: 28px;">
                <h2>21. Contact MedExHub</h2>
                <p>Contact us about these terms, your Account, a payment or a problem with the Service.</p>
                <div class="contact-grid">
                    <div class="contact-item">
                        <span>Entity</span>
                        <strong>MedExHub Pty Ltd</strong>
                    </div>
                    <div class="contact-item">
                        <span>ACN</span>
                        <strong>603 739 902</strong>
                    </div>
                    <div class="contact-item">
                        <span>Email</span>
                        <a href="mailto:enquiries@medexhub.com">enquiries@medexhub.com</a>
                    </div>
                    <div class="contact-item">
                        <span>Address</span>
                        <strong>4 Red Penda Court, Norman Gardens QLD 4701, Australia</strong>
                    </div>
                </div>
            </section>
        </article>
    </div>
</main>

<button class="up" id="up" type="button" aria-label="Back to top">↑</button>





<script>
document.addEventListener('DOMContentLoaded',()=>{const menu=document.getElementById('menu'),nav=document.getElementById('nav'),bar=document.getElementById('progress'),up=document.getElementById('up'),links=[...document.querySelectorAll('#toc a')],sections=links.map(a=>document.querySelector(a.getAttribute('href'))).filter(Boolean);menu.addEventListener('click',()=>{const open=nav.classList.toggle('open');menu.textContent=open?'✕':'☰'});document.addEventListener('click',e=>{if(innerWidth<=980&&!nav.contains(e.target)&&!menu.contains(e.target)){nav.classList.remove('open');menu.textContent='☰'}});function update(){const h=document.documentElement.scrollHeight-innerHeight;bar.style.width=(h>0?Math.min(100,scrollY/h*100):0)+'%';up.classList.toggle('show',scrollY>600);let id='';sections.forEach(s=>{if(s.getBoundingClientRect().top<=150)id=s.id});links.forEach(a=>a.classList.toggle('active',a.getAttribute('href')==='#'+id))}addEventListener('scroll',update,{passive:true});addEventListener('resize',update);update();up.addEventListener('click',()=>scrollTo({top:0,behavior:'smooth'}))});
</script>


@include('frontend.footer')
@include('frontend.index_footer')


