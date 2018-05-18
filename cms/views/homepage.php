      <div class="row">

        <div class="col-md-3">
          <p class="text-center lead"><b>Articles</b></p>
          <h1 class="display-4 text-center"><?= count($articles) ?></h1>
          <p class="text-center">
            <a class="btn btn-secondary" href="article/add" aria-label="Settings">
              <i class="fa fa-plus" aria-hidden="true"></i>
            </a>
            <a class="btn btn-secondary" href="article" aria-label="Settings">
              <i class="fa fa-search" aria-hidden="true"></i>
            </a>
          </p>
        </div>

        <div class="col-md-3">
          <p class="text-center lead"><b>Tags</b></p>
          <h1 class="display-4 text-center"><?= count($tags) ?></h1>
          <p class="text-center">
            <a class="btn btn-secondary" href="tag/add" aria-label="Settings">
              <i class="fa fa-plus" aria-hidden="true"></i>
            </a>
            <a class="btn btn-secondary" href="tag" aria-label="Settings">
              <i class="fa fa-search" aria-hidden="true"></i>
            </a>
          </p>
        </div>

        <div class="col-md-3">
          <p class="text-center lead"><b>Sections</b></p>
          <h1 class="display-4 text-center"><?= count($sections) ?></h1>
          <p class="text-center">
            <a class="btn btn-secondary" href="section/add" aria-label="Settings">
              <i class="fa fa-plus" aria-hidden="true"></i>
            </a>
            <a class="btn btn-secondary" href="section" aria-label="Settings">
              <i class="fa fa-search" aria-hidden="true"></i>
            </a>
          </p>
        </div>

        <div class="col-md-3">
          <p class="text-center lead"><b>Users</b></p>
          <h1 class="display-4 text-center"><?= count($users) ?></h1>
          <p class="text-center">
            <a class="btn btn-secondary" href="user/add" aria-label="Settings">
              <i class="fa fa-plus" aria-hidden="true"></i>
            </a>
            <a class="btn btn-secondary" href="user" aria-label="Settings">
              <i class="fa fa-search" aria-hidden="true"></i>
            </a>
          </p>
        </div>

      </div>

      <div class="app-row row">

        <div class="col-md-3">
          <p class="text-center lead"><b>Budget</b> <small><span class="badge badge-pill badge-info">Module</span></small></p>
          <h1 class="display-4 text-center"><?= count($purchases) ?></h1>
          <p class="text-center">
            <a class="btn btn-secondary" href="module_budget/add" aria-label="Settings">
              <i class="fa fa-plus" aria-hidden="true"></i>
            </a>
            <a class="btn btn-secondary" href="module_budget" aria-label="Settings">
              <i class="fa fa-search" aria-hidden="true"></i>
            </a>
          </p>
        </div>

        <div class="col-md-3">
          <p class="text-center lead"><b>Calendar</b> <small><span class="badge badge-pill badge-info">Module</span></small></p>
          <h1 class="display-4 text-center"><?= count($events) ?></h1>
          <p class="text-center">
            <a class="btn btn-secondary" href="module_calendar/add" aria-label="Settings">
              <i class="fa fa-plus" aria-hidden="true"></i>
            </a>
            <a class="btn btn-secondary" href="module_calendar" aria-label="Settings">
              <i class="fa fa-search" aria-hidden="true"></i>
            </a>
          </p>
        </div>

      </div>