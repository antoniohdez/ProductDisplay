<?php
require_once 'HTTP/Request2.php';
require_once 'SignatureBuilder.php';

class PostNewTarget{
	//Server Keys
	private $access_key 	= "346999f142802ecaf9b221bcb2fc1003228b8d97";
	private $secret_key 	= "85334b6028015efca72c4a17d72870a7b944cb46";

	private $targetId 		= "";
	private $url 			= "https://vws.vuforia.com";
	private $requestPath 	= "/targets";
	private $request;       // the HTTP_Request2 object
	private $jsonRequestObject;

	private $targetName 	= "";
	private $imageLocation 	= "UploadedMedia/image/";
	
	function PostNewTarget($name, $location, $width){
		$this->targetName = $name;
		$this->imageLocation = $location;
		
		$this->jsonRequestObject = json_encode(array(
			'width'=>$width,
			'name'=>$this->targetName,
			'image'=>$this->getImageAsBase64(),
			'application_metadata'=>base64_encode("Vuforia test metadata")
			,'active_flag'=>1
		));
		//var_dump($this->jsonRequestObject);
		$this->execPostNewTarget();

	}
	
	function getImageAsBase64(){
		$file = file_get_contents($this->imageLocation);
		if($file){
			$file = base64_encode($file);
		}
		return $file;
	}

	public function execPostNewTarget(){
		$this->request = new HTTP_Request2();
		$this->request->setMethod( HTTP_Request2::METHOD_POST );
		$this->request->setBody( $this->jsonRequestObject );

		$this->request->setConfig(array(
				'ssl_verify_peer' => false
		));
		$this->request->setURL( $this->url . $this->requestPath );
		// Define the Date and Authentication headers
		$this->setHeaders();
		try {
			$response = $this->request->send();
			if (200 == $response->getStatus() || 201 == $response->getStatus() ) {
				//echo $response->getBody();
				$this->targetId = json_decode($response->getBody(),true)["target_id"];
			} else {
				echo 'Unexpected HTTP status: '.$response->getStatus().' '.$response->getReasonPhrase().' '.$response->getBody();
			}
		} catch (HTTP_Request2_Exception $e) {
			echo 'Error: ' . $e->getMessage();
		}
	}

	public function get_target_id(){
		return $this->targetId;
	}

	private function setHeaders(){
		$sb = 	new SignatureBuilder();
		$date = new DateTime("now", new DateTimeZone("GMT"));
		// Define the Date field using the proper GMT format
		$this->request->setHeader('Date', $date->format("D, d M Y H:i:s") . " GMT" );
		$this->request->setHeader("Content-Type", "application/json" );
		// Generate the Auth field value by concatenating the public server access key w/ the private query signature for this request
		$this->request->setHeader("Authorization" , "VWS " . $this->access_key . ":" . $sb->tmsSignature( $this->request , $this->secret_key ));
	}
}
?>
