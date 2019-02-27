<?php

if (array_key_exists('action',$_REQUEST) && $_REQUEST['action']=="create_ticket")  {
    if (!array_key_exists('subject',$_REQUEST) || !array_key_exists('body',$_REQUEST))  {
        header("HTTP/1.1 400 Bad Request");
        exit;
    }

    // get next highest id
    $files = scandir($GLOBALS['TICKETNOW_DIR'],SCANDIR_SORT_DESCENDING);
    if (preg_match("/^(\d+).json$/",$files[0],$match))  {
        // increment the highest match found
        $tickets_id = ((int) $match[0]) + 1;
    }  else  {
        // assume this is ticket 1
        $tickets_id = 1;
    }

    // write file
    file_put_contents(sprintf("%s/%05d.json",$GLOBALS['TICKETNOW_DIR'],$tickets_id),
                      json_encode([
                            'tickets_id'    => $tickets_id,
                            'subject'       => $_REQUEST['subject'],
                            'body'          => $_REQUEST['body'],
                            'owner'         => $_SESSION["user"],
                            'status'        => "New",
                            'date_created'  => time(),
                            'last_update'   => time(),
                            'comments'      => [],
                        ]));

    Redirect("/i/tickets/?tickets_id=$tickets_id");
    exit;

}

?>
