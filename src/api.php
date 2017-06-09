<?php
use Sridharkalaibala\ReadFile;
header('Content-Type: application/json');
include_once 'ReadFile.php';
try {
    if(isset($_REQUEST['file']) && is_file($_REQUEST['file']) && isset($_REQUEST['page'])) {
        $file_name = $_REQUEST['file'];
        $page = $_REQUEST['page'];
        $file = new ReadFile($file_name);
        $returnData = [];

        $allowed =  array('txt','log');
        $ext = pathinfo($file_name, PATHINFO_EXTENSION);
        if(!in_array($ext,$allowed) ) {
            throw new Exception('Only txt and log extensions allowed',400);
        }

        if($page === 'first' || $page == 1) {
            $returnData = $file->readPage();
        }else if($page === 'last') {
            $returnData = $file->readLastPage();
        }else if($page <= 0){
            throw new Exception('Already you are in First Page.',500);
        } else {
            $returnData = $file->readNthPage((int) $page);
        }

        if(count($returnData) == 0)
            throw new Exception('End of File. Resetting to First ',500);
        echo json_encode(['status'=>'success','message'=>'got data','data'=>$returnData]);
    }else {
        throw new Exception('Request is not valid',400);
    }
} catch (Exception $e) {
    echo json_encode(['status'=>'error','message'=>$e->getMessage(),'data'=>$e->getCode()]);
}