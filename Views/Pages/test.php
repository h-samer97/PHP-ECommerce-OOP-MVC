<?php

use Core\Helper\Alert;
use Dom\Comment;
use Repositories\CommentRepository;
use Services\CSRFToken;
use Views\Layouts\Head;

echo (new Head('', ''))->Render();

// include BASE_PATH . '/Core/Config/Config.php';

// $url = "https://api.exchangerateapi.net/v1/latest?base=USD";
// $headers = ["apikey: " . EXCHANGE_RATE_API_KEY];

// $ch = curl_init($url);
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
// $response = curl_exec($ch);
// unset($ch);

// $data = json_decode($response, true);

// if (isset($data['data']) && is_array($data['data'])) {
//     echo "<h3>Exchange Rates (Base USD)</h3><ul>";
//     foreach ($data['data'] as $currency => $info) {
//         echo "<li><strong>{$currency}</strong> → {$info['value']}</li>";
//     }
//     echo "</ul>";
// }

// if (isset($data['meta'])) {
//     echo "<p>Last updated: " . htmlspecialchars($data['meta']['last_updated_at']) . "</p>";
$X=new CommentRepository();
$y = $X->findByItemId(3);
print_r($y->comments);
?>
