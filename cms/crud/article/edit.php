<?php
require_once DIR . "cms/crud/header.php"; 
$article = getArticleById($activity_id);
?>

<h1 class="display-4">Edit article <b>"<?= $article["title"] ?>"</b></h1>

<form method="POST" enctype="multipart/form-data">
        
  <div class="form-row">
    
    <div class="form-group col-md-10">

            <label for="title">Title</label>
            <input type="text" name="title" class="form-control" value="<?= $article["title"] ?>">

            <label for="title">Title URL</label>
            <input type="text" name="title_url" class="form-control" value="<?= $article["title_url"] ?>">

            <label for="title">Description</label>
            <input type="text" name="description" class="form-control" value="<?= $article["description"] ?>">

            <label for="body">Body</label>
            <textarea class="form-control" type="text" name="body" rows="7"><?= $article["body"] ?></textarea>

            <label for="cover_image">Cover Image 1420x700:</label>
              <input type="file" value="<?= $article["cover"] ?>" id="coverToUpload" name="cover_image" accept="image/gif, image/jpeg, image/png" onchange="readCover(this)" aria-describedby="coverHelp">
              <small id="coverHelp" class="form-text text-muted">Choose a cover image for this article.</small>
              <img src="<?= DIR_URL_IMG . $article["cover"] ?>" id="readCoverDefault" class="img-fluid" />

    </div>

    <div class="form-group col-md-2">

            <label for="datePosted">Date posted</label>
            <input type="text" class="form-control" name="posted" value="<?= $article["posted"] ?>">

            <label for="dateArchived">Archiving Date</label>
            <input type="text" class="form-control" name="archiving" value="<?= $article["archiving"] ?>">

            <label for="dateArchived">As a User</label>
            <input type="text" class="form-control" name="user_id" value="<?= $_SESSION['user_id'] ?>">


      <label for="is_active">Is active?</label>

        <div class="form-group">
          
          <div class="form-check form-check-inline">
            <label class="form-check-label">
              <input class="form-check-input" type="radio" name="is_active" value="1" <?php if ( $article["is_active"] ) { echo " checked"; } ?>> Yes 
            </label>
          </div>
              
          <div class="form-check form-check-inline">
            <label class="form-check-label">
              <input class="form-check-input" type="radio" name="is_active" value="0" <?php if ( !$article["is_active"] ) { echo " checked"; } ?>> No  
            </label>
          </div>
        
        </div>

    </div>

  <button type="submit" class="btn btn-outline-primary" name="edit">Edit</button>&nbsp;
  <button type="submit" class="btn btn-outline-secondary" name="cancel">Cancel</button>

  </div>
</form>


<?php require_once DIR . "cms/crud/footer.php"; ?>