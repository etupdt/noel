
<div class="d-flex flex-column flex-lg-row">
  <label class="form-label col-lg-3 col-form-label" for="<?php echo $field['name'] ?>"><?php echo $field['label'] ?></label>
  
  <div 
    <?php 
      if (isset($field['id'])) echo 'id="'.$field['id'].'"';
      echo 'type="file"'; 
      echo 'fieldtype="file"'; 
      $classes = ''; 
      if (isset($field['events'])) {
        $classes = ' need-validation'; 
        foreach($field['events'] as $event=>$eventValue) {
          foreach ($eventValue as $value) {
            $classes = $classes.' validation-'.$value['function'];
          }
        }
      }
      echo 'class="form-group col-12 col-lg-9'.$classes.'"';
    ?>
  >
    <input 
      <?php 
        if ($field['name'] === "id") echo ' hidden ';
        echo 'type="file"'; 
        echo 'name="'.$field['name'].'"' ;
        echo 'onchange="const [file] = this.files; '.$field['name'].'_image.src = window.URL.createObjectURL(file)"' ;
        echo 'class="form-control bg-success-subtle border-success col-10 input"'; 
      ?> 
      value="<?php echo $row[$field['name']] ?>"
    />
    <div class="mt-3">
      <img id="<?php echo $field['name'].'_image'; ?>" 
        src="<?php 
        if (isset($field['path'])) {
          echo $field['path'].$row[$field['name']]; 
        }
        ?>" alt=""
      >  
    </div>

    <div class="invalid-feedback message">
    </div>

  </div>
</div>
