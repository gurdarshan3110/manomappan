@extends('layouts.layout')

@section('content')


<section class="career-guide aos-init aos-animate" data-aos="fade-down" data-aos-delay="100">
        <div class="container">
            <div class="row">
                <nav style="--bs-breadcrumb-divider: '&gt;';" aria-label="breadcrumb">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Career Guide</a></li>
                        <li class="breadcrumb-item"><a href="#">Career Cluster 1</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><a href="#">Career 1</a></li>
                    </ol>
                </nav>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <h2>{{ $career->title }}</h2>
                    <p class="m-0">
                        Engineering is the application of scientific and
                        mathematical principles to design, build, and
                        improve structures, machines, systems, and
                        processes. It solves real-world problems, enhances
                        technology, and drives innovation across industries
                        like construction, electronics, energy, and
                        transportation, making it a vital force in shaping
                        modern life and future advancements.
                    </p>
                </div>
                <div class="col-md-6">
                    <div class="right-img">
                        <img src="images/blank-img2.png" class="img-fluid">

                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="career-engineer aos-init aos-animate" data-aos="fade-down" data-aos-delay="200">
        <div class="container">
            <h5>Table of content</h5>
            <div class="row">
                <div class="col-lg-3">
                    <div class="career-summary-lt">
                        <form>
                            <ul class="nav flex-column nav-pills" id="career-tab" role="tablist">
                                <li>
                                    <a href="#">
                                        <input type="radio" id="table1" name="radio-group" checked="" hidden="">
                                        <label for="table1" class="nav-link" id="tab1-tab" data-bs-toggle="pill" data-bs-target="#tab1" role="tab" aria-controls="tab1" aria-selected="false" tabindex="-1">
                                            Career Summary <img src="images/thumb-img.png" alt="">
                                        </label>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <input type="radio" id="table2" name="radio-group" hidden="">
                                        <label for="table2" class="nav-link" id="tab2-tab" data-bs-toggle="pill" data-bs-target="#tab2" role="tab" aria-controls="tab2" aria-selected="false" tabindex="-1">
                                            How to Start <img src="images/thumb-img.png" alt="">
                                        </label>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <input type="radio" id="table3" name="radio-group" hidden="">
                                        <label for="table3" class="nav-link" id="tab3-tab" data-bs-toggle="pill" data-bs-target="#tab3" role="tab" aria-controls="tab3" aria-selected="false" tabindex="-1">
                                            Entrance Exam <img src="images/thumb-img.png" alt="">
                                        </label>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <input type="radio" id="table4" name="radio-group" hidden="">
                                        <label for="table4" class="nav-link" id="tab4-tab" data-bs-toggle="pill" data-bs-target="#tab4" role="tab" aria-controls="tab4" aria-selected="false" tabindex="-1">
                                            Career Prospects <img src="images/thumb-img.png" alt="">
                                        </label>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <input type="radio" id="table5" name="radio-group" hidden="">
                                        <label for="table5" class="nav-link" id="tab5-tab" data-bs-toggle="pill" data-bs-target="#tab5" role="tab" aria-controls="tab5" aria-selected="false" tabindex="-1">
                                            Challenges and Skill Set Required <img src="images/thumb-img.png" alt="">
                                        </label>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <input type="radio" id="table6" name="radio-group" hidden="">
                                        <label for="table6" class="nav-link" id="tab6-tab" data-bs-toggle="pill" data-bs-target="#tab6" role="tab" aria-controls="tab6" aria-selected="false" tabindex="-1">
                                            FAQs <img src="images/thumb-img.png" alt="">
                                        </label>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <input type="radio" id="table7" name="radio-group" hidden="">
                                        <label for="table7" class="nav-link" id="tab7-tab" data-bs-toggle="pill" data-bs-target="#tab7" role="tab" aria-controls="tab7" aria-selected="false" tabindex="-1">
                                            Top colleges / institutions / universitiies <img src="images/thumb-img.png" alt="">
                                        </label>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <input type="radio" id="table8" name="radio-group" hidden="">
                                        <label for="table8" class="nav-link" id="tab8-tab" data-bs-toggle="pill" data-bs-target="#tab8" role="tab" aria-controls="tab8" aria-selected="false" tabindex="-1">
                                            Market Trend and Salary <img src="images/thumb-img.png" alt="">
                                        </label>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <input type="radio" id="table9" name="radio-group" hidden="">
                                        <label for="table9" class="nav-link" id="tab9-tab" data-bs-toggle="pill" data-bs-target="#tab9" role="tab" aria-controls="tab9" aria-selected="false" tabindex="-1">
                                            Pros and Cons <img src="images/thumb-img.png" alt="">
                                        </label>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <input type="radio" id="table10" name="radio-group" hidden="">
                                        <label for="table10" class="nav-link active" id="tab10-tab" data-bs-toggle="pill" data-bs-target="#tab10" role="tab" aria-controls="tab10" aria-selected="true">
                                            Stalwarts of the Career <img src="images/thumb-img.png" alt="">
                                        </label>
                                    </a>
                                </li>

                            </ul>
                        </form>
                    </div>
                </div>

                <div class="col-lg-9">
                    <div class="career-summary-rt tab-content" id="career-tabContent">
                        <div class="tab-pane fade" id="tab1" role="tabpanel" aria-labelledby="tab1-tab">
                            <div class="career-summary-rt">
                                <h3>Career Summary</h3>
                                <div class="section-box">
                                    <h4>Industry Demand</h4>
                                    <p>
                                        CAs are in high demand across industries –
                                        from Big 4 accounting firms to banks,
                                        consultancies, and corporates.
                                        As of 2024, ICAI has over 4,00,000 members
                                        and nearly 85,000 students/enrolled,
                                        reflecting the large scale and continued
                                        interest in this career.
                                    </p>
                                </div>
                                <div class="section-box">
                                    <h4>Role &amp; Recognition</h4>
                                    <p>
                                        CAs are authorized to audit financial
                                        statements of companies as per law.
                                        They ensure compliance with accounting
                                        standards and tax laws.
                                        Known as trusted financial advisors, they
                                        often hold top positions like CFOs, finance
                                        directors, and auditors in firms.
                                    </p>
                                </div>
                                <div class="section-box">
                                    <h4>Professional Accountancy Credential</h4>
                                    <p>
                                        Chartered Accountancy is a prestigious
                                        accounting qualification in India, regulated
                                        by the Institute of Chartered Accountants of
                                        India (ICAI) (est. 1949).
                                        CAs are experts in financial reporting,
                                        auditing, taxation, and business strategy.
                                    </p>
                                </div>
                                <div class="section-box">
                                    <h4>Global Opportunities</h4>
                                    <p>
                                        Indian CAs have recognition in a few
                                        countries via MOUs (e.g., with CPA
                                        Australia, England &amp; Wales etc.), enabling
                                        global mobility.
                                        Many CAs also pursue international
                                        credentials (like CPA (USA) or ACCA) to
                                        expand their opportunities.
                                    </p>
                                </div>

                            </div>

                        </div>
                        <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="tab2-tab">

                            <div class="timeline-wrapper">
                                <h3>How to start</h3>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                       <div class="section-box time-line">                                    
                                            <h4>Eligibility</h4>
                                            <p>
                                                Commerce students can register for the CA program after Class 12. Graduates
                                                (Commerce with 255% or others with 260%) can avail the direct entry route,
                                                skipping
                                                the entry-level exam.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="section-box time-line">
                                            <h4>Course Registration</h4>
                                            <p>
                                               Enroll with ICAI for the CA Foundation course after 12th. If via direct entry (after graduation), register for CA Intermediate directly
                                            </p>
                                        </div>
                                    </div>
                                </div>  
                                <div class="col-md-12">
                                    <div class="section-box time-line"> 
                                        <h4>Course Registration</h4>
                                        <p>
                                            Upon clearing either both groups or Group 1 of Intermediate, students must undergo 3 years of Articleship (practical training under a practicing CA). This on-the-job training is a mandatory and integral part of becoming a CA.
                                        </p>
                                    </div>
                                </div>   
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="section-box time-line last-line">                                    
                                            <h4>Progression</h4>
                                            <p>
                                                Upon clearing either both groups or Group 1 of Intermediate, students must undergo 3 years of Articleship (practical training under a practicing CA). This on-the-job training is a mandatory and integral part of becoming a CA.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>        

                        </div>
                        <div class="tab-pane fade" id="tab3" role="tabpanel" aria-labelledby="tab3-tab">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="career-summary-rt">
                                        <h3>Entrance Exam</h3>
                                        <div class="section-box">
                                            <h4>CA Foundation</h4>
                                            <p>
                                                Entry-level test covering Accounting, Law, Economics, and Mathematics.
                                                It has objective and
                                                subjective questions. Preparation: 4-6 months of study; focus on basics
                                                of accounting and
                                                mercantile law learned in Class 11-12.
                                            </p>
                                        </div>
                                        <div class="section-box">
                                            <h4>CA Intermediate</h4>
                                            <p>
                                                Divided into Group I and II (8 papers total) subjects like Advanced
                                                Accounting, Corporate Law,
                                                Cost Accounting, Taxation, Auditing, etc. Preparation: Typically
                                                requires coaching or self-study for
                                                9-12 months. Emphasis on understanding concepts and practicing past
                                                papers.
                                            </p>
                                        </div>
                                        <div class="section-box">
                                            <h4>CA Final</h4>
                                            <p>
                                                The final stage (8 papers across Group I and II) covers Financial
                                                Reporting, Strategic Financial
                                                Management, Advanced Auditing, Corporate &amp; Allied Laws, Taxation (direct
                                                &amp; indirect), and
                                                electives like International Taxation, Risk Management, etc.
                                                Preparation: 4-6 months after
                                                articleship or during its last year, with extensive revision. Case study
                                                approach and practical
                                                application is key
                                            </p>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="difficulty-level">
                                        <h3>Difficulty Level</h3>
                                        <div class="section-box-d">
                                            <ul>
                                                <li>
                                                    CMA exams are considered
                                                    moderately tough. Pass percentages
                                                    are slightly better than CA on average
                                                    but still challenging. For instance, in
                                                    Dec 2024: 13. CMA Inter Group-1 pass
                                                    rate was 16.1% and Group-2 was 28.7%.
                                                </li>
                                                <li>
                                                    CMA Final Group-1 was 14.7% and
                                                    Group-2 ~50.9% (the latter often
                                                    higher as many take one group at a
                                                    time).
                                                </li>
                                                <li>
                                                    Combining groups or clearing all at
                                                    once is harder (pass % for both
                                                    groups together is usually around
                                                    10-15%). Thus, preparation needs to
                                                    be thorough; many take one group
                                                    per attempt for focus.
                                                </li>
                                            </ul>

                                        </div>
                                        <h3 class="mt-3">Preparation Tips</h3>
                                        <div class="section-box-d d2">
                                            <ul>
                                                <li>
                                                    Due to the vast syllabus, students often
                                                    join coaching classes or use online test
                                                    series. Consistent study, revision of ICAI
                                                    study material, and solving mock exams
                                                    are essential. Many attempt multiple
                                                    revisions and practice under timed
                                                    conditions.
                                                </li>
                                            </ul>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab4" role="tabpanel" aria-labelledby="tab4-tab">


                            <h3>Career Prospects</h3>
                            <div class="section-box">
                                <h4>Job roles</h4>
                                <p> Chartered Accountants can work in varied roles. </p>
                                <p><b>Audit and Assurance:</b> Auditor in audit firms (including Big 4s) or internal
                                    auditor in companies.</p>
                                <p><b>Taxation:</b> Tax consultant or corporate tax planner handling direct and indirect
                                    taxes (GST, Income Tax). </p>
                                <p><b>Finance &amp; Accounts:</b> Financial accountant, controller, or manager maintaining
                                    books, financial statements, and compliance.</p>
                                <p><b>Corporate Finance:</b> Roles in mergers &amp; acquisitions, financial analysis,
                                    investment banking, due diligence. 6. Consulting: Advisory services in
                                    accounting, risk management, or management consulting.</p>
                                <p><b>Entrepreneurship/Practice:</b> : Many CAs start their own CA firm offering
                                    auditing, tax filing, and advisory services. As practitioners, they can sign audit
                                    reports and represent clients in tax matters.</p>

                            </div>
                            <div class="section-box">
                                <h4>Growth path</h4>
                                <p>
                                    A fresh CA might start as an Assistant Manager or Associate (Audit/Tax). With
                                    experience, they move up to Manager, Senior Manager, and could
                                    become Partner in a firm or Chief Financial Officer (CFO)/Finance Head in a company.
                                    CAs often climb to top management; e.g. many CEOs and
                                    CFOs in India s top companies are CAs by qualification
                                </p>
                            </div>
                            <div class="section-box">
                                <h4>Further Studies &amp; Certifications</h4>
                                <p> After CA, professionals often enhance their profile through: </p>
                                <p><b>Post-Qualification Courses:</b> Offered by ICAI in fields like Information Systems
                                    Audit (ISA), Insolvency, Forensic Accounting, etc. </p>
                                <p><b>International Certifications:</b> CPA (USA) or ACCA (UK) to work abroad, CFA
                                    (Chartered Financial Analyst) for investment roles, or CMA (Certified
                                    Management Accountant) for cost accounting. </p>
                                <p><b>Masters/MBA: </b>Some CAs pursue an MBA (often from IIMs/ISB or global B-schools)
                                    to gain managerial skills, though CA itself is considered
                                    equivalent to a PG qualification</p>

                            </div>
                            <div class="section-box">
                                <h4>Public Sector &amp; Academics</h4>
                                <p>
                                    CAs can join government services (e.g. Indian Accounting Services, CAG office)
                                    through UPSC. They can also become academics or trainers for CA
                                    students.
                                </p>
                            </div>
                            <div class="section-box">
                                <h4>Career Outlook</h4>
                                <p>
                                    The qualification has a versatile scope, allowing one to switch between industry
                                    domains (e.g., from audit to investment banking) with some
                                    upskilling. The demand for CAs in specialized areas like International Taxation,
                                    IFRS, and Financial Forensics is rising with changes in regulation.
                                </p>
                            </div>


                        </div>
                        <div class="tab-pane fade" id="tab5" role="tabpanel" aria-labelledby="tab5-tab">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="career-summary-rt c">
                                        <h3>Challenges</h3>
                                        <div class="section-box-c">
                                            <h4>Exam Rigor</h4>
                                            <p>
                                                The CA exam sequence (especially Intermediate and Final) is
                                                extremely challenging. Low pass percentages mean students often
                                                face failures and repeats, requiring resilience
                                            </p>
                                        </div>
                                        <div class="section-box-c">
                                            <h4>Time &amp; Workload</h4>
                                            <p>
                                                Balancing the 3-year articleship (full-time training) with study for CA
                                                Final is tough. Long hours during audit/tax season, along with study
                                                pressure, test time management and endurance.
                                            </p>
                                        </div>
                                        <div class="section-box-c">
                                            <h4>Extensive Syllabus</h4>
                                            <p>
                                                The syllabus breadth (accounting, law, tax, finance) demands both
                                                memorization and deep understanding. Keeping updated with
                                                frequent changes in tax laws and accounting standards (e.g. GST
                                                amendments, IND-AS/IFRS updates) is continuous effort.
                                            </p>
                                        </div>
                                        <div class="section-box-c">
                                            <h4>Exam Rigor</h4>
                                            <p>
                                                The CA exam sequence (especially Intermediate and Final) is
                                                extremely challenging. Low pass percentages mean students often
                                                face failures and repeats, requiring resilience.
                                            </p>
                                        </div>
                                        <div class="section-box-c">
                                            <h4>Articleship Stipend</h4>
                                            <p>
                                                The training is modestly paid. Many students face financial
                                                constraints during this period and also heavy workload with strict
                                                seniors, which is a learning but can be stressful.
                                            </p>
                                        </div>
                                        <div class="section-box-c">
                                            <h4>Attempts Pressure</h4>
                                            <p>
                                                It s common to clear some groups in multiple attempts. The social
                                                and self-imposed pressure of completing CA quickly can be
                                                challenging. Mental stamina to handle setbacks is required.
                                            </p>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="career-summary-rt">
                                        <h3>Skills Required</h3>
                                        <div class="section-box">
                                            <h4>Accounting &amp; Analytical Skills</h4>
                                            <p>
                                                Strong grasp of accounting principles, ability to analyze financial
                                                data, and attention to detail. CAs must detect discrepancies and
                                                ensure accuracy to the last rupee.
                                            </p>
                                        </div>
                                        <div class="section-box">
                                            <h4>Conceptual Understanding of Law</h4>
                                            <p>
                                                Since CAs deal with corporate laws and tax laws, understanding legal
                                                frameworks and interpreting statutes is crucial.
                                            </p>
                                        </div>
                                        <div class="section-box">
                                            <h4>Numerical Ability</h4>
                                            <p>
                                                Comfort with numbers and complex calculations (for finance, costing,
                                                etc.) is a must. High proficiency in Excel and financial modeling is
                                                increasingly important.
                                            </p>
                                        </div>
                                        <div class="section-box">
                                            <h4>Ethics &amp; Integrity</h4>
                                            <p>
                                                Upholding ethical standards and confidentiality is fundamental (ICAI
                                                has a strict Code of Ethics). CAs often face ethical dilemmas, and
                                                integrity is key to maintain public trust
                                            </p>
                                        </div>
                                        <div class="section-box">
                                            <h4>Soft Skills</h4>
                                            <p>
                                                Communication skills to explain financial info to non-finance people,
                                                and good writing skills for reports. Interpersonal skills help during
                                                articleship (dealing with clients, teams) and later when leading
                                                teams or advising clients
                                            </p>
                                        </div>
                                        <div class="section-box">
                                            <h4>Continuous Learning</h4>
                                            <p>
                                                The finance world changes rapidly (new laws, new accounting
                                                standards). CAs need a mindset of lifelong learning (ICAI mandates
                                                Continuing Professional Education hours). Adaptability to new tools
                                                (like data analytics, AI in audit) is also increasingly important.
                                            </p>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab6" role="tabpanel" aria-labelledby="tab6-tab">
                            <h3 class="faq-title">FAQs</h3>

                            <div class="accordion" id="faqAccordion">
                                <div class="accordion-item mb-3 rounded">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                            How long does it take to become a CA?
                                        </button>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#faqAccordion" style="">
                                        <div class="accordion-body">
                                            <p>............</p>
                                        </div>
                                    </div>
                                </div>


                                <div class="accordion-item mb-3 rounded">
                                    <h2 class="accordion-header" id="headingTwo">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            <b>What is the passing criteria for CA exams?</b>
                                        </button>
                                    </h2>
                                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#faqAccordion" style="">
                                        <div class="accordion-body">
                                            <p>
                                                A candidate needs 40% marks in each paper and 50% aggregate in each
                                                group to
                                                pass. For example, in a group of 4 papers, one must score at
                                                least 40 in each and total of 200/400. If one fails one paper or the
                                                aggregate, the entire group is considered failed and must be retaken.
                                            </p>
                                        </div>
                                    </div>
                                </div>


                                <div class="accordion-item mb-3 rounded">
                                    <h2 class="accordion-header" id="headingThree">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                            Is Articleship mandatory? Can it be skipped?
                                        </button>
                                    </h2>
                                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#faqAccordion" style="">
                                        <div class="accordion-body">
                                            <p>..........</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item mb-3 rounded">
                                    <h2 class="accordion-header" id="headingFour">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                             How much stipend is paid during Articleship?
                                        </button>
                                    </h2>
                                    <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#faqAccordion">
                                        <div class="accordion-body">
                                            <p>..........</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item mb-3 rounded">
                                    <h2 class="accordion-header" id="headingFive">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                            What is the average salary of a newly qualified CA?
                                        </button>
                                    </h2>
                                    <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#faqAccordion" style="">
                                        <div class="accordion-body">
                                            <p>..........</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item mb-3 rounded">
                                    <h2 class="accordion-header" id="headingSix">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="true" aria-controls="collapseSix">
                                            How long does it take to become a CA?
                                        </button>
                                    </h2>
                                    <div id="collapseSix" class="accordion-collapse collapse show" aria-labelledby="headingSix" data-bs-parent="#faqAccordion" style="">
                                        <div class="accordion-body">
                                            <p>..........</p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab7" role="tabpanel" aria-labelledby="tab7-tab">
                            <div class="career-summary-tc">
                                <h3 class="">Top colleges / institutions / universities</h3>
                                <div class="row gx-2">
                                    <div class="col-md-4">
                                        <div class="section-box-c">
                                            <h4>Institute of Chartered Accountants of India (ICAI)</h4>
                                            <p>
                                                New Delhi (Headquarters): The statutory
                                                body that conducts the CA exams and
                                                awards the CA designation. Training and
                                                curriculum are managed by ICAI through
                                                its branches and study centers across
                                                India. (Every CA aspirant must register
                                                with ICAI.)
                                            </p>
                                        </div>
                                    </div> 
                                    <div class="col-md-4">
                                        <div class="section-box-c">
                                            <h4>Hindu College</h4>
                                            <p>
                                                Delhi University: Another top-ranked
                                                college in Delhi with excellent commerce
                                                and economics departments; a number
                                                of students clear CA alongside their
                                                degree
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-4"> 
                                        <div class="section-box-c">
                                            <h4>St. Xavier s College, Kolkata</h4>
                                            <p>
                                                Historic institution with a strong
                                                commerce faculty. Has produced several
                                                CA rank holders; offers B.Com (Hons) that
                                                complements CA syllabus.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-4"> 
                                        <div class="section-box-c">
                                            <h4>Narsee Monjee College of
                                                Commerce &amp; Economics</h4>
                                            <p>
                                                Mumbai: One of Mumbai s top commerce
                                                colleges. It s known for a high
                                                concentration of CA aspirants and
                                                consistent guidance for courses like CA/
                                                CMA
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-4"> 
                                        <div class="section-box-c">
                                            <h4>Narsee Monjee College of
                                                Commerce &amp; Economics</h4>
                                            <p>
                                                Mumbai: One of Mumbai s top commerce
                                                colleges. It s known for a high
                                                concentration of CA aspirants and
                                                consistent guidance for courses like CA/
                                                CMA.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="section-box-c">
                                            <h4>Shri Ram College of Commerce (SRCC)</h4>
                                            <p>
                                                - Delhi University: India s premier
                                                commerce college. Many SRCC B.Com
                                                (Hons) students also pursue CA; known
                                                for its rigorous academics in accounting
                                                and finance
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-4"> 
                                        <div class="section-box-c">
                                            <h4>Hansraj College</h4>
                                            <p>
                                                Delhi University: Known for B.Com and BA
                                                (Hons) Economics; has produced many
                                                CAs. Offers good facilities and flexibility to
                                                pursue professional courses concurrently.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">   
                                        <div class="section-box-c">
                                            <h4>St. Xavier s College,
                                                Mumbai</h4>
                                            <p>
                                                Prestigious college with a vibrant
                                                commerce department. Located in
                                                financial hub Mumbai, giving students
                                                exposure and internship opportunities in
                                                accounting firms.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="section-box-c">
                                            <h4>Narsee Monjee College of
                                                Commerce &amp; Economics</h4>
                                            <p>
                                                Mumbai: One of Mumbai s top commerce
                                                colleges. It s known for a high
                                                concentration of CA aspirants and
                                                consistent guidance for courses like CA/
                                                CMA.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="section-box-c">
                                            <h4>Lady Shri Ram College for
                                                Women (LSR)</h4>
                                            <p>
                                                Delhi University: Top women s college for
                                                commerce/economics; provides a strong
                                                foundation for CA aspirants with its
                                                commerce curriculum.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-4"> 
                                        <div class="section-box-c">
                                            <h4>Loyola College</h4>
                                            <p>
                                                Chennai: Renowned commerce program
                                                (often ranked #1 in India Today rankings).
                                                Many students attend CA coaching while
                                                studying here.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="section-box-c">
                                            <h4>Narsee Monjee College of
                                                Commerce &amp; Economics
                                            </h4>
                                            <p>
                                                Mumbai: One of Mumbai s top commerce
                                                colleges. It s known for a high
                                                concentration of CA aspirants and
                                                consistent guidance for courses like CA/
                                                CMA.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-4"> 
                                        <div class="section-box-c">
                                            <h4>Narsee Monjee College of
                                                Commerce &amp; Economics</h4>
                                            <p>
                                                Mumbai: One of Mumbai s top commerce
                                                colleges. It s known for a high
                                                concentration of CA aspirants and
                                                consistent guidance for courses like CA/
                                                CMA.
                                            </p>
                                        </div>
                                    </div>  
                                </div>
                                <p>(Note: The CA qualification is granted by ICAI, not by colleges. Students usually
                                        enroll in a college for a degree like B.Com and
                                        simultaneously pursue the CA exams. Below are the key institute and colleges
                                        known for commerce education or CA coaching in
                                        India.)</p>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab8" role="tabpanel" aria-labelledby="tab8-tab">

                            <h3 class="faq-title">Market Trend and Salary</h3>

                            <div class="accordion" id="faqAccordion1">

                                <div class="accordion-item mb-3 rounded">
                                    <h2 class="accordion-header" id="headingSeven">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                                            Supply &amp; Demand
                                        </button>
                                    </h2>
                                    <div id="collapseSeven" class="accordion-collapse collapse" aria-labelledby="headingSeven" data-bs-parent="#faqAccordion1">
                                        <div class="accordion-body">
                                            <p>............</p>
                                        </div>
                                    </div>
                                </div>


                                <div class="accordion-item mb-3 rounded">
                                    <h2 class="accordion-header" id="headingEight">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                                            Salary Growth
                                        </button>
                                    </h2>
                                    <div id="collapseEight" class="accordion-collapse collapse" aria-labelledby="headingEight" data-bs-parent="#faqAccordion1" style="">
                                        <div class="accordion-body">
                                            <p>
                                                : Over the years, CA starting salaries have seen an uptick. A decade
                                                ago, a fresh CA might earn ₹6-7 LPA in industry jobs. Now, average
                                                packages
                                                are closer to ₹9-10 LPA. In ICAI's recent campus placement (2024), the
                                                average CTC offered was about ₹12.5 LPA to new CAs and the highest
                                                domestic salary reached ~₹26-29 LPA. (A slight drop from previous high
                                                due to market conditions, as the prior year saw ₹29 LPA highest.) Top
                                                consulting companies and investment banks sometimes offer even higher
                                                packages for exceptional candidates or those with niche skills (e.g.,
                                                valuations, risk).
                                            </p>
                                        </div>
                                    </div>
                                </div>


                                <div class="accordion-item mb-3 rounded">
                                    <h2 class="accordion-header" id="headingNine">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseNine" aria-expanded="false" aria-controls="collapseNine">
                                            Changing Trends
                                        </button>
                                    </h2>
                                    <div id="collapseNine" class="accordion-collapse collapse" aria-labelledby="headingNine" data-bs-parent="#faqAccordion1" style="">
                                        <div class="accordion-body">
                                            <p>..........</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item mb-3 rounded">
                                    <h2 class="accordion-header" id="headingTen">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTen" aria-expanded="false" aria-controls="collapseTen">
                                            Quantitative Data
                                        </button>
                                    </h2>
                                    <div id="collapseTen" class="accordion-collapse collapse" aria-labelledby="headingTen" data-bs-parent="#faqAccordion1">
                                        <div class="accordion-body">
                                            <p>..........</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item mb-3 rounded">
                                    <h2 class="accordion-header" id="headingEleven">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEleven" aria-expanded="false" aria-controls="collapseEleven">
                                            Members
                                        </button>
                                    </h2>
                                    <div id="collapseEleven" class="accordion-collapse collapse" aria-labelledby="headingEleven" data-bs-parent="#faqAccordion1">
                                        <div class="accordion-body">
                                            <p>..........</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item mb-3 rounded">
                                    <h2 class="accordion-header" id="headingTwelve">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwelve" aria-expanded="false" aria-controls="collapseTwelve">
                                            Pass Rate
                                        </button>
                                    </h2>
                                    <div id="collapseTwelve" class="accordion-collapse collapse" aria-labelledby="headingTwelve" data-bs-parent="#faqAccordion1">
                                        <div class="accordion-body">
                                            <p>..........</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item mb-3 rounded">
                                    <h2 class="accordion-header" id="headingThirteen">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThirteen" aria-expanded="false" aria-controls="collapseThirteen">
                                            Salary Trend
                                        </button>
                                    </h2>
                                    <div id="collapseThirteen" class="accordion-collapse collapse" aria-labelledby="headingThirteen" data-bs-parent="#faqAccordion1">
                                        <div class="accordion-body">
                                            <p>..........</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item mb-3 rounded">
                                    <h2 class="accordion-header" id="headingFourteen">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFourteen" aria-expanded="false" aria-controls="collapseFourteen">
                                            Career Progression Salary
                                        </button>
                                    </h2>
                                    <div id="collapseFourteen" class="accordion-collapse collapse" aria-labelledby="headingFourteen" data-bs-parent="#faqAccordion1">
                                        <div class="accordion-body">
                                            <p>..........</p>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                        <div class="tab-pane fade" id="tab9" role="tabpanel" aria-labelledby="tab9-tab">
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="career-summary-rt">
                                        <h3>Pros</h3>
                                        <div class="section-box">
                                            <h4>High Prestige &amp; Trust</h4>
                                            <p>
                                                CAs are highly respected finance professionals, often seen as the
                                                financial backbone of companies. The title carries social esteem due
                                                to the rigorous qualification
                                            </p>
                                        </div>
                                        <div class="section-box">
                                            <h4>Strong Professional Network</h4>
                                            <p>
                                                ICAI is one of the largest professional bodies. CAs benefit from a vast
                                                network of colleagues, mentorship from seniors, and access to
                                                knowledge portals. This network often helps in career advancement
                                                and business opportunities.
                                            </p>
                                        </div>
                                        <div class="section-box">
                                            <h4>Versatile Opportunities</h4>
                                            <p>
                                                The qualification opens doors to diverse roles – audit, taxation,
                                                advisory, finance, banking, etc. One can switch industries (e.g., from
                                                consulting to manufacturing sector) relatively easily, as accounting
                                                skills are transferable
                                            </p>
                                        </div>
                                        <div class="section-box">
                                            <h4>Self-Employment Potential</h4>
                                            <p>
                                                After becoming a CA, one can start an independent practice. Being
                                                your own boss, handling clients directly, and building a firm is a
                                                viable
                                                path. Many top CA practitioners handle lucrative assignments in
                                                audit and tax
                                            </p>
                                        </div>
                                        <div class="section-box">
                                            <h4>Financially Rewarding
                                            </h4>
                                            <p>
                                                In the long-term, a CA qualification can be very remunerative. As
                                                seen, CAs typically earn well above average Indian salaries, and
                                                growth is exponential with experience. Also, the cost of the CA course
                                                is relatively low (ICAI fees), so return on investment is high
                                            </p>
                                        </div>
                                        <div class="section-box">
                                            <h4>Continuous Learning</h4>
                                            <p>
                                                The finance world changes rapidly (new laws, new accounting
                                                standards). CAs need a mindset of lifelong learning (ICAI mandates
                                                Continuing Professional Education hours). Adaptability to new tools
                                                (like data analytics, AI in audit) is also increasingly important.
                                            </p>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="career-summary-rt c">
                                        <h3>Cons</h3>
                                        <div class="section-box-c">
                                            <h4>Difficult Qualification Process</h4>
                                            <p>
                                                The CA exams are extremely tough with low pass rates. Students
                                                often face uncertainty, stress, and potentially years of study. The
                                                pressure can affect mental health. It s not uncommon to spend 4 6
                                                years and still not qualify, which can be demotivating.
                                            </p>
                                        </div>
                                        <div class="section-box-c">
                                            <h4>Long Training Period</h4>
                                            <p>
                                                Including articleship, it can take 4 5+ years to start earning as a
                                                qualified CA. Peers who took other courses (like engineers or MBAs)
                                                might start earning earlier, which can be a concern for some.
                                            </p>
                                        </div>
                                        <div class="section-box-c">
                                            <h4>Work Life Imbalance (at times)</h4>
                                            <p>
                                                Certain career phases (especially in audit firms or during financial
                                                year-end and tax filing season) require very long working hours.
                                                Working 12-15 hour days or weekends during audit season or before
                                                tax deadlines is common. This can lead to burnout if not managed.
                                            </p>
                                        </div>
                                        <div class="section-box-c">
                                            <h4>Continuous Responsibility</h4>
                                            <p>
                                                As a CA (especially if practicing or in key company roles), one
                                                shoulders significant legal and ethical responsibility. Signing an audit
                                                report means taking accountability for its accuracy. Any negligence
                                                can lead to professional misconduct penalties. This constant
                                                pressure to get it right can be stressful.
                                            </p>
                                        </div>
                                        <div class="section-box-c">
                                            <h4>Need for Ongoing Education</h4>
                                            <p>
                                                Laws and standards change frequently. For example, introduction of
                                                GST overhauled indirect tax practice; IND-AS aligned accounting with
                                                IFRS. CAs must continuously study new standards, which can be
                                                demanding even after qualification (exams end, but learning never
                                                does).
                                            </p>
                                        </div>
                                        <div class="section-box-c">
                                            <h4>Geographical Concentration</h4>
                                            <p>
                                                Big opportunities can be metro-centric (Mumbai, Delhi, Bangalore).
                                                Those in smaller towns may have fewer top-tier corporate
                                                opportunities (though they can still have a successful practice). This
                                                may require relocation for career growth.
                                            </p>
                                        </div>
                                        <div class="section-box-c">
                                            <h4>Competitive Industry</h4>
                                            <p>
                                                With many CAs qualifying each year (though limited, still 10k/year),
                                                competition for the best jobs (Big 4, MNCs) can be intense. Additional
                                                skills or qualifications are often needed to stand out.
                                            </p>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="tab-pane fade active show" id="tab10" role="tabpanel" aria-labelledby="tab10-tab">
                            <div class="career-summary-rt">
                                <h3 class="">Stalwarts of the Career</h3>
                                <p>(Notable Chartered Accountants who have made a mark in various fields. Many have public social media profiles sharing insights.)</p>
                                <div class="row gx-2">
                                    <div class="col-md-4">
                                        <div class="stalwarts-box">
                                            <div class="profile-img">
                                                <img src="images/profile-img.png">
                                            </div>
                                            <h4>Piyush Goyal</h4>
                                            <ul>
                                                <li>
                                                    <a href="mailto:@piyushgoyalofficial"><span><img src="images/insta.png"></span>@piyushgoyalofficial(verified)</a>
                                                </li>
                                                <li>
                                                    <a href="mailto:@piyushgoyalofficial"><span><img src="images/twitter.png"></span>@piyushgoyalofficial(verified)</a>
                                                </li>
                                            </ul>
                                            <p>
                                               Note: He is a prominent politician in India and a qualified CA, illustrating the versatility of CAs beyond corporate roles. As a Minister of Commerce &amp; Industry, he often credits his financial training for his administrative acumen.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="stalwarts-box">
                                           <div class="profile-name">
                                                <h3>PG</h3>
                                            </div>
                                            <h4>Piyush Goyal</h4>
                                            <ul>
                                                <li>
                                                    <a href="mailto:@piyushgoyalofficial"><span><img src="images/insta.png"></span>@piyushgoyalofficial(verified)</a>
                                                </li>
                                                <li>
                                                    <a href="mailto:@piyushgoyalofficial"><span><img src="images/twitter.png"></span>@piyushgoyalofficial(verified)</a>
                                                </li>
                                            </ul>
                                            <p>
                                               Note: He is a prominent politician in India and a qualified CA, illustrating the versatility of CAs beyond corporate roles. As a Minister of Commerce &amp; Industry, he often credits his financial training for his administrative acumen.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="stalwarts-box">
                                            <div class="profile-img">
                                                <img src="images/profile-img.png">
                                            </div>
                                            <h4>Piyush Goyal</h4>
                                            <ul>
                                                <li>
                                                    <a href="mailto:@piyushgoyalofficial"><span><img src="images/insta.png"></span>@piyushgoyalofficial(verified)</a>
                                                </li>
                                                <li>
                                                    <a href="mailto:@piyushgoyalofficial"><span><img src="images/twitter.png"></span>@piyushgoyalofficial(verified)</a>
                                                </li>
                                            </ul>
                                            <p>
                                               Note: He is a prominent politician in India and a qualified CA, illustrating the versatility of CAs beyond corporate roles. As a Minister of Commerce &amp; Industry, he often credits his financial training for his administrative acumen.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="stalwarts-box">
                                            <div class="profile-img">
                                                <img src="images/profile-img.png">
                                            </div>
                                            <h4>Piyush Goyal</h4>
                                            <ul>
                                                <li>
                                                    <a href="mailto:@piyushgoyalofficial"><span><img src="images/insta.png"></span>@piyushgoyalofficial(verified)</a>
                                                </li>
                                                <li>
                                                    <a href="mailto:@piyushgoyalofficial"><span><img src="images/twitter.png"></span>@piyushgoyalofficial(verified)</a>
                                                </li>
                                            </ul>
                                            <p>
                                               Note: He is a prominent politician in India and a qualified CA, illustrating the versatility of CAs beyond corporate roles. As a Minister of Commerce &amp; Industry, he often credits his financial training for his administrative acumen.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="stalwarts-box">
                                           <div class="profile-name">
                                                <h3>PG</h3>
                                            </div>
                                            <h4>Piyush Goyal</h4>
                                            <ul>
                                                <li>
                                                    <a href="mailto:@piyushgoyalofficial"><span><img src="images/insta.png"></span>@piyushgoyalofficial(verified)</a>
                                                </li>
                                                <li>
                                                    <a href="mailto:@piyushgoyalofficial"><span><img src="images/twitter.png"></span>@piyushgoyalofficial(verified)</a>
                                                </li>
                                            </ul>
                                            <p>
                                               Note: He is a prominent politician in India and a qualified CA, illustrating the versatility of CAs beyond corporate roles. As a Minister of Commerce &amp; Industry, he often credits his financial training for his administrative acumen.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="stalwarts-box">
                                            <div class="profile-img">
                                                <img src="images/profile-img.png">
                                            </div>
                                            <h4>Piyush Goyal</h4>
                                            <ul>
                                                <li>
                                                    <a href="mailto:@piyushgoyalofficial"><span><img src="images/insta.png"></span>@piyushgoyalofficial(verified)</a>
                                                </li>
                                                <li>
                                                    <a href="mailto:@piyushgoyalofficial"><span><img src="images/twitter.png"></span>@piyushgoyalofficial(verified)</a>
                                                </li>
                                            </ul>
                                            <p>
                                               Note: He is a prominent politician in India and a qualified CA, illustrating the versatility of CAs beyond corporate roles. As a Minister of Commerce &amp; Industry, he often credits his financial training for his administrative acumen.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="stalwarts-box">
                                            <div class="profile-img">
                                                <img src="images/profile-img.png">
                                            </div>
                                            <h4>Piyush Goyal</h4>
                                            <ul>
                                                <li>
                                                    <a href="mailto:@piyushgoyalofficial"><span><img src="images/insta.png"></span>@piyushgoyalofficial(verified)</a>
                                                </li>
                                                <li>
                                                    <a href="mailto:@piyushgoyalofficial"><span><img src="images/twitter.png"></span>@piyushgoyalofficial(verified)</a>
                                                </li>
                                            </ul>
                                            <p>
                                               Note: He is a prominent politician in India and a qualified CA, illustrating the versatility of CAs beyond corporate roles. As a Minister of Commerce &amp; Industry, he often credits his financial training for his administrative acumen.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="stalwarts-box">
                                           <div class="profile-img">
                                                <img src="images/profile-img.png">
                                            </div>
                                            <h4>Piyush Goyal</h4>
                                            <ul>
                                                <li>
                                                    <a href="mailto:@piyushgoyalofficial"><span><img src="images/insta.png"></span>@piyushgoyalofficial(verified)</a>
                                                </li>
                                                <li>
                                                    <a href="mailto:@piyushgoyalofficial"><span><img src="images/twitter.png"></span>@piyushgoyalofficial(verified)</a>
                                                </li>
                                            </ul>
                                            <p>
                                               Note: He is a prominent politician in India and a qualified CA, illustrating the versatility of CAs beyond corporate roles. As a Minister of Commerce &amp; Industry, he often credits his financial training for his administrative acumen.
                                            </p>
                                        </div>
                                    </div>
                                </div> 
                                <p class="mt-3">(The above names show CAs in diverse roles – politics, cinema, investing, industry. Many CAs also shine in corporate leadership: e.g., Deepak Parekh (Chairman HDFC) and Uday Kotak (Kotak Mahindra Bank CEO) are CAs. However, not all have public social media profiles. We’ve listed those with accessible profiles where possible.)</p>  
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


<section class="career-details" data-aos="fade-down" data-aos-delay="100">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('pages.home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('pages.cluster', $career->cluster->slug) }}">{{ $career->cluster->name }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $career->title }}</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row align-items-center mb-5">
            <div class="col-lg-8">
                <h1 class="mb-4">{{ $career->title }}</h1>
            </div>
            @if($career->thumbnail)
                <div class="col-lg-4">
                    <img src="{{ Storage::url($career->thumbnail) }}" 
                         alt="{{ $career->thumbnail_alt }}" 
                         class="img-fluid rounded">
                </div>
            @endif
        </div>

        <div class="row">
            <div class="col-lg-12">
                @foreach($career->sections->sortBy('section_order') as $section)
                    <div class="card mb-4">
                        <div class="card-header">
                            <h3>{{ $section->section_title }}</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @if($section->section_image)
                                    <div class="col-md-4">
                                        <img src="{{ Storage::url($section->section_image) }}" 
                                             class="img-fluid rounded" 
                                             alt="{{ $section->section_title }}">
                                    </div>
                                @endif
                                <div class="{{ $section->section_image ? 'col-md-8' : 'col-md-12' }}">
                                    {!! $section->section_content !!}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        @if($career->relatedCareers->count() > 0)
            <div class="row mt-4">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3>Related Careers</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Career Title</th>
                                            <th>Cluster</th>
                                            <th width="150">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($career->relatedCareers as $relatedCareer)
                                            <tr>
                                                <td>
                                                    <strong>{{ $relatedCareer->title }}</strong>
                                                </td>
                                                <td>{{ $relatedCareer->cluster->name }}</td>
                                                <td>
                                                    <a href="{{ route('pages.career', ['cluster' => $relatedCareer->cluster->slug, 'career' => $relatedCareer->slug]) }}" 
                                                       class="btn btn-sm btn-dark">
                                                        View Details
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</section>
@endsection
