<?php 

namespace App\Traits;

trait ApiResponses {

	public function returnData($data,$msg,$success = true){
		return response()->json([
			'status' => $success,
			'data' => $data,
			'msg' => $msg
		]);
	}

	/// Error Messge Reponse
	public function returnError($msg,$msgsCount = 1,$code = 400){
		return response()->json([
			'status' => false,
			'code' => $code,
			'msgsCount' => $msgsCount,
			'msg' => $msg
		]);
	}

	public function returnSuccess($msg,$code = 200){
		return response()->json([
			'code' => $code,
			'success' => true,
			'msg' => $msg
		]);
	}

}