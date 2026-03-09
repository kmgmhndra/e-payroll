<?php
$ch = curl_init('http://127.0.0.1:8000/admin/salary/31/print');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 10);
curl_setopt($ch, CURLOPT_HEADER, true);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$error = curl_error($ch);
curl_close($ch);

echo "HTTP Code: $httpCode\n\n";
if ($error) {
    echo "CURL Error: $error\n";
}
echo "Response (first 2000 chars):\n";
echo substr($response, 0, 2000) . "\n";
?>
