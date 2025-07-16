<?php 
header(header:'Content-Type: application/json'); 

//define the JSON file path
$file = 'bookmarks.json';

//initialize the file if it doesn't exist

if(!file_exists($file)){
    file_put_contents( $file, []);
}

//Get the request action
$action = $_REQUEST['action'] ?? '';

//handle different actions
switch($action){
    case 'get':
        //return all bookmarks
        echo file_get_contents($file);
        break;

        case 'add':
            //add a new bookmark
            json_decode(file_get_contents($file),true);

            $newBokkmark = [
                'id' => uniqid(),
                'title' => $_POST['title'],
                'url' => $_POST['url'],
                'create_at' => date('Y-m-d  H:i:s')
            ];

            $bookmarks[] = $newBokkmark;
            file_put_contents($file, json_encode($Bokkmark, flags: JSON_PRETTY_PRINT));

            echo json_encode(['status' => 'succes']);
            break; 

            case 'delete':
                //delete a bookmarks
                $bookmarks = json_decode(file_get_contents($file),true);
                $id = $_POST['id'] ;

                $bookmarks = array_filter($bookmarks, function($bookmarks) use ($id) {
                     return $bookmarks['id'] == $id; });

                     file_put_contents($file,json_encode(array_values($bookmarks), JSON_PRESERVE_ZERO_FRACTION));

                     echo json_encode(['status' =>'succes']);
                     break;

                     default:
                     echo json_encode(['status'=> 'error','message'=> 'Invalid action']);
        }