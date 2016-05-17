<?php

namespace App\Libraries;


class Pushwoosh {

  function __construct() {
    $this->url = 'https://cp.pushwoosh.com/json/1.3/';
  }
  

  
  private function doPostRequest($url, $data, $optional_headers = null) {
      $params = array(
          'http' => array(
              'method' => 'POST',
              'content' => $data
          ));
      if ($optional_headers !== null) {
          $params['http']['header'] = $optional_headers;
      }

      $ctx = stream_context_create($params);
      $fp = fopen($url, 'rb', false, $ctx);
      if (!$fp) {
          throw new Exception("Problem with $url, $php_errmsg");
      }

      $response = @stream_get_contents($fp);
      fclose($fp);
      // echo "<pre>" . $response . "</pre>";
      return $response;
  }

  
  
  
  // Stuurt error report als het niet lukt en returnt dan false.
  // Als het wel lukt, dan return van assoc array.
  private function apiCall( $action, $data = array() ) {
      $appCode = "5CA68-8E3D5";
      $apiToken = "bJIN8aZV0HBwTjNxB986+KHsDimfZyRd3+w9wSVwkJICnoOp81QaZKJN1qksEKLO/bH3nBkc+fkIN7suqEvA";
      
      $data['application'] = $appCode;
      $data['auth'] = $apiToken;
      $url = $this->url . $action;
      $json = json_encode( array( 'request' => $data ) );
      //try {
        $res = self::doPostRequest( $url, $json, 'Content-Type: application/json' );
        return json_decode($res, true);
      //} catch (Exception $ex) {
        //$Report = new ErrorReport( __FILE__, __LINE__, 'PUSHWOOSH probleem: ' . $e->getMessage(), json_encode($e)  );
        //$Report->setOption( 'error', $e );
        //$Report->submit();
        
      //  return false;
      //}
  }

  // @return: false als er iets niet is goed gegaan, er is dan ook al een email gestuurd.
  // @return: een array van message_codes die je op moet slaan, omdat je hierop unregistered devices moet checken.
  public function sendMessage($msg, $device_tokens) {
    $res = $this->apiCall("createMessage", array(
      'notifications' => array(
        array(
          'send_date' => 'now',
          'content' => $msg,
          'devices' => $device_tokens
        )
      )
    ));
    if ($res === false) {
      return false;
    }
    if ($res['status_code'] != '200') {
      //$Report = new ErrorReport( __FILE__, __LINE__, 'PUSHWOOSH probleem bij sendMessage', json_encode($res));
      //$Report->setOption( 'error', json_encode($res) );
      //$Report->submit();
      //return false;
      throw new Exception(json_encode($res));
    }
    $codes = array();
    if (!empty($res['response']) && !empty($res['response']['Messages'])) {
      $codes = $res['response']['Messages'];
    }
    return $codes;
  }

  // @return: 200 en een "\n" gescheiden lijst van tokens. Als deze er niet zijn,
  // dan krijg je NIETS terug (NULL / lege string).
  // Als token niet bestaat, dan krijg je JSON response terug met een status_code (bijv. van 210)
  public function getUnregisteredDevices($messageCode) {
    return $this->apiCall("getUnregisteredDevices", array(
      'message' => $messageCode
    ));
  }

  /*
  pwCall( 'createMessage', array(
      'notifications' => array(
                  array(
                      'send_date' => 'now',
                      'content' => 'test',
                      'ios_badges' => 3,
                      'data' => array( 'custom' => 'json data' ),
                      'link' => 'http://pushwoosh.com/'
                  )
              )
          )
      );
  */

}


////////// start test:

//$pushwoosh = new Pushwoosh();

//APA91bFdDermapoP2Hs0FVXX1NiMC9FLJVcEEXnRKtrHGVdKr-mkaPM9ovg4JmQMIwPVh9pllFN0nelBKVhgXkOBB5ZRLiSfJNOJiAG2oej7ZeXLiOlyYOzpYOakh8dPq60YKEtAodrM94INk_gnwWm85qbNu6L92RQ5LI-zYLkDGnB82pJ-TuY

// ec11a2be69ed032ebcbb9211c0c2d27ea7e0aa69511a8bcf9c8eec96c3277fa5

//try {
//  $result = $pushwoosh->sendMessage('Dit is een test naar alleen de Motorola van Michiel',
//    'APA91bFdDermapoP2Hs0FVXX1NiMC9FLJVcEEXnRKtrHGVdKr-mkaPM9ovg4JmQMIwPVh9pllFN0nelBKVhgXkOBB5ZRLiSfJNOJiAG2oej7ZeXLiOlyYOzpYOakh8dPq60YKEtAodrM94INk_gnwWm85qbNu6L92RQ5LI-zYLkDGnB82pJ-TuY');
//  var_dump($result);
//} catch (Exception $ex) {
//  var_dump($ex);
//}


?>
