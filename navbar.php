    <header>
      <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a class="navbar-brand" href="/">Ansible Workshop</a>
        <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item <?php echo preg_match("/^lessons/",$_REQUEST['pn'])?'active':'';?>">
              <a class="nav-link" href="/i/lessons">
                <i class="fa fa-book" aria-hidden="true"></i>
                Lessons
              </a>
            </li>
            <li class="nav-item <?php echo preg_match("/^editor/",$_REQUEST['pn'])?'active':'';?>">
              <a class="nav-link" href="/i/editor">
                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                Online Editor
              </a>
            </li>
            <li class="nav-item <?php echo preg_match("/^terminal/",$_REQUEST['pn'])?'active':'';?>">
              <a class="nav-link" href="/i/terminal" target="_blank">
                <i class="fa fa-terminal" aria-hidden="true"></i>
                Terminal Session
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/i/tickets">
                <i class="fa fa-tasks" aria-hidden="true"></i>
                TicketsNow
              </a>
            </li>
	    <!--
            <li class="nav-item">
              <a class="nav-link" href="https://zoom.us/j/6125321024">
                <i class="fa fa-desktop" aria-hidden="true"></i>
                ScreenShare
              </a>
            </li>
	    -->
            <li class="nav-item <?php echo preg_match("/^help/",$_REQUEST['pn'])?'active':'';?>">
              <a class="nav-link" href="/i/help">
                <i class="fa fa-question-circle" aria-hidden="true"></i> 
                Help
              </a>
            </li>
          </ul>
        </div>
      </nav>
    </header>

