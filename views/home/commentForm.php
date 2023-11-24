
<form method="POST" class="col-8">
  <div class="form-group">
    <label class="mt-3" for="comment">Saisir un témoignage</label>
    <textarea class="form-control border-success rounded-0" name="comment" rows="3" required><?php echo $comment->getComment() ?></textarea>
  </div>
  <div class="form-group d-flex justify-content-end">
    <button class="btn btn-outline-success mt-3 w-50">Publie ton témoignage pour qu'il puisse être validé</button>
  </div>
</form>
