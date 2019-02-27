  <body>
    <?php require_once("navbar.php"); ?>

    <div class="container-fluid">
      <div class="row">
        <?php switch (true)  {
                case preg_match("/^lessons/",$_REQUEST['pn']):
                    require_once("sidebar_lessons.php");
                    break;
                case preg_match("/^editor/",$_REQUEST['pn']):
                    require_once("sidebar_editor.php");
                    break;
                case preg_match("/^help/",$_REQUEST['pn']):
                    require_once("sidebar_help.php");
                    break;
                case preg_match("/^tickets/",$_REQUEST['pn']):
                    require_once("sidebar_tickets.php");
                    break;
                default:
                    break;
              }
        ?>

        <main role="main" class="col-sm-9 ml-sm-auto col-md-9 pt-3">

          <div id="<?php echo $_REQUEST['pn'];?>Wrapper">

