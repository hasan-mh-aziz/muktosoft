<?php
    
    class Hashtag extends CI_Controller{

    	public function index( ){
    		

			$twitter_id=$_GET['twitter_id'];
			$n=$_GET['n'];

            $name= $twitter_id;

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
            $hashtags=array();

            for($x=0; $x< $total_tweet; $x++){

                $hashtagCount= count($obj[$x]->entities->hashtags);

                for($y=0; $y< $hashtagCount; $y++){
                    array_push($hashtags, $obj[$x]->entities->hashtags[$y]->text);
                }
                
            }

           
            $uniqueHashtags= array_count_values($hashtags);
            arsort($uniqueHashtags);
            //print_r($uniqueHashtags);
            $z=$n;
            $result= array();

            while (list($key, $val) = each($uniqueHashtags))
            {
                //echo "$key => $val<br>";
                $result[''.$key]=  $val;
                
                if($z==1)
                    break;
                else 
                    $z--;
            }          

            
            //$result=  array(''.$maxHour=> $maxHourCount );
            

            $jsonResult= json_encode($result);
            echo $jsonResult;              

                
        }
    	
    }
    
?>