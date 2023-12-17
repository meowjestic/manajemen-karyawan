<!DOCTYPE html>
<html lang="en">

@include('components.parts.header');

<body class="bg-gradient-primary">

    <div class="content">
        <div class="container">

            <!-- Outer Row -->
            <div class="row justify-content-center align-items-center">

                <div class="col-xl-10 col-lg-12 col-md-9">

                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <!-- Nested Row within Card Body -->
                            <div class="row">
                                <div class="col-lg-12 d-flex justify-content-center ">
                                    <div class="p-5 w-50">
                                        <div class="text-center">
                                            <h1 class="h4 text-gray-900 mb-4">Selamat Datang</h1>
                                        </div>

                                        @if (session()->has('loginError'))
                                            <div class="alert alert-danger alert-dismissable fade show" role="alert">
                                                {{ session('loginError') }}
                                            </div>
                                        @endif
                                        <form class="user" action="/login/auth">
                                            @csrf
                                            <div class="form-group">
                                                <input type="username" class="form-control form-control-user"
                                                    id="username" name="username" aria-describedby="username"
                                                    placeholder="Masukkan username" required
                                                    @error('username') is-invalid @enderror>
                                                @error('email')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <input type="password" class="form-control form-control-user"
                                                    id="password" name="password" placeholder="Password">
                                            </div>
                                            <button class="btn btn-primary btn-user btn-block mt-3 px-4" name="submit"
                                                type="submit">
                                                Login
                                            </button>
                                            {{-- <a href="/dashboard" class="btn btn-primary btn-user btn-block">
                                                Login
                                            </a> --}}
                                        </form>
                                        <hr>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    @include('components.parts.footer');


</body>

</html>
