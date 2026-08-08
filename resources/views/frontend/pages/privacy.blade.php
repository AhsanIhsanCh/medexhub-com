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
        <div class="eyebrow"><span class="dot"></span>Privacy and data</div>
        <h1>Privacy Policy</h1>
        <p class="lead">How MedExHub collects, uses, stores, protects and shares personal information when you use our website and medical examination preparation services.</p>
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
                Approximately 9 minutes to read
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
                    <a href="#about">1. About this policy</a>
                    <a href="#information-collected">2. Information we collect</a>
                    <a href="#sensitive-information">3. Sensitive information</a>
                    <a href="#collection-methods">4. How we collect it</a>
                    <a href="#purposes">5. How we use it</a>
                    <a href="#payments">6. Payments</a>
                    <a href="#cookies">7. Cookies and analytics</a>
                    <a href="#disclosure">8. Who we share it with</a>
                    <a href="#overseas">9. Overseas handling</a>
                    <a href="#security">10. Security</a>
                    <a href="#retention">11 Retention and deletion</a>
                    <a href="#access">12. Access and correction</a>
                    <a href="#marketing">13. Marketing choices</a>
                    <a href="#complaints">14. Privacy complaints</a>
                    <a href="#contact">15. Changes and contact</a>                  
                </nav>
            </div>
            <div class="side-actions">
                <button class="btn btn-outline" onclick="window.print()">Print terms</button>
                <a class="btn btn-primary" href="/contact">Contact us</a>
            </div>
        </aside>
        <article>
            <div class="notice" >
                 <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <path d="M12 3 5 6v5c0 4.8 2.8 8.5 7 10 4.2-1.5 7-5.2 7-10V6l-7-3Zm0 5v4m0 4h.01"
                                  stroke="currentColor" stroke-width="1.8" stroke-linecap="round"
                                  stroke-linejoin="round"/>
                        </svg>
                <p>MedExHub is an examination-preparation service, not a clinical record system. Do not enter identifiable patient information in questions, discussions, support requests or other user-submitted content.</p>
            </div>
            <section class="section" id="about"  style="padding: 28px;">
                <div class="heading"><span class="num">1</span><h2>About this Privacy Policy</h2></div>
                <p>This Privacy Policy explains how <strong>MEDEXHUB PTY. LTD.</strong> (ACN 603 739 902), referred to as “MedExHub”, “we”, “us” or “our”, manages personal information when you visit our websites, create an account, purchase a subscription, complete examination questions, participate in discussions or contact us.</p>
                <p>We aim to manage personal information in accordance with the <strong>Privacy Act 1988 (Cth)</strong> and the Australian Privacy Principles where they apply to our activities.</p>
                <p>This policy applies to the MedExHub website and associated services. A third-party website or service linked from MedExHub is governed by its own privacy policy.</p>
            </section>
            <section class="section" id="information-collected"  style="padding: 28px;">
                <div class="heading"><span class="num">2</span><h2>Personal information we collect</h2></div>
                <p>The information we collect depends on the services and features you use. It may include:</p>
                <h3>Account and profile information</h3>
                <ul>
                    <li>your name, email address and account identifier;</li>
                    <li>a securely stored password hash and authentication information;</li>
                    <li>telephone number, date of birth, gender, country, city, postal address or profile image where you choose to provide them;</li>
                    <li>your medical examination pathway, subscription and account preferences; and</li>
                    <li>information used to confirm or recover your account.</li>
                </ul>
                <h3>Subscription and transaction information</h3>
                <ul>
                    <li>the products, examination resources and access periods you purchase;</li>
                    <li>transaction identifiers, payment status, amount, discount, refund and invoice information;</li>
                    <li>billing contact information; and</li>
                    <li>communications concerning a payment, renewal or refund.</li>
                </ul>
                <h3>Study and performance information</h3>
                <ul>
                    <li>questions attempted, answers selected and whether answers were correct;</li>
                    <li>scores, completion, timing, topic performance and progress;</li>
                    <li>study-mode and examination-mode sessions;</li>
                    <li>saved questions, flash cards, notes and revision preferences; and</li>
                    <li>discussion posts, votes, comments and other content you submit.</li>
                </ul>
                <h3>Communications and technical information</h3>
                <ul>
                    <li>support requests, feedback, complaints and correspondence;</li>
                    <li>IP address, browser, device type, operating system and approximate location derived from an IP address;</li>
                    <li>login records, security events, access times, referring pages and pages viewed;</li>
                    <li>cookie identifiers and analytics information; and</li>
                    <li>information required to diagnose errors, prevent abuse and maintain the service.</li>
                </ul>
            </section>
            <section class="section" id="sensitive-information"  style="padding: 28px;">
                <div class="heading"><span class="num">3</span><h2>Sensitive information and patient information</h2></div>
                <p>MedExHub does not require identifiable patient health information for ordinary use of its examination-preparation services and does not intend to operate as an electronic medical record.</p>
                <p>You must not include a patient’s name, date of birth, address, medical record number, images or other identifying details in a discussion, note, question, support message or uploaded material.Clinical examples should be fictional or appropriately de-identified.</p>
                <p>We will only collect sensitive information where it is reasonably necessary for our functions and permitted by law, including where valid consent has been provided or another legal exception applies.If sensitive information is sent to us when it is not required, we may delete or de-identify it where lawful and practicable.</p>
            </section>
            <section class="section" id="collection-methods"  style="padding: 28px;">
                <div class="heading"><span class="num">4</span><h2>How we collect personal information</h2></div>
                <p>We may collect personal information:</p>
                <ul>
                    <li>directly from you when you register, purchase access, update your profile, complete questions, post content or contact us;</li>
                    <li>automatically when you use the website, through server logs, cookies and similar technologies;</li>
                    <li>from a payment processor when it confirms a transaction, subscription, dispute or refund;</li>
                    <li>from an organisation purchasing or administering access for you, where applicable; and</li>
                    <li>from publicly available sources or service providers where lawful and reasonably necessary.</li>
                </ul>
                <p>You may browse some public parts of the website without identifying yourself. Certain services cannot be provided anonymously because an account, payment or progress record is required.</p>
            </section>
            <section class="section" id="purposes"  style="padding: 28px;">
                <div class="heading"><span class="num">5</span><h2>How we use personal information</h2></div>
                <p>We may use personal information to:</p>
                <ul>
                    <li>create, authenticate, administer and secure your account;</li>
                    <li>provide subscriptions, question banks, flash cards, examination sessions and other requested services;</li>
                    <li>record progress and generate scores, comparisons and performance insights;</li>
                    <li>process purchases, renewals, invoices, discounts and refunds;</li>
                    <li>respond to enquiries, technical issues, complaints and support requests;</li>
                    <li>send essential account, payment, security and service communications;</li>
                    <li>personalise study sessions and improve the relevance and usability of the platform;</li>
                    <li>analyse service performance, usage patterns and feature effectiveness;</li>
                    <li>detect, investigate and prevent fraud, account misuse, scraping, unauthorised sharing and security threats;</li>
                    <li>enforce our Terms and Conditions and protect our rights, users and systems;</li>
                    <li>comply with legal, regulatory, accounting and taxation obligations; and</li>
                    <li>carry out other purposes disclosed to you at the time of collection or with your consent.</li>
                </ul>
                <p>We may use aggregated or de-identified information for analytics, educational research, product planning and reporting where the information is no longer reasonably identifiable as relating to you.</p>
            </section>
            <section class="section" id="payments"  style="padding: 28px;">
                <div class="heading"><span class="num">6</span><h2>Payments and billing</h2></div>
                <p>Online payments may be processed by PayPal or another payment provider identified at checkout. Payment providers collect and process payment credentials under their own terms and privacy policies.</p>
                <p>MedExHub generally does not receive or store your complete payment card number. We may receive and retain limited transaction information, such as your payer name or email, transaction ID, amount, currency, payment status, refund status and subscription details, for account administration, fraud prevention, taxation and financial record-keeping.</p>
            </section>
            <section class="section" id="cookies"  style="padding: 28px;">
                <div class="heading"><span class="num">7</span><h2>Cookies, logs and analytics</h2></div>
                <p>We may use cookies, local storage, session identifiers, server logs and similar technologies to keep you signed in, remember preferences, maintain shopping and examination sessions, protect the website and understand how the service is used.</p>
                <p>These technologies may be used for:</p>
                <ul>
                    <li><strong>essential functions</strong>, including authentication, security, navigation and session continuity;</li>
                    <li><strong>preferences</strong>, including display and study settings;</li>
                    <li><strong>performance and analytics</strong>, including page usage, errors and service improvement; and</li>
                    <li><strong>communications measurement</strong>, such as whether a service email was delivered or opened, where supported.</li>
                </ul>
                <p>You may be able to block or delete cookies through your browser. Blocking essential cookies may prevent login, payment, question sessions or other parts of the website from functioning correctly.</p>
            </section>
            <section class="section" id="disclosure"  style="padding: 28px;">
                <div class="heading"><span class="num">8</span><h2>Disclosure of personal information</h2></div>
                <p>We do not sell personal information. We may disclose information where reasonably necessary to:</p>
                <ul>
                    <li>hosting, cloud infrastructure, database, backup and content-delivery providers;</li>
                    <li>payment processors, banks and fraud-prevention providers;</li>
                    <li>email, communications, analytics and customer-support providers;</li>
                    <li>IT, cybersecurity, development and professional service providers;</li>
                    <li>account administrators where an organisation has arranged your access;</li>
                    <li>government authorities, regulators, courts or law-enforcement bodies where required or authorised by law;</li>
                    <li>our insurers, accountants, auditors and legal advisers; and</li>
                    <li>a purchaser, investor or successor in connection with a proposed or completed business restructure, merger or sale, subject to appropriate confidentiality and legal safeguards.</li>
                </ul>
                <p>A discussion post, profile name or other content you deliberately publish in a shared feature may be visible to other authorised users. Do not publish information you wish to keep private.</p>
            </section>
            <section class="section" id="overseas"  style="padding: 28px;">
                <div class="heading"><span class="num">9</span><h2>Overseas storage and disclosure</h2></div>
                <p>Some technology, payment, email, analytics or support providers may store or process information outside Australia. The likely locations depend on the providers and infrastructure used at the relevant time.</p>
                <p>Where an overseas disclosure occurs and Australian privacy law applies, we take reasonable steps appropriate to the circumstances to ensure the recipient handles personal information consistently with applicable Australian privacy requirements, unless an exception applies.</p>
                <p>You may contact us for current information about the countries in which our principal service providers are likely to process personal information.</p>
            </section>
            <section class="section" id="security"  style="padding: 28px;">
                <div class="heading"><span class="num">10</span><h2>Security of personal information</h2></div>
                <p>We use administrative, technical and physical safeguards designed to protect personal information from misuse, interference, loss and unauthorised access, modification or disclosure.</p>
                <p>Depending on the information and system involved, safeguards may include:</p>
                <ul>
                    <li>access controls, account authentication and role-based permissions;</li>
                    <li>password hashing, secure connections and protective system configuration;</li>
                    <li>logging, monitoring, backups and vulnerability management;</li>
                    <li>restricted administrative access and confidentiality obligations; and</li>
                    <li>incident assessment and response procedures.</li>
                </ul>
                <p>No internet transmission or storage system can be guaranteed to be completely secure. You are responsible for protecting your password, signing out of shared devices and notifying us promptly if you suspect unauthorised access to your account.</p>
                <p>If a data breach is likely to result in serious harm and the Notifiable Data Breaches scheme applies, we will notify affected individuals and the Office of the Australian Information Commissioner as required by law.</p>
            </section>
            <section class="section" id="retention"  style="padding: 28px;">
                <div class="heading"><span class="num">11</span><h2>Retention, de-identification and deletion</h2></div>
                <p>We retain personal information only for as long as reasonably necessary for the purposes for which it was collected, to maintain legitimate business and security records, and to meet legal, taxation, accounting and dispute-resolution requirements.</p>
                <p>Retention periods vary according to the information. Account and study information may be retained while your account remains active and for a reasonable period afterwards. Financial transaction records may be retained for the period required by applicable law. Security logs and backups may be retained for limited operational cycles.</p>
                <p>When information is no longer required and no legal basis requires retention, we take reasonable steps to delete it or de-identify it. Deletion from active systems may not immediately remove information from encrypted backups, logs or records that must be retained by law.</p>
            </section>
            <section class="section" id="access"  style="padding: 28px;">
                <div class="heading"><span class="num">12</span><h2>Accessing and correcting your information</h2></div>
                <p>You may update certain account information through your profile. You may also request access to, or correction of, personal information we hold about you by emailing <a href="mailto:enquiries@medexhub.com" style="color: var(--primary); font-weight: 800;">enquiries@medexhub.com</a>.</p>
                <p>Please provide enough information for us to identify the relevant account and request. We may need to verify your identity before providing access or making a correction.</p>
                <p>We will respond within a reasonable period. In limited circumstances permitted by law, we may refuse access or correction. Where required, we will explain the reason and available complaint options.</p>
            </section>
            <section class="section" id="marketing"  style="padding: 28px;">
                <div class="heading"><span class="num">13</span><h2>Service messages and direct marketing</h2></div>
                <p>We may send operational communications needed to administer your account, such as registration, password, purchase, subscription, security, outage and policy notices. These are not marketing communications and may be necessary to provide the service.</p>
                <p>Where permitted, we may also send information about MedExHub products, free trials, examination resources or offers. You can opt out of marketing messages using the unsubscribe link in the message or by contacting us. Opting out of marketing will not stop essential service communications.</p>
            </section>
            <section class="section" id="complaints"  style="padding: 28px;">
                <div class="heading"><span class="num">14</span><h2>Privacy enquiries and complaints</h2></div>
                <p>If you believe we have mishandled your personal information, please send a written complaint describing what happened, the information involved and the outcome you are seeking.</p>
                <p>We will acknowledge and investigate the complaint and aim to respond within a reasonable period, generally within 30 days where practicable.</p>
                <p>If you are not satisfied with our response and the Privacy Act applies, you may be able to lodge a complaint with the <strong>Office of the Australian Information Commissioner (OAIC)</strong>. The OAIC generally expects you to complain to the organisation first.</p>
            </section>
            <section class="section" id="contact"  style="padding: 28px;">
                <div class="heading"><span class="num">15</span><h2>Changes to this policy and contact details</h2></div>
                <p>We may update this Privacy Policy to reflect changes to our services, technologies, providers or legal obligations. The revised version will be published on this page with an updated “Last updated” date. Material changes may also be notified through the website, your account or email where appropriate.</p>
                <h3>Privacy contact</h3>
                <p><strong>MEDEXHUB PTY. LTD.</strong><br>ACN 603 739 902<br>4 Red Penda Court<br>Norman Gardens QLD 4701<br>Australia</p>
                <p>Email:<a href="mailto:enquiries@medexhub.com" style="color: var(--primary); font-weight: 800;">enquiries@medexhub.com</a></p>
            </section>
        </article>
    </div>
