@extends('layouts.layout')

@section('content')
<section class="banner" data-aos="fade-down" data-aos-delay="100">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="banner-left">
                        <nav class="navbar navbar-expand-lg bg-white navbar-light language-nav">
                            <a href="#" class="">
                                Select Language
                            </a>
                            <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#language">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="language">
                                <ul class="navbar-nav ms-auto ">
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Gujarati</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Hindi</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link active" href="login.html">English</a>
                                    </li>
                                </ul>
                            </div>  
                            
                            <select class="my-language selectpicker" data-container="body" >
                              <option>Gujrati</option>
                              <option>Hindi</option>
                              <option>English</option>
                            </select>
                        </nav>
                        <h2>
                            Find clarity in your career through self-insight and expert guidance
                        </h2>
                        <p>Take career counselling assessment to uncover your strengths and with find career path that suits you best with our expert counsellors</p>
                        <div class="col-12">
                            <a href="payment.html" class="btn btn-dark">Find Your Dream Career Now!</a>
                            <a href="#" class="btn btn-light" >Why Manomaapan?</a>
                      </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <img src="images/banner.jpg" class="img-fluid">
                </div>
            </div>
        </div>
    </section>
    <section class="why-choose" data-aos="fade-down" data-aos-delay="100">
        <div class="container">
             <h3>Why choose manomaapan</h3>
            <div class="row">
                <div class="col-lg-3">
                    <div class="why-choose-box">
                        <img src="images/why-choose-icon1.png">
                        <h4>Career choice by your true strength</h4>
                        <p>We help you take career decision based on your true strength rather than opinions</p>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="why-choose-box">
                        <img src="images/why-choose-icon2.png">
                        <h4>Scientific approach to career choice</h4>
                        <p>Our assessment are designed with leading researchers to uncover your true strength </p>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="why-choose-box">
                        <img src="images/why-choose-icon3.png">
                        <h4>In your own language</h4>
                        <p>You can choose to use Manomaapan in Gujarati, Hindi or English whichever language that is you feel comfortable in</p>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="why-choose-box">
                        <img src="images/why-choose-icon4.png">
                        <h4>Expert Guidance</h4>
                        <p>We offer assessment and counselling in the language you're most comfortable with so you can feel more confident.</p>
                    </div>
                </div>
            </div>
            <a href="#" class="btn btn-light" >Find more about Manomaapan</a>
        </div>  
    </section>
    <section class="career-counselling why-choose" data-aos="fade-down" data-aos-delay="100">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 career-counselling-lt">
                    <h3>But why do I need career counselling?</h3>
                    <p>Choosing the right career isn’t just about following trends or advice—it’s about understanding your strengths, interests, and opportunities and career counselling can help you with it.</p>
                </div>
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="career-counselling-rt">
                                <h2>85%</h2>
                                <p>students say assessments helped them find the right career</p>
                                <span>According to research study by National Career Service (NCS), India</span>
                                <img src="images/career-icon1.png">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="career-counselling-rt career-counselling-box2">
                                <img src="images/career-icon2.png">
                                <h2>88%</h2>
                                <p>students say they better understood and engaged with assessments in their native language.</p>
                                <span>Research Study by National Institute of Educational Planning and Administration (NIEPA), India</span>
                               
                            </div>
                        </div>
                    </div>    
                </div>
            </div>
        </div>
    </section>   

    @include('sections.our-plan', ['packages' => $packages])
    
    <section class="students-say" data-aos="fade-down" data-aos-delay="100">
        <div class="top-img">  
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h3>What does our students say?</h3>
                    <p class="mb-0">Hear what our students have to say</p>
                </div>
                <div class="swiper-container" data-aos="zoom-in" data-aos-delay="100">
                    <div class="swiper-wrapper">
                      <div class="swiper-slide">
                        <div class="students-card">
                            <h4>
                                “The guidance I received helped me discover my strengths and find the perfect career path. Highly recommend!”
                            </h4>
                            <div class="students-details">
                                <img src="images/student1.png">
                                <div class="student-text">
                                    <h5>Krittika Patel</h5>
                                    <p>11th Science, Groub B student</p>
                                </div>
                            </div>
                        </div>
                      </div>
                      <div class="swiper-slide">
                        <div class="students-card">
                            <h4>
                                “Thanks to their expert support, I now feel confident about my future and the choices I’m making.”
                            </h4>
                            <div class="students-details">
                                <img src="images/student2.png">
                                <div class="student-text">
                                    <h5>Parth Shah</h5>
                                    <p>First Year, MBBS, BJ Medical</p>
                                </div>
                            </div>
                        </div>
                       
                      </div>
                      <div class="swiper-slide">
                        <div class="students-card">
                            <h4>
                                "I was lost in my career journey, but they helped me find clarity and direction. It’s been a game-changer!
                            </h4>
                            <div class="students-details">
                                <img src="images/student3.png">
                                <div class="student-text">
                                    <h5>Roshani Surendran</h5>
                                    <p>First Year B.Des, NID</p>
                                </div>
                            </div>
                        </div>
                      </div>
                      <div class="swiper-slide">
                        <div class="students-card">
                            <h4>
                                The personalized approach gave me the clarity I needed to make the right career decisions. I couldn’t be more grateful!
                            </h4>

                            <div class="students-details">
                                <img src="images/student4.png">
                                <div class="student-text">
                                    <h5>Ranveer Brar</h5>
                                    <p>First Year, Hospitality</p>
                                </div>
                            </div>
                        </div>
                      </div>
                    </div>  
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </div> 
    </section> 
    <section class="works" data-aos="fade-down" data-aos-delay="100">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="mb-0">How it works?</h3>
                    <p>Manomaapan assessments helps you identify your potential, aptitude and interest, using that information we identify potential career path for you and provide expert guidance to take decision on which path is right for you.</p>
                </div>
            </div>      
            <div class="row">
                <div class="col-md-4 works-card">
                    <svg xmlns="http://www.w3.org/2000/svg" width="110" height="110" viewBox="0 0 110 110" fill="none">
                        <path d="M56.8424 58.399C66.9656 58.399 75.1721 50.1907 75.1721 40.0652C75.1721 29.9398 66.9656 21.7314 56.8424 21.7314C46.7192 21.7314 38.5127 29.9398 38.5127 40.0652C38.5127 50.1907 46.7192 58.399 56.8424 58.399Z" fill="#0077AB"/>
                        <path d="M86.4857 93.1415C86.4857 109.52 77.387 97.3175 61.0176 97.3175C44.6481 97.3175 27.1992 109.515 27.1992 93.1415C27.1992 76.7684 40.473 63.4917 56.8425 63.4917C73.2119 63.4917 86.4857 76.7684 86.4857 93.1415Z" fill="#0077AB"/>
                        <path d="M93.5179 44.7305L82.3826 49.5278C80.4936 50.3427 80.1932 52.8992 81.8429 54.1266L91.5627 61.3735C93.2124 62.6059 95.5749 61.5874 95.8142 59.5401L97.2296 47.4958C97.4689 45.4537 95.4068 43.9157 93.5179 44.7254V44.7305Z" fill="#0077AB"/>
                        <path d="M14.6688 43.1419L21.96 46.7629C22.296 46.9309 22.6932 46.9004 22.9936 46.6814L29.6483 41.991C30.5088 41.385 31.6086 42.3271 31.1401 43.2693L27.52 50.562C27.352 50.8981 27.3825 51.2954 27.6015 51.5959L32.2908 58.252C32.8967 59.1127 31.9548 60.2127 31.0128 59.7442L23.7217 56.1233C23.3856 55.9552 22.9885 55.9858 22.6881 56.2048L16.0334 60.8952C15.1729 61.5012 14.0731 60.559 14.5415 59.6169L18.1617 52.3241C18.3297 51.988 18.2991 51.5908 18.0802 51.2903L13.3908 44.6341C12.7849 43.7734 13.7269 42.6734 14.6688 43.1419Z" fill="#0077AB"/>
                        <path d="M81.9902 23.7689C86.0676 23.7689 89.373 20.4628 89.373 16.3844C89.373 12.3061 86.0676 9 81.9902 9C77.9128 9 74.6074 12.3061 74.6074 16.3844C74.6074 20.4628 77.9128 23.7689 81.9902 23.7689Z" fill="#0077AB"/>
                      </svg>
                    <h5>Find your potential, interest and aptitude </h5>
                    <div class="btn-prev">
                      <img src="images/prev-icon.png">
                    </div>
                    <div class="btn-prev btn-prev-phone">
                      <img src="images/arrow1.png">
                    </div>
                </div>
                <div class="col-md-4 works-card works-card2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="120" height="120" viewBox="0 0 120 120" fill="none">
                      <path d="M94.4424 34.7129C95.6497 33.4314 97.7873 33.957 98.2754 35.6436H98.2764L104.213 55.9639L104.379 56.5312L104.3 56.6094C104.312 58.0334 102.968 59.1956 101.482 58.8359L101.481 58.835L93.4629 56.8818L93.4561 56.8799C93.3397 56.8509 93.2084 56.9067 93.1514 57.0479L93.1504 57.0518C89.1769 66.7637 83.6303 75.0864 76.5986 81.8164L75.9141 82.4629C64.613 92.9765 49.9351 99.0722 32.3477 100.622L32.3447 100.623C31.0803 100.73 29.9634 99.7729 29.8721 98.5078L29.8672 98.2764C29.8985 97.1287 30.7848 96.1696 31.9502 96.0684L33.5088 95.918C65.9611 92.5047 81.3253 73.4424 88.6416 56.0283V56.0273L88.6582 55.9697C88.6818 55.8335 88.5983 55.6859 88.4434 55.6475V55.6465L80.9941 53.832V53.833C79.2901 53.4204 78.6685 51.3036 79.8857 50.0352L94.4424 34.7129Z" fill="#1A1818" stroke="#1A1818" stroke-width="2"/>
                      <path fill-rule="evenodd" clip-rule="evenodd" d="M89.607 91.5236C89.607 89.971 91.2992 89.0105 92.6323 89.8065L105.99 97.7828C107.29 98.5588 107.29 100.441 105.99 101.217L92.6323 109.194C91.2992 109.99 89.607 109.029 89.607 107.476V103.492C89.607 102.387 88.7115 101.492 87.607 101.492H32.8581C31.758 101.492 30.8662 100.6 30.8662 99.5C30.8662 98.3999 31.758 97.5081 32.8581 97.5081H87.607C88.7115 97.5081 89.607 96.6127 89.607 95.5081V91.5236Z" fill="#1A1818"/>
                      <path d="M47.1938 78.3027C47.1938 79.5532 48.6799 79.8153 50.6378 79.8153C52.5958 79.8153 54.2525 79.6742 54.9453 78.6254C55.5879 77.6573 51.5314 75.9229 49.5635 75.9229C47.5955 75.9229 47.1938 77.0422 47.1938 78.3027Z" fill="#1A1818"/>
                      <path d="M37.3047 78.3027C37.3047 79.5532 38.7907 79.8153 40.7487 79.8153C42.7066 79.8153 44.3633 79.6742 45.0561 78.6254C45.6987 77.6573 41.6423 75.9229 39.6743 75.9229C37.7063 75.9229 37.3047 77.0422 37.3047 78.3027Z" fill="#1A1818"/>
                      <path d="M32.1334 34.8694C32.6053 32.1265 34.3122 29.6358 35.989 27.4878C38.4389 24.3516 41.3708 21.1146 45.7687 21.4777C49.9155 21.8205 51.773 25.4206 54.4037 28.0828C55.5885 29.2828 57.0846 30.14 58.7212 30.5736C59.3839 30.7551 65.0569 31.2593 65.0569 30.3316V32.7417C65.0569 32.7417 59.1329 38.4191 51.763 33.4072L51.7128 35.9585C51.7128 35.9585 51.7128 72.8162 52.5763 77.0112L47.6262 76.7995C47.6262 76.7995 49.1323 54.9773 46.3309 50.4394C42.9372 44.9234 42.0235 75.9322 42.2444 76.5877L37.5754 76.9205C37.5754 76.9205 38.2883 47.2226 38.5293 32.5198C38.5293 32.5198 35.3966 32.8929 35.3564 36.3922C35.3163 39.2661 37.9369 42.2309 37.9369 42.2309L36.2199 43.9553C36.2199 43.9553 31.2699 39.851 32.1334 34.8795V34.8694Z" fill="#1A1818"/>
                      <path d="M65.4476 33.0442C64.072 33.0442 62.9575 32.8828 62.9575 31.6526C62.9575 30.4223 64.6243 29.7063 65.9999 29.7063C67.3754 29.7063 69.8655 28.2038 69.8655 29.424C69.8655 30.6441 66.8132 33.0341 65.4376 33.0341L65.4476 33.0442Z" fill="#1A1818"/>
                      <path d="M45.0468 20.1772C47.7806 20.1772 49.9968 17.4683 49.9968 14.1267C49.9968 10.7851 47.7806 8.07617 45.0468 8.07617C42.3129 8.07617 40.0967 10.7851 40.0967 14.1267C40.0967 17.4683 42.3129 20.1772 45.0468 20.1772Z" fill="#1A1818"/>
                      <path d="M36.0088 43.9453C36.0088 45.0243 36.561 46.7588 37.5149 46.7588C38.4688 46.7588 39.4528 46.9705 39.4528 45.8915C39.4528 44.8125 38.6796 41.999 37.7358 41.999C36.792 41.999 36.0188 42.8663 36.0188 43.9453H36.0088Z" fill="#1A1818"/>
                      <path d="M16.9131 51.0655C16.9131 52.3261 17.6159 54.0101 17.4754 54.8572C17.4754 54.8572 18.3188 56.4001 18.7305 52.6084C19.1421 48.8168 16.9131 49.7949 16.9131 51.0655Z" fill="#1A1818"/>
                      <path d="M31.402 44.5507C31.402 44.5507 31.0204 39.5994 30.3176 38.0767L29.2834 38.8431C29.2834 38.8431 30.7895 46.8096 29.444 45.0448C28.2492 43.4818 27.6668 42.0095 27.0543 40.4263C26.6025 39.2666 25.5683 38.4397 24.3433 38.2582C22.4557 37.9758 19.6342 37.8649 17.7365 39.1658C17.7365 39.1658 12.3748 43.4112 13.3487 45.8616C14.3227 48.3121 15.7886 49.613 16.7626 51.9021C16.7626 51.9021 17.7365 50.4298 18.3892 50.4298C18.3892 50.4298 15.9292 46.7188 16.1099 45.8616C16.5316 43.8851 18.1683 43.4919 18.6 43.4314L18.7004 43.9053C18.7004 43.9053 18.8008 56.1778 18.2285 61.2198C17.5759 66.9376 15.3067 77.7176 15.3067 77.7176H18.1382C18.1382 77.7176 20.8291 67.593 21.6424 62.2081C22.4557 56.8231 22.6163 57.3072 22.6163 57.3072C22.6163 57.3072 24.5642 62.5308 23.7509 76.7394L27.6568 76.9007C27.6568 76.9007 27.4559 56.9643 27.0041 54.3626C26.1908 49.623 26.3515 46.1944 26.5121 45.549C26.5121 45.549 31.5526 52.4063 31.3919 44.5709L31.402 44.5507Z" fill="#1A1818"/>
                      <path d="M29.5059 39.0045C29.5059 39.0045 26.1924 37.0482 28.1403 35.5759C30.0882 34.1036 30.2589 38.5104 30.2589 38.5104L29.5059 39.0045Z" fill="#1A1818"/>
                      <path d="M23.1441 37.1999C24.7784 36.9543 25.7886 34.6432 25.4005 32.0379C25.0123 29.4326 23.3728 27.5197 21.7385 27.7653C20.1042 28.0109 19.094 30.322 19.4821 32.9273C19.8703 35.5326 21.5098 37.4455 23.1441 37.1999Z" fill="#1A1818"/>
                      <path d="M18.7306 78.5141C18.831 79.4519 17.7366 79.7645 16.2606 79.9158C14.7846 80.0671 13.5396 80.0872 12.9371 79.3511C12.3748 78.6654 15.2967 77.062 16.7727 76.9107C18.2487 76.7595 18.6402 77.5763 18.7306 78.5141Z" fill="#1A1818"/>
                      <path d="M23.2789 77.5361C23.1784 78.4739 24.2729 78.7865 25.7489 78.9378C27.2249 79.089 28.4699 79.1092 29.0723 78.3731C29.6346 77.6873 26.7128 76.084 25.2368 75.9327C23.7608 75.7814 23.3692 76.5983 23.2789 77.5361Z" fill="#1A1818"/>
                      <circle cx="80.8125" cy="73.0566" r="11.25" fill="#FFECEC"/>
                      <path d="M77.9393 79.6482L89.0942 68.4933L87.3512 66.6922L77.9393 76.1042L73.5238 71.6887L71.7808 73.4316L77.9393 79.6482ZM71.6646 64.7169C74.1048 62.2767 77.029 61.0566 80.4375 61.0566C83.846 61.0566 86.7509 62.2767 89.1523 64.7169C91.5924 67.1183 92.8125 70.0232 92.8125 73.4316C92.8125 76.8401 91.5924 79.7644 89.1523 82.2045C86.7509 84.6059 83.846 85.8066 80.4375 85.8066C77.029 85.8066 74.1048 84.6059 71.6646 82.2045C69.2632 79.7644 68.0625 76.8401 68.0625 73.4316C68.0625 70.0232 69.2632 67.1183 71.6646 64.7169Z" fill="#1A1818"/>
                    </svg>
                    <h5>Get expert to help you identify your career</h5>
                    <div class="btn-prev"><img src="images/next-icon.png"></div>
                    <div class="btn-prev btn-prev-phone">
                      <img src="images/arrow1.png">
                    </div>
                </div>
                <div class="col-md-4 works-card works-card3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="120" height="120" viewBox="0 0 120 120" fill="none">
                    <path d="M19.5143 89.7351C21.1128 89.7351 22.4086 88.4362 22.4086 86.8339C22.4086 85.2315 21.1128 83.9326 19.5143 83.9326C17.9159 83.9326 16.6201 85.2315 16.6201 86.8339C16.6201 88.4362 17.9159 89.7351 19.5143 89.7351Z" fill="#ED7C7C"/>
                    <path d="M65.863 36.1697C67.4614 36.1697 68.7572 34.8707 68.7572 33.2684C68.7572 31.6661 67.4614 30.3672 65.863 30.3672C64.2645 30.3672 62.9688 31.6661 62.9688 33.2684C62.9688 34.8707 64.2645 36.1697 65.863 36.1697Z" fill="#ED7C7C"/>
                    <path d="M44.1604 56.5821L45.2379 47.456C45.4037 46.0643 46.9164 45.2749 48.146 45.9327L53.7272 48.917C54.5975 49.381 55.6751 49.1386 56.2622 48.3423L63.2456 38.8978C63.8258 38.1153 63.7568 37.0213 63.0729 36.322L63.0108 36.2527C62.2648 35.4841 61.0491 35.4426 60.2547 36.1627L56.428 39.6179C55.7372 40.241 54.7011 40.3034 53.9413 39.7564L48.74 36.0311C47.096 34.854 45.155 34.1547 43.1381 34.0162L33.7439 33.3792C32.1621 33.2684 30.5734 33.5107 29.0883 34.0854L16.2819 39.0224C15.6741 39.2578 15.2251 39.7702 15.0662 40.4003L12.7177 49.8241C12.4069 51.0843 13.3532 52.303 14.6449 52.303H14.7139C15.5221 52.303 16.2543 51.8114 16.5582 51.0566L18.7203 45.6973C19.0035 44.998 19.6528 44.5202 20.4057 44.4579L25.6968 44.0355C27.0644 43.9247 28.1282 45.2057 27.7759 46.5351L24.4603 58.9294C24.3775 59.2341 24.3705 59.5595 24.4396 59.8642L27.2717 73.0271C27.3684 73.4841 27.3062 73.9618 27.0852 74.3773L22.9062 82.3193C22.5953 82.9148 22.6022 83.6211 22.92 84.2096C23.5969 85.4421 25.3031 85.6014 26.1941 84.5143L34.1031 74.8758C34.4416 74.4673 34.6005 73.9341 34.5452 73.4079L33.9581 67.64C33.7992 66.0752 35.4224 64.9535 36.8247 65.6528L49.4998 72.0092C49.8728 72.1962 50.1837 72.5008 50.3771 72.8747L57.4296 86.4669C57.9752 87.5194 59.3084 87.8656 60.2961 87.2078L62.845 85.5044C63.6532 84.9644 63.9502 83.9188 63.5564 83.0325L56.1033 66.3729C55.9514 66.0336 55.7096 65.7497 55.4057 65.542L45.0031 58.4655C44.3883 58.05 44.0567 57.323 44.1465 56.5821H44.1604Z" fill="#ED7C7C"/>
                    <path d="M12.4264 59.4001C14.0249 59.4001 15.3207 58.1012 15.3207 56.4989C15.3207 54.8966 14.0249 53.5977 12.4264 53.5977C10.828 53.5977 9.53223 54.8966 9.53223 56.4989C9.53223 58.1012 10.828 59.4001 12.4264 59.4001Z" fill="#ED7C7C"/>
                    <path d="M64.5777 93.612C66.5347 93.612 68.1212 92.0217 68.1212 90.0599C68.1212 88.0981 66.5347 86.5078 64.5777 86.5078C62.6207 86.5078 61.0342 88.0981 61.0342 90.0599C61.0342 92.0217 62.6207 93.612 64.5777 93.612Z" fill="#ED7C7C"/>
                    <path d="M39.7933 30.36C45.1265 30.36 49.4499 26.0261 49.4499 20.68C49.4499 15.3339 45.1265 11 39.7933 11C34.4601 11 30.1367 15.3339 30.1367 20.68C30.1367 26.0261 34.4601 30.36 39.7933 30.36Z" fill="#ED7C7C"/>
                    <path d="M39.4346 103.696V109.5H102.155V93.5396H81.3176V96.925H61.1456V101.52H39.4346V103.696Z" fill="#ED7C7C"/>
                    <path d="M92.2941 30.79L73.3994 63.4107H90.3935V97.3562H94.1862V63.4107H111.18L92.2941 30.79ZM101.763 51.0279L90.4365 58.3255C89.7656 58.7543 89.0002 58.9772 88.2176 58.9772C87.822 58.9772 87.435 58.9172 87.048 58.8057C85.9041 58.4627 84.9667 57.6395 84.4765 56.5504L82.3695 51.8168C82.0771 51.1651 82.3695 50.4105 83.0231 50.1189C83.6767 49.8273 84.4335 50.1189 84.7259 50.7706L86.833 55.5042C87.0136 55.9158 87.349 56.2074 87.7876 56.336C88.2176 56.4647 88.6648 56.4046 89.0432 56.1559L100.37 48.8583C100.963 48.4724 101.763 48.6439 102.15 49.2442C102.537 49.8445 102.365 50.6334 101.763 51.0193V51.0279Z" fill="#ED7C7C"/>
                    </svg>
                    <h5>Choose the career where you can excel in it !</h5>
                </div>
            </div> 
        </div>
    </section>   
    <section class="join-manomaapan" data-aos="fade-down" data-aos-delay="100">
        <div class="container">
            <div class="join-manomaapan-inner">
                <div class="row align-items-center">
                    <div class="col-lg-8 join-manomaapan-lt">
                        <img src="images/join-img.png">
                        <h3>Join thousands of students who have benefited from career counselling. </h3>
                   </div> 
                   <div class="col-lg-4">
                      <a href="{{ route('auth.register') }}" class="btn btn-dark w-100">Join Manomaapan Now!</a>
                   </div>
                </div>
            </div>
        </div> 
    </section> 
    <section class="faqs">
        <div class="container">
            <h3>FAQs</h3>
            <div class="accordion" id="accordionExample">
              <div class="accordion-item">
                <div class="accordion-header">
                  <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    What does the process look like?
                  </button>
                </div>
                <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                  <div class="accordion-body">
                    <p>Lorem ipsum, placeholder or dummy text used in typesetting and graphic design for previewing layouts. It features scrambled Latin text, which emphasizes the design over content of the layout.</p>
                  </div>
                </div>
              </div>
              <div class="accordion-item">
                <div class="accordion-header">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    Do I have to prepare for test or couselling?
                  </button>
                </div>
                <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                  <div class="accordion-body">
                    <p>Lorem ipsum, placeholder or dummy text used in typesetting and graphic design for previewing layouts. It features scrambled Latin text, which emphasizes the design over content of the layout.</p>
                  </div>
                </div>
              </div>
              <div class="accordion-item">
                <div class="accordion-header">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    How can role model help me?
                  </button>
                </div>
                <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                  <div class="accordion-body">
                    <p>Lorem ipsum, placeholder or dummy text used in typesetting and graphic design for previewing layouts. It features scrambled Latin text, which emphasizes the design over content of the layout.</p>
                  </div>
                </div>
              </div>

              <div class="accordion-item">
                <div class="accordion-header">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                    How many counselling sessions can I schedule?
                  </button>
                </div>
                <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                  <div class="accordion-body">
                    <p>Lorem ipsum, placeholder or dummy text used in typesetting and graphic design for previewing layouts. It features scrambled Latin text, which emphasizes the design over content of the layout.</p>
                  </div>
                </div>
              </div>

              <div class="accordion-item">
                <div class="accordion-header">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                    Do I need desktop computer or laptop?
                  </button>
                </div>
                <div id="collapseFive" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                  <div class="accordion-body">
                    <p>Lorem ipsum, placeholder or dummy text used in typesetting and graphic design for previewing layouts. It features scrambled Latin text, which emphasizes the design over content of the layout.</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
    </section>  
@endsection