<h1 class="display-4">Edit event <b>"<?= $eventContent["event_title"] ?>"</b></h1>

<form method="POST" enctype="multipart/form-data" onsubmit="return postForm()">

  <div class="form-row">

    <div class="form-group col-md-10">

            <label for="title">Title</label>
            <input type="text" name="event_title" class="form-control" value="<?= $eventContent["event_title"] ?>">

            <label for="title">Title URL</label>
            <input type="text" name="event_title_url" class="form-control" value="<?= $eventContent["event_title_url"] ?>">

            <label for="posted">Date</label>
            <input type="text" class="form-control" name="event_datetime" value="<?= $eventContent["event_datetime"] ?>">

            <label for="body">Description</label>
            <textarea id="summernote" class="form-control" type="text" name="event_description" rows="10"></textarea>



    </div>

    <div class="form-group col-md-2">

            <label for="title">Event Link</label>
            <input type="text" name="event_link" class="form-control" value="<?= $eventContent["event_link"] ?>">

            <label for="title">Location</label>
            <input type="text" name="event_location" class="form-control" value="<?= $eventContent["event_location"] ?>">

            <label for="views">Views</label>
            <input type="text" class="form-control" name="pageviews" value="<?= $eventContent["pageviews"] ?>">

            <label for="views">Cat_id</label>
            <input type="text" class="form-control" name="cat_id" value="<?= $eventContent["cat_id"] ?>">

      <label for="is_active">Is active?</label>

        <div class="form-group">

          <div class="form-check form-check-inline">
            <label class="form-check-label">
              <input class="form-check-input" type="radio" name="is_active" value="1" <?php if ( $eventContent["is_active"] ) { echo " checked"; } ?>> Yes
            </label>
          </div>

          <div class="form-check form-check-inline">
            <label class="form-check-label">
              <input class="form-check-input" type="radio" name="is_active" value="0" <?php if ( !$eventContent["is_active"] ) { echo " checked"; } ?>> No
            </label>
          </div>

        </div>


    </div>

  <button type="submit" class="btn btn-outline-primary" name="edit">Edit</button>&nbsp;
  <button type="submit" class="btn btn-outline-secondary" name="cancel">Cancel</button>

  </div>
</form>