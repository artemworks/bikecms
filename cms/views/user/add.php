<h1 class="display-4">Add User</h1>

<form method="POST">
  
  <div class="form-row">
    
    <div class="form-group col-md-12">

      <div class="form-group">
        <label for="title">Name</label>
        <input type="text" name="name" class="form-control" Placeholder="Enter user name">
      </div>

      <div class="form-group">
        <label for="title">Password</label>
        <input type="text" name="pass" class="form-control" Placeholder="Enter password">
      </div>

      <div class="form-group">
        <label for="title">Real Name</label>
        <input type="text" name="real_name" class="form-control" Placeholder="Enter real name">
      </div>

      <div class="form-group">
        <label for="title">Email</label>
        <input type="text" name="email" class="form-control" Placeholder="Enter email">
      </div>

      <div class="form-group">
        <label for="title">Country</label>
        <input type="text" name="country" class="form-control" Placeholder="Enter country">
      </div>

      <div class="form-group">
        <label for="title">City</label>
        <input type="text" name="city" class="form-control" Placeholder="Enter city">
      </div>

      <label for="is_active">Privilege?</label>

        <div class="form-group">
          <div class="form-check form-check-inline">
            <label class="form-check-label">
              <input class="form-check-input" type="radio" name="priv" value="1"> Admin 
            </label>
          </div>
              
          <div class="form-check form-check-inline">
            <label class="form-check-label">
              <input class="form-check-input" type="radio" name="priv" value="0" checked> User 
            </label>
          </div>
        </div>

      <label for="is_active">Is active?</label>

        <div class="form-group">
          <div class="form-check form-check-inline">
            <label class="form-check-label">
              <input class="form-check-input" type="radio" name="is_active" value="1" checked> Yes 
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