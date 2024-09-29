<?php

$token = bin2hex(random_bytes(16));
$file = '.env';

$contents = file_get_contents($file);

if (strpos($contents, 'STATIC_API_TOKEN=') === false) {
    $contents .= "\nSTATIC_API_TOKEN=$token\n";
} else {
    $contents = preg_replace('/STATIC_API_TOKEN=.*/', "STATIC_API_TOKEN=$token", $contents);
}

file_put_contents($file, $contents);

echo "Generated static token: $token\n";
?>