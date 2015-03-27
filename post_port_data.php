<?php
//use Symfony\Component\HttpFoundation\JsonResponse;
use Guzzle\Http\Client;
// This will initialize composer’s autoloader
// Instantiates a new guzzle client.
$client = new GuzzleHttp\Client();
// Get google.com’s main page as a response object.
$conn = new PDO('mysql:host=localhost;dbname=work', 'root', '');

for ($idx=4; $idx <= 100; $idx++) { 

$response = $client->get("http://www.sonub.com/?module=post&action=port_data_submit&idx='$idx'");
// Print out the body of that page to the screen.
//$data = $response->getBody();
$data = $response->json();
$data = serialize ( $data );
$sql = "INSERT INTO port_data (id, idx, data)
		VALUES (:id, :idx, :data)";
$st = $conn->prepare($sql);
$st->execute(array(':id' => $idx, ':idx' => $idx, ':data' => $data));

echo "OK!\n";

}
?>