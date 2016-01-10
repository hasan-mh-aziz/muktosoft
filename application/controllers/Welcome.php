<?php
defined('BASEPATH') OR exit('No direct script access allowed');



class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{



		/*$name= "MariaSharapova";

		//making signature
		$oauth_hash = '';
		$oauth_hash .= 'count=200&';
		$oauth_hash .= 'oauth_consumer_key=TqqdcVvf22FIC8ValVhHhezaa&';
		$oauth_hash .= 'oauth_nonce=' . time() . '&';
		$oauth_hash .= 'oauth_signature_method=HMAC-SHA1&';
		$oauth_hash .= 'oauth_timestamp=' . time() . '&';
		$oauth_hash .= 'oauth_token=4737622710-xEAG54w6XHCLjc4juwYG69N2CDZrH3yXajLRZ7Z&';
		$oauth_hash .= 'oauth_version=1.0&';
		$oauth_hash .= 'screen_name=' . $name;
		$base = '';
		$base .= 'GET';
		$base .= '&';
		$base .= rawurlencode('https://api.twitter.com/1.1/statuses/user_timeline.json');
		$base .= '&';
		$base .= rawurlencode($oauth_hash);
		$key = '';
		$key .= rawurlencode('sRZUR3EPL6uhygc4QkpRKDehF40dqrzJBUbD4GAhggiEFdIbh4');
		$key .= '&';
		$key .= rawurlencode('SeJiphWb7NDKf8SAQJS8pWQwZcKhVtjeX6R9bK3HkPNls');
		$signature = base64_encode(hash_hmac('sha1', $base, $key, true));
		$signature = rawurlencode($signature);

		//create cURL header
		$oauth_header = '';
		$oauth_header .= 'count="200", ';
		$oauth_header .= 'oauth_consumer_key="TqqdcVvf22FIC8ValVhHhezaa", ';
		$oauth_header .= 'oauth_nonce="' . time() . '", ';
		$oauth_header .= 'oauth_signature="' . $signature . '", ';
		$oauth_header .= 'oauth_signature_method="HMAC-SHA1", ';
		$oauth_header .= 'oauth_timestamp="' . time() . '", ';
		$oauth_header .= 'oauth_token="4737622710-xEAG54w6XHCLjc4juwYG69N2CDZrH3yXajLRZ7Z", ';
		$oauth_header .= 'oauth_version="1.0", ';
		$oauth_header .= 'screen_name="' . $name . '"';
		$curl_header = array("Authorization: Oauth {$oauth_header}", 'Expect:');


		//create cURL request
		$curl_request = curl_init();
		curl_setopt($curl_request, CURLOPT_HTTPHEADER, $curl_header);
		curl_setopt($curl_request, CURLOPT_HEADER, false);
		curl_setopt($curl_request, CURLOPT_URL, 'https://api.twitter.com/1.1/statuses/user_timeline.json?count=200&screen_name=' . $name ."");
		curl_setopt($curl_request, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl_request, CURLOPT_SSL_VERIFYPEER, false);
		$json = curl_exec($curl_request);
		curl_close($curl_request);



		$obj= json_decode($json);
		$total_tweet=count($obj) ;

		$daycount=array(0,0,0,0,0,0,0);

		//echo $total_tweet;
		for ($x = 0; $x<$total_tweet ; $x++) {
    		

    		$token = strtok($obj[$x]->created_at, " ");
    		echo "$token<br>";
    		switch ($token) {
			    case "Sun":
			        $daycount[0]++;
			        break;
			    case "Mon":
			        $daycount[1]++;
			        break;
			    case "Tue":
			        $daycount[2]++;
			        break;
			    case "Wed":
			        $daycount[3]++;
			        break;
			    case "Thu":
			        $daycount[4]++;
			        break;
			    case "Fri":
			        $daycount[5]++;
			        break;
			    case "Sat":
			        $daycount[6]++;
			        break;
			}
		} 

		$maxCount= $daycount[0];
		$maxDay=0;

		for($x=1; $x<7 ; $x++){
			echo "$daycount[$x]<br>";
			if($daycount[$x]> $maxCount){
				$maxCount=$daycount[$x];
				$maxDay=$x;
			}
		}

		echo $maxDay , "<br>";

		$hourCount=array_fill(0,24,0);

		for ($x = 0; $x<$total_tweet ; $x++) {
    		//echo $obj[$x]->created_at ," " ;
   
    		$d= date_parse($obj[$x]->created_at);
    		$hour= $d['hour'] ;
    		echo $hour, "<br>";
    		$hourCount[$hour]++;
    	}

    	$maxHourCount= $hourCount[0];
    	$maxHour= 0;

    	for ($x = 0; $x<24 ; $x++) {
    		echo $hourCount[$x] , "<br>";
    		if($hourCount[$x]> $maxHourCount){
    			$maxHourCount= $hourCount[$x];
    			$maxHour= $x;
    		}
    	}

    	echo $maxHour, "<br>";

		$string = "Hello world. Beautiful day today.";
		$token = strtok($string, " ");

		echo "$token<br>";
		while ($token !== false)
		{
			echo "$token<br>";
			$token = strtok(" ");
		} 

		//echo $obj[3]->created_at;*/


		$this->load->view('welcome_message');


		
	}

	public function active(){
		$twitter_id=$this->uri->segment(2);
		$time_span=$this->uri->segment(3);

		echo $twitter_id;
		echo $time_span;
	}
		
}
