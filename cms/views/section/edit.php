<?php
$section = $section->getTagById($action_id);
?>

<h1 class="display-4">Edit section <b>"<?= $section["name"] ?>"</b></h1>

<form method="POST">
        
  <div class="form-row">
    
    <div class="form-group col-md-12">

      <div class="form-group">
        <label for="title">Name</label>
        <input type="text" name="name" class="form-control" value="<?= $section["name"] ?>">
      </div>

      <div class="form-group">
        <label for="title">Page Name</label>
        <input type="text" name="page" class="form-control" value="<?= $section["page"] ?>">
      </div>

      <div class="form-group">
        <label for="title">Title</label>
        <input type="text" name="title" class="form-control" value="<?= $section["title"] ?>">
      </div>

      <div class="form-group">
        <label for="exampleFormControlTextarea1">Description</label>
        <textarea class="form-control" name="description" rows="7"><?= $section["description"] ?></textarea>
      </div>

      <div class="form-group">
        <label for="title">Rank</label>
        <input type="text" name="rank" class="form-control" value="<?= $section["rank"] ?>">
      </div>

      <label for="is_active">Is active?</label>

        <div class="form-group">
          
          <div class="form-check form-check-inline">
            <label class="form-check-label">
              <input class="form-check-input" type="radio" name="is_active" value="1" <?php if ( $section["is_active"] ) { echo " checked"; } ?>> Yes 
            </label>
          </div>
              
          <div class="form-check form-check-inline">
            <label class="form-check-label">
              <input class="form-check-input" type="radio" name="is_active" value="0" <?php if ( !$section["is_active"] ) { echo " checked"; } ?>> No  
            </label>
          </div>
        
        </div>

    </div>

  <button type="submit" class="btn btn-outline-primary" name="edit">Edit</button>&nbsp;
  <button type="submit" class="btn btn-outline-secondary" name="cancel">Cancel</button>

  </div>
</form>