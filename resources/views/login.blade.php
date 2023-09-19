<!DOCTYPE html>
<html lang="en">
@include('head')
@include('scripts')

<body class="goto-here">
    
    
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show corner-alert" role="alert">

            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

        </div>
        @elseif(session('error'))
    <div class="alert alert-danger alert-dismissible fade show corner-alert" role="alert">

        {{session('error')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        
    </div>
    @endif
    <div class="py-1 bg-black">
        <div class="container">
            <div class="row no-gutters d-flex align-items-start align-items-center px-md-0">
                <div class="col-lg-12 d-block">
                    <div class="row d-flex">
                        <div class="col-md pr-4 d-flex topper align-items-center">
                            <div class="icon mr-2 d-flex justify-content-center align-items-center"><span
                                    class="icon-phone2"></span></div>
                            <span class="text">+ 1235 2355 98</span>
                        </div>
                        <div class="col-md pr-4 d-flex topper align-items-center">
                            <div class="icon mr-2 d-flex justify-content-center align-items-center"><span
                                    class="icon-paper-plane"></span></div>
                            <span class="text">youremail@email.com</span>
                        </div>
                        <div class="col-md-5 pr-4 d-flex topper align-items-center text-lg-right">
                            <span class="text">3-5 Business days delivery &amp; Free Returns</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('navbar');
    <section class="ftco-section bg-light">
        <div class="container d-flex justify-center flex-column  align-items-center">
            <div class="login p-5" style="width: 30vw; border:1px solid black">
                <h3 class="pb-3 text-center">Sigin</h3>
                <div>
                    <form action="{{ route('login.post') }}" method="post">
                        @csrf
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control rounded-5" name="email" id="floatingInput"
                                placeholder="name@example.com">
                            <label for="floatingInput">Email address</label>
                        </div>
                        <div class="form-floating">
                            <input type="password" name="password" class="form-control rounded-pill"
                                id="floatingPassword" placeholder="Password">
                            <label for="floatingPassword">Password</label>
                            <input type="submit" class="btn btn-dark mt-3 px-5" value="Login">
                        </div>
                    </form>
                    <p class="pt-3">Don't have an Account<a href="/Registration"> Signup</a></p>

                </div>
            </div>
        </div>
    </section>




    @include('footer')
</body>

</html>