</main>
<script>
document.addEventListener('DOMContentLoaded',()=>{const menu=document.getElementById('menu'),nav=document.getElementById('nav'),bar=document.getElementById('progress'),up=document.getElementById('up'),links=[...document.querySelectorAll('#toc a')],sections=links.map(a=>document.querySelector(a.getAttribute('href'))).filter(Boolean);menu.addEventListener('click',()=>{const open=nav.classList.toggle('open');menu.textContent=open?'✕':'☰'});document.addEventListener('click',e=>{if(innerWidth<=980&&!nav.contains(e.target)&&!menu.contains(e.target)){nav.classList.remove('open');menu.textContent='☰'}});function update(){const h=document.documentElement.scrollHeight-innerHeight;bar.style.width=(h>0?Math.min(100,scrollY/h*100):0)+'%';up.classList.toggle('show',scrollY>600);let id='';sections.forEach(s=>{if(s.getBoundingClientRect().top<=150)id=s.id});links.forEach(a=>a.classList.toggle('active',a.getAttribute('href')==='#'+id))}addEventListener('scroll',update,{passive:true});addEventListener('resize',update);update();up.addEventListener('click',()=>scrollTo({top:0,behavior:'smooth'}))});
</script>
@include('frontend.footer')
@include('frontend.index_footer')