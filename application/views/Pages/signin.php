 <main role="main">
  <div class="container">
      <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
          <div class="card card-signin my-5">
            <h5 class="card-title form-card-header text-center py-3">S'enregistrer</h5>
            <div class="card-body">
              <form class="form-signin" action="<?php echo base_url('Signin/process'); ?>" method="post">
                <div class="form-label-group mb-4">
                  <input type="email" id="email" name="email" class="form-control" placeholder="Email address" required autofocus>
                </div>
                <div class="form-label-group mb-4">
                  <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
                </div>
                <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">S'enregistrer</button>
                <hr class="my-4">
                <button class="btn btn-lg btn-google btn-block text-uppercase" type="submit"><i class="fa fa-google"></i> Sign in with Google</button>
                <button class="btn btn-lg btn-facebook btn-block text-uppercase" type="submit"><i class="fa fa-facebook-f"></i> Sign in with Facebook</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

