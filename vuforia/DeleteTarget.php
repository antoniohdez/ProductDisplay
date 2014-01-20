<?php
require_once 'HTTP/Request2.php';
require_once 'SignatureBuilder.php';

class DeleteTarget{
	//Server Keys
	private $access_key 	= "346999f142802ecaf9b221bcb2fc1003228b8d97";
	private $secret_key 	= "85334b6028015efca72c4a17d72870a7b944cb46";
	
	private $targetId 		= "";
	private $url 			= "https://vws.vuforia.com";
	private $requestPath 	= "/targets/";
	private $request;
	private $deleted = false;
	
	function DeleteTarget($targetId){
		$this->targetId = $targetId;
		$this->requestPath = $this->requestPath.$this->targetId;
		$this->execDeleteTarget();
	}

	public function execDeleteTarget(){
		$this->request = new HTTP_Request2();
		$this->request->setMethod( HTTP_Request2::METHOD_DELETE );
		$this->request->setConfig(array(
				'ssl_verify_peer' => false
		));
		$this->request->setURL( $this->url . $this->requestPath );
		// Define the Date and Authentication headers
		$this->setHeaders();
		try {
			$response = $this->request->send();
			if (200 == $response->getStatus()) {
				//echo $response->getBody();
				$this->deleted = true;
			} else {
				//echo 'Unexpected HTTP status: '.$response->getStatus().' '.$response->getReasonPhrase().' '.$response->getBody();

			}
		} catch (HTTP_Request2_Exception $e) {
			echo 'Error: '.$e->getMessage();
		}
	}

	public function deleted(){
		return $this->deleted;
	}

	private function setHeaders(){
		$sb = 	new SignatureBuilder();
		$date = new DateTime("now", new DateTimeZone("GMT"));
		// Define the Date field using the proper GMT format
		$this->request->setHeader('Date', $date->format("D, d M Y H:i:s") . " GMT" );
		// Generate the Auth field value by concatenating the public server access key w/ the private query signature for this request
		$this->request->setHeader("Authorization" , "VWS " . $this->access_key . ":" . $sb->tmsSignature( $this->request , $this->secret_key ));
	}
}
?>