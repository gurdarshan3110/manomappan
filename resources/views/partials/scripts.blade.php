<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/aos.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(window).scroll(function () {
        if ($(this).scrollTop() > 250) {
            $('.sticky-top').addClass('sticky-nav').css('top', '0px');
        } else {
            $('.sticky-top').removeClass('sticky-nav').css('top', '-100px');
        }
    });

    $(document).ready(function() {
        new Swiper('.swiper-container', {
            loop: true,
            slidesPerView: 3,
            spaceBetween: 30,
            pagination: {
                el: '.swiper-pagination',
                clickable: true
            },
            breakpoints: {
                0: { slidesPerView: 1 },
                767: { slidesPerView: 2.9 },
                1028: { slidesPerView: 3.9 },
                1920: { slidesPerView: 3.9 }
            }
        });
    });
    AOS.init();
</script>
@stack('scripts')
