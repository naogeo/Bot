<?php 
error_reporting(0);

try {
     $db = new PDO("mysql:host=localhost;dbname=u1350420_seeker", "u1350420_seeker", "e35Yt6})WT11");
} catch ( PDOException $e ){
     print $e->getMessage();
}

class TelegramBot{
	const API_URL = 'https://api.telegram.org/bot';
	public $token;
	public $chatId;

	public function setToken($token){
		$this->token = $token;
	}

	public function getData(){
		$data = json_decode(file_get_contents('php://input'));
		$this->chatId = '1084713344';
		return $data->message;
	}

	public function setWebhook($url){
		return $this->request('setWebhook', [
			'url' => $url
		]);
	}

	public function sendMessage($message){
		return $this->request('sendMessage', [
			'chat_id' => '1084713344',
			'text' => $message
		]);
	}

	public function request($method, $posts){

$ch = curl_init();

$url = self::API_URL . $this->token . '/' . $method;

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($posts));

$headers = array();
$headers[] = 'Content-Type: application/x-www-form-urlencoded';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close($ch);
return $result;
	}
}

$telegram = new TelegramBot();
$telegram->setToken('1778825282:AAH9cg9W87xwB35aQVSE_8FKbBZJ9b6X5TE');

$telegram->setWebhook(''); // My Domain





$page = file_get_contents(''); //Web Address


$classname4 = 'd-flex flex-column my-md-0  text-decoration-none';
$dom = new DOMDocument;
$dom->loadHTML($page);
$xpath = new DOMXPath($dom);

$results4 = $xpath->query("//*[@class='" . $classname4 . "']");

    $review4 = $results4->item(0)->getAttribute('href');

    $ltrim = ltrim($review4,"javascript:goToLink('");
    $rtrim = rtrim($ltrim,"')");

    $review4sonuc= str_replace("[SLASH]","/",$rtrim);


$sonurunlink = '; //Web Address



$data = $telegram->getData();

$query = $db->query("SELECT * FROM lastlink WHERE id='2' AND link='{$sonurunlink}'", PDO::FETCH_ASSOC);

if ( $query->rowCount() > 0){

    print "No new product!";
    
}else{
    $telegram->sendMessage($sonurunlink);
    
    $query = $db->prepare("UPDATE lastlink SET
link = :yeni_kadi
WHERE id = :eski_kadi");
$update = $query->execute(array(
     "yeni_kadi" => $sonurunlink,
     "eski_kadi" => "2"
));
if ( $update ){
     print "New product! ;)";
}
    
}





    
    ?>