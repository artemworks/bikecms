<h1 class="display-4">Add Event</h1>

<form method="POST" enctype="multipart/form-data" onsubmit="return postForm()">

  <div class="form-row">

    <div class="form-group col-md-10">

            <label for="title">Title</label>
            <input type="text" name="event_title" class="form-control" Placeholder="Very good event">

            <label for="title">Title URL (plus year)</label>
            <input type="text" name="event_title_url" class="form-control" Placeholder="very-good-event-2018">

            <label for="title">Location</label>
            <input type="text" name="event_location" class="form-control" Placeholder="Location">

            <label for="body">Description</label>
            <textarea id="summernote" class="form-control" type="text" name="event_description" rows="7" Placeholder="Just wanted to write a short description of the event"></textarea>

            <label for="title">Link to the event</label>
            <input type="text" name="event_link" class="form-control" Placeholder="Just copy the whole url here">
    </div>

    <div class="form-group col-md-2">

            <label for="datePosted">Date posted</label>
            <input type="date" class="form-control" name="event_datetime">

            <label for="catId">Cat_id</label>
            <input type="text" class="form-control" name="cat_id">

            <label for="catId">Pageviews</label>
            <input type="text" class="form-control" name="pageviews">

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