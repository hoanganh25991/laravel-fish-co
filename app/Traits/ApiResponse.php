<?php
namespace App\Traits;

use Response;

define("STATUS_CODE", "statusCode");
define("STATUS_MSG", "statusMsg");
define("DATA", "data");
define("WARNING", "we still not handle this situation");

trait ApiResponse{
    public function res($data, $statusMsg = "success", $statusCode = 200){
        return Response::json([
            STATUS_CODE => $statusCode,
            STATUS_MSG => $statusMsg,
            DATA => $data
        ], $statusCode);
    }
}
