<?php


// check creds
if (!array_key_exists('PHP_AUTH_USER',$_SERVER) || !array_key_exists('PHP_AUTH_PW',$_SERVER) ||
    !preg_match("/^student\d+$/",$_SERVER["PHP_AUTH_USER"]) || !$_SERVER["PHP_AUTH_PW"]==$GLOBALS['USER_PASSWORD'])  {

    print_r($_SERVER);
    // Unable to authenticate
    header("HTTP/1.1 401 Unauthorized");
    exit;
}

$req = json_decode(file_get_contents('php://input'),true);

// create directory if not exists
if (!file_exists($GLOBALS['TICKETNOW_DIR']))  {
    mkdir($GLOBALS['TICKETNOW_DIR']);
}


switch ($_SERVER['REQUEST_METHOD'])  {
    case 'GET':
        if (!preg_match("/^\d+$/",$_REQUEST['tickets_id']) || 
            !file_exists(sprintf("%s/%05d.json",$GLOBALS['TICKETNOW_DIR'],$_REQUEST['tickets_id'])))  {
            header("HTTP/1.1 404 Not Found");
            exit;
        }  else  {
            $ticket = json_decode(file_get_contents(sprintf("%s/%05d.json",$GLOBALS['TICKETNOW_DIR'],$_REQUEST['tickets_id'])),true);
            if (!$ticket)  {
                header("HTTP/1.1 404 Not Found");
                exit;
            }
        }

        header('Content-Type: application/json');
        print json_encode($ticket);
        exit;
        break;

    case 'POST':
        if (!array_key_exists('subject',$req) || !array_key_exists('body',$req))  {
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
                                'subject'       => $req['subject'],
                                'body'          => $req['body'],
                                'owner'         => $_SERVER["PHP_AUTH_USER"],
                                'status'        => "New",
                                'date_created'  => time(),
                                'last_update'   => time(),
                                'comments'      => [],
                            ]));

        // return id
        header('Content-Type: application/json');
        print json_encode(['tickets_id' => $tickets_id]);
        break;

    case 'PUT':
        if (!preg_match("/^\d+$/",$_REQUEST['tickets_id']) || 
            !file_exists(sprintf("%s/%05d.json",$GLOBALS['TICKETNOW_DIR'],$_REQUEST['tickets_id'])))  {
            header("HTTP/1.1 404 Not Found");
            exit;
        }  else  {
            $ticket = json_decode(file_get_contents(sprintf("%s/%05d.json",$GLOBALS['TICKETNOW_DIR'],$_REQUEST['tickets_id'])),true);
            if (!$ticket)  {
                header("HTTP/1.1 404 Not Found");
                exit;
            }
        }

        if (array_key_exists('status',$req))  {
            if (!in_array($req['status'],['New','Open','Closed']))  {
                header("HTTP/1.1 400 Bad Request");
                exit;
            }  else  $ticket['status'] = $req['status'];
        }

        if (array_key_exists('comment',$req) && array_key_exists('subject',$req))  {
            $ticket['last_update'] = time();
            $ticket['comments'][] = [
                    'subject'       => $req['subject'],
                    'comment'       => $req['comment'],
                    'date_created'  => time(),
                    'owner'         => $_SERVER["PHP_AUTH_USER"],
                ];
        }

        // Write file
        file_put_contents(sprintf("%s/%05d.json",$GLOBALS['TICKETNOW_DIR'],$_REQUEST['tickets_id']),
                          json_encode($ticket));

        break;

    default:
        header("HTTP/1.1 400 Bad Request");
        exit;
        break;
}

// Do not run loader, always exit
exit;

?>
