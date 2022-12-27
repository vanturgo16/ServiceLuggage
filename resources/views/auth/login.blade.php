<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
    <section class="vh-100" style="background-color: #007bff;">
        <div class="container py-5 h-100">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-xl-10">
              <div class="card" style="border-radius: 1rem;">
                <div class="row g-0">
                    <div class="col-md-6 col-lg-5 d-none d-md-block">
                        <img src="{{ asset('assets/img/logo_telkom-removebg-preview.png') }}"
                        alt="login form" class="img-fluid mx-5 mt-5 mb-5" style="border-radius: 1rem 0 0 1rem; width: 80%;" />
                    </div>
                    <div class="col-md-6 col-lg-7 d-flex align-items-center">
                        <div class="card-body p-4 p-lg-5 text-black">
                        <form>
                            <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Sign into your account</h5>
        
                            <div class="form-outline mb-4">
                            <input type="email" id="form2Example17" class="form-control form-control-lg" />
                            <label class="form-label" for="form2Example17">Email address</label>
                            </div>
        
                            <div class="form-outline mb-4">
                            <input type="password" id="form2Example27" class="form-control form-control-lg" />
                            <label class="form-label" for="form2Example27">Password</label>
                            </div>
        
                            <div class="pt-1 mb-4">
                            <button class="btn btn-dark btn-lg btn-block" type="button">Login</button>
                            </div>
        
                            {{-- <a class="small text-muted" href="#!">Forgot password?</a>
                            <p class="mb-5 pb-lg-2" style="color: #393f81;">Don't have an account? <a href="#!"
                                style="color: #393f81;">Register here</a></p>
                            <a href="#!" class="small text-muted">Terms of use.</a>
                            <a href="#!" class="small text-muted">Privacy policy</a> --}}
                        </form>
                        </div>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </section>
  </body>
</html>