
<form method="POST" class="col-8">
  <div class="d-flex flex-column flex-md-row col-12">
    <div class="form-group col-5">
      <label class="mt-1" for="pseudo">Votre pseudo</label>
      <p><?= $visitor->getPseudo(); ?></p>
    </div>
  </div>
  <div class="form-group">
    <label class="mt-3" for="comment">Saisis un témoignage</label>
    <textarea class="form-control border-success rounded-0" name="comment" rows="3"><?php echo $comment->getComment() ?></textarea>
  </div>
  <div class="form-group">
    <button class="btn btn-success mt-3 w-100">Publie ton commentaire pour qu'il puisse être validé</button>
  </div>
</form>
