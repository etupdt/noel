<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
  <div id="logonpage" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Inscription</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div id="logon-error-message" class="alert alert-danger mx-2 mt-2" style="display: none;">Alert danger</div>
        <div class="modal-body">
        <form>
          <div class="mb-1">
            <label for="logon-email" class="col-form-label">Email</label>
            <input type="email" class="form-control" id="logon-email">
          </div>
          <div class="mb-3">
            <label for="logon-password" class="col-form-label">Mot de passe</label>
            <input type="password" class="form-control" id="logon-password">
          </div>
          <div class="mb-3" id="confirm-password">
            <label for="logon-confirm-password" class="col-form-label">Confirmation du mot de passe</label>
            <input type="password" class="form-control" id="logon-confirm-password">
          </div>
          <a href='#' name="loginpage-link">Retour à la connexion</a><br>
        </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Abandonner</button>
          <button type="button" class="btn btn-success" id="logon-validate">S'inscrire</button>
        </div>
      </div>
    </div>
  </div>
</div>
