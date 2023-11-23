<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
  <div id="loginpage" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Connexion</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div id="login-error-message" class="alert alert-danger mx-2 mt-2" style="display: none;">Alert danger</div>
        <div class="modal-body">
        <form>
          <div class="mb-1">
            <label for="login-email" class="col-form-label">Email</label>
            <input type="email" class="form-control" id="login-email">
          </div>
          <div class="mb-3">
            <label for="login-password" class="col-form-label">Mot de passe</label>
            <input type="password" class="form-control" id="login-password">
          </div>
          <a href='#' name="logonpage-link">Pas encore inscrit ?</a><br>
          <a href='#' name="forgotpage-link">Mot de passse oublié ou première connexion ?</a>
        </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Abandonner</button>
          <button type="button" class="btn btn-success" id="login-validate">Connexion</button>
        </div>
      </div>
    </div>
  </div>
</div>
