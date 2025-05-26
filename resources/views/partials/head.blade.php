<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="{{ $meta['description'] ?? 'Career counselling and guidance platform for students' }}">
<meta name="keywords" content="{{ $meta['keywords'] ?? 'career counselling, career guidance, career assessment, student counselling' }}">
<meta name="author" content="{{ $meta['author'] ?? 'Manomaapan' }}">
<meta property="og:title" content="{{ $meta['title'] ?? 'Manomaapan' }}">
<meta property="og:description" content="{{ $meta['description'] ?? 'Career counselling and guidance platform for students' }}">
<meta property="og:image" content="{{ $meta['image'] ?? asset('images/og-image.png') }}">
<meta name="twitter:card" content="summary_large_image">
<title>{{ $meta['title'] ?? 'Manomaapan' }}</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link
    href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.4.1/css/swiper.min.css">
<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/aos.css') }}" rel="stylesheet">
<link href="{{ asset('css/style.css') }}" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/x-icon">
@stack('styles')
