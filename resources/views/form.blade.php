<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
     <!-- plugins:css -->
     <link rel="stylesheet" href="{{ asset('assets/vendors/mdi/css/materialdesignicons.min.css') }}">
     {{-- <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}"> --}}
     <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
     <!-- End layout styles -->
     <link rel="shortcut icon" href="{{ asset('assets/images/LOGO_ASISQUICK.png') }}" />
    
    
</head>
<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
          <div class="content-wrapper d-flex align-items-center auth">
            <div class="row flex-grow">
              <div class="col-lg-4 mx-auto">
                <div class="auth-form-light text-left p-5">
                  <h1 class="fw-bold fs-2 text-primary" >AsisQuick</h1>
                  <div class="container mt-5">
                    <select class="form-control form-control-lg selectpicker" multiple aria-label="size 3 select example">
                      <option value="1">One</option>
                      <option value="2">Two</option>
                      <option value="3">Three</option>
                      <option value="4">Four</option>
                    </select>
                  </div>
                    <div class="mt-3">
                      <button type="submit" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn" >Entrar</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
      </div>
       <!-- container-scroller -->
    <!-- plugins:js -->
    

    

    

</body>
</html>