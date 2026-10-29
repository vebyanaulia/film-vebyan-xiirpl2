<div class="modal video-modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        Sign In
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <section>
        <div class="modal-body">
          <div class="w3_login_module">
            <div class="module form-module">
              <div class="form">
                <h3>Login to your account</h3>
                <form action="{{ route('login') }}" method="post">
                  @csrf
                  <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required="">
                  <input type="password" name="password" placeholder="Password" required="">
                  <input type="submit" value="Login">
                </form>
              </div>
              <div class="cta"><a href="{{ route('login') }}">Buka halaman login</a></div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
</div>
