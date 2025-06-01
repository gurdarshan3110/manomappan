@extends('layouts.layout')

@section('content')
    <section class="sign-up login" data-aos="fade-down" data-aos-delay="100">
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="register">
                        <h3>Login into Manomaapan</h3>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('auth.login') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="email" class="form-label">Your Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        id="email" name="email" value="{{ old('email') }}"
                                        placeholder="Enter your email here" required>
                                </div>
                                <div class="col-md-12">
                                    <label for="password" class="form-label">Your Password</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                                            id="password" name="password" placeholder="Enter your password" required>
                                        <button class="btn btn-outline-secondary toggle-password" type="button">
                                            <i class="fa-regular fa-eye"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-dark">Login</button>
                                    <button type="reset" class="btn btn-light">Reset</button>
                                </div>
                            </div>
                        </form>

                        <div class="register-opt mt-4">
                            <h6>Don't have an account? <a href="{{ route('pages.register') }}">Register here</a></h6>
                        </div>

                        <div class="register-opt2">
                            <h4>Alternatively you can also login With</h4>
                            <ul>
                                <li>
                                    <a href="{{ route('auth.google') }}"><img
                                            src="images/social-icon1.png"><span>Google</span></a>
                                </li>
                            </ul>
                        </div>

                        <a href="{{ route('pages.forgot_password') }}" class="forgot-pswd-label">
                            Forgot Password? Click here
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script>
    document.querySelectorAll('.toggle-password').forEach(function(button) {
        button.addEventListener('click', function() {
            const input = this.closest('.input-group').querySelector('input');
            const icon = this.querySelector('i');
            
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });
    });
</script>
@endpush
