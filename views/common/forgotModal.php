<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
  <div id="forgotpage" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Réinitialisation du Mot de passe</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div id="forgot-error-message" class="alert alert-danger mx-2 mt-2" style="display: none;">Alert danger</div>
        <div class="modal-body">
        <form>
          <div class="mb-1">
            <label for="forgot-email" class="col-form-label">Email</label>
            <input type="email" class="form-control" id="forgot-email">
          </div>
          <a href='#' name="loginpage-link">Retour à la connexion</a><br>
        </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Abandonner</button>
          <button type="button" class="btn btn-success" id="forgot-validate">Réinitialiser</button>
        </div>
      </div>
    </div>
  </div>
</div>
