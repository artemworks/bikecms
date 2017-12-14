<?php
require_once DIR . "cms/crud/header.php"; 
$article = getArticleById($activity_id);
?>

<h1 class="display-4">Edit article <b>"<?= $article["title"] ?>"</b></h1>

<form method="POST" enctype="multipart/form-data" onsubmit="return postForm()">
        
  <div class="form-row">
    
    <div class="form-group col-md-10">

            <label for="title">Title</label>
            <input type="text" name="title" class="form-control" value="<?= $article["title"] ?>">

            <label for="title">Title URL</label>
            <input type="text" name="title_url" class="form-control" value="<?= $article["title_url"] ?>">

            <label for="title">Description</label>
            <input type="text" name="description" class="form-control" value="<?= $article["description"] ?>">

            <label for="body">Body</label>
            <textarea id="summernote" class="form-control" type="text" name="body" rows="10"></textarea>

            <label for="cover_image">Cover Image:</label>
              <input type="file" id="coverToUpload" name="cover_image" accept="image/gif, image/jpeg, image/png" onchange="readCover(this)" aria-describedby="coverHelp">
              <input type="hidden" name="cover_image" value="<?= $article["cover"] ?>">
              <small id="coverHelp" class="form-text text-muted">Choose a cover image for this article.</small>
              <img src="<?= DIR_URL_IMG . $article["cover"] ?>" id="readCoverDefault" class="img-fluid" />

    </div>

    <div class="form-group col-md-2">

            <label for="datePosted">Date posted</label>
            <input type="text" class="form-control" name="posted" value="<?= $article["posted"] ?>">

            <label for="dateArchived">Archiving Date</label>
            <input type="text" class="form-control" name="archiving" value="<?= $article["archiving"] ?>">

            <label for="dateArchived">As a User</label>
            <select class="form-control" name="user_id">
              <?php
                $users = getUsers();
                foreach ($users as $user) {
                  echo '<option value="' . 
                        $user["user_id"] . '"';
                  if ($user["user_id"] === $article["user_id"]) echo "selected";
                  echo '>' . 
                        $user["name"] . 
                        '</option>';
                }
              ?>
            </select>

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

        <label for="addTag">Tag:</label>
        <input type="submit" id="addTag" value="+">
        <div id="tag_fields">
<?php
  $tags = getArticleTags($article["article_id"]);
  $countTag = 0;
  $numTag = count($tags);
  foreach ($tags as $tag) {
    echo '<div id="positionTag'.$countTag.'">
          Tag: <select class="form-control" name="tag_id'.$countTag.'">
          <option value="' . $tag["tag_id"] . '">' . getTagById($tag["tag_id"])["name"] . '</option></select>
          <input type="button" value="-" onclick="$(\'#positionTag'.$countTag.'\').remove(); 
          return false;">
          </div>';
    $countTag++;
  }
?>
        </div>

        <label for="addSection">Section:</label>
        <input type="submit" id="addSection" value="+">
        <div id="section_fields">
<?php
  $sections = getArticleSections($article["article_id"]);
  $countSec = 0;
  $numSec = count($sections);
  foreach ($sections as $section) {
    echo '<div id="positionSection'.$countSec.'">
          Section: <select class="form-control" name="section_id'.$countSec.'">
          <option value="' . $section["section_id"] . '">' . getSectionById($section["section_id"])["name"] . '</option></select>
          <input type="button" value="-" onclick="$(\'#positionSection'.$countSec.'\').remove(); 
          return false;">
          </div>';
    $countSec++;
  }
?>
        </div>
        
    </div>

  <button type="submit" class="btn btn-outline-primary" name="edit">Edit</button>&nbsp;
  <button type="submit" class="btn btn-outline-secondary" name="cancel">Cancel</button>

  </div>
</form>



<?php require_once DIR . "cms/crud/footer.php"; ?>