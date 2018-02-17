<h1 class="display-4">Edit user <b>"<?= $userContent["name"] ?>"</b></h1>

<form method="POST">
        
  <div class="form-row">
    
    <div class="form-group col-md-12">

      <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" class="form-control" value="<?= $userContent["name"] ?>">
      </div>

      <div class="form-group">
        <label for="pass">Password</label>
        <input type="password" name="pass" class="form-control">
      </div>

      <div class="form-group">
        <label for="real_name">Real Name</label>
        <input type="text" name="real_name" class="form-control" value="<?= $userContent["real_name"] ?>">
      </div>

      <div class="form-group">
        <label for="email">Email</label>
        <input type="text" name="email" class="form-control" value="<?= $userContent["email"] ?>">
      </div>

      <div class="form-group">
        <label for="country">Country</label>
        <input type="text" name="country" class="form-control" value="<?= $userContent["country"] ?>">
      </div>

      <div class="form-group">
        <label for="city">City</label>
        <input type="text" name="city" class="form-control" value="<?= $userContent["city"] ?>">
      </div>

      <label for="priv">Privilege?</label>

        <div class="form-group">
          
          <div class="form-check form-check-inline">
            <label class="form-check-label">
              <input class="form-check-input" type="radio" name="priv" value="1" <?php if ( $userContent["priv"] ) { echo " checked"; } ?>> Admin 
            </label>
          </div>
              
          <div class="form-check form-check-inline">
            <label class="form-check-label">
              <input class="form-check-input" type="radio" name="priv" value="0" <?php if ( !$userContent["priv"] ) { echo " checked"; } ?>> User  
            </label>
          </div>
        
        </div>

      <label for="is_active">Is active?</label>

        <div class="form-group">
          
          <div class="form-check form-check-inline">
            <label class="form-check-label">
              <input class="form-check-input" type="radio" name="is_active" value="1" <?php if ( $userContent["is_active"] ) { echo " checked"; } ?>> Yes 
            </label>
          </div>
              
          <div class="form-check form-check-inline">
            <label class="form-check-label">
              <input class="form-check-input" type="radio" name="is_active" value="0" <?php if ( !$userContent["is_active"] ) { echo " checked"; } ?>> No  
            </label>
          </div>
        
        </div>

    </div>

  <button type="submit" class="btn btn-outline-primary" name="edit">Edit</button>&nbsp;
  <button type="submit" class="btn btn-outline-secondary" name="cancel">Cancel</button>

  </div>
</form>