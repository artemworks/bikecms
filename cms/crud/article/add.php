<?php 
require_once DIR . "cms/crud/header.php"; 
?>

<h1 class="display-4">Add Article</h1>

<form method="POST" enctype="multipart/form-data">
  
  <div class="form-row">
    
    <div class="form-group col-md-10">

            <label for="title">Title</label>
            <input type="text" name="title" class="form-control" Placeholder="Very good bike">

            <label for="title">Title URL</label>
            <input type="text" name="title_url" class="form-control" Placeholder="very-good-bike">

            <label for="title">Description</label>
            <input type="text" name="description" class="form-control" Placeholder="I got you my bike, yeah">

            <label for="body">Body</label>
            <textarea class="form-control" type="text" name="body" rows="7" Placeholder="Just want to say something good about my bike"></textarea>

            <label for="cover_image">Cover Image:</label>
              <input type="file" id="coverToUpload" name="cover_image" accept="image/gif, image/jpeg, image/png" onchange="readCover(this)" aria-describedby="coverHelp">
              <small id="coverHelp" class="form-text text-muted">Choose a cover image for this article.</small>
              <img id="readCoverDefault" />

    </div>

    <div class="form-group col-md-2">

            <label for="datePosted">Date posted</label>
            <input type="date" class="form-control" name="posted">

            <label for="dateArchived">Archiving Date</label>
            <input type="date" class="form-control" name="archiving">

            <label for="dateArchived">As a User</label>
            <input type="text" class="form-control" name="user_id" value="<?= $_SESSION['user_id'] ?>">


        <label for="is_active">Is active?</label>

        <div class="form-group">
          <div class="form-check form-check-inline">
            <label class="form-check-label">
              <input class="form-check-input" type="radio" name="is_active" value="1"> Yes 
            </label>
          </div>
              
          <div class="form-check form-check-inline">
            <label class="form-check-label">
              <input class="form-check-input" type="radio" name="is_active" value="0"> No 
            </label>
          </div>
        </div>

    </div>

  <button type="submit" class="btn btn-outline-primary" name="add">Add</button>&nbsp;
  <button type="submit" class="btn btn-outline-secondary" name="cancel">Cancel</button>

  </div>

</form>

<?php require_once DIR . "cms/crud/footer.php"; ?>