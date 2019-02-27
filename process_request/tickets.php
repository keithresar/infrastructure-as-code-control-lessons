<?php

if (array_key_exists('tickets_id',$_REQUEST))  {
    if (!array_key_exists("user",$_SESSION))  {
        Redirect("/i/login");
        exit;
    }

    if (!preg_match("/^\d+$/",$_REQUEST['tickets_id']) ||
        !file_exists(sprintf("%s/%05d.json",$GLOBALS['TICKETNOW_DIR'],$_REQUEST['tickets_id'])))  {
        header("HTTP/1.1 404 Not Found");
        exit;
    }

    $GLOBALS['ticket'] = json_decode(file_get_contents(sprintf("%s/%05d.json",$GLOBALS['TICKETNOW_DIR'],$_REQUEST['tickets_id'])),true);
    global $ticket;

    if (!$GLOBALS['ticket'])  {
        header("HTTP/1.1 404 Not Found");
        exit;
    }

    if (array_key_exists('action',$_REQUEST) && $_REQUEST['action']=='add_comment')  {
        if (array_key_exists('comment_status',$_REQUEST))  {
            if (!in_array($_REQUEST['comment_status'],['New','Open','Closed']))  {
                header("HTTP/1.1 400 Bad Request");
                exit;
            }  else  $ticket['status'] = $_REQUEST['comment_status'];
        }

        if (array_key_exists('comment_comment',$_REQUEST) && array_key_exists('comment_subject',$_REQUEST))  {
            $ticket['last_update'] = time();
            $ticket['comments'][] = [
                    'subject'       => $_REQUEST['comment_subject'],
                    'comment'       => $_REQUEST['comment_comment'],
                    'date_created'  => time(),
                    'owner'         => $_SESSION['user'],
                ];
        }

        // Write file
        file_put_contents(sprintf("%s/%05d.json",$GLOBALS['TICKETNOW_DIR'],$_REQUEST['tickets_id']),json_encode($ticket));
      
    }
}

?>
