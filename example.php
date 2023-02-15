<?php
header('X-Accel-Buffering: no');
header('Content-Encoding: none');
header('Content-Type: text/html; charset=utf-8');

while (@ob_end_flush());
ob_implicit_flush();

$web = (php_sapi_name() !== "cli");
echo $web ? "<html><body>\n" : '';
echo $web ? "<pre>\n" : '';

include(__DIR__ . "/vendor/autoload.php");

$_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);

# echo("<pre>" . json_encode($_GET, JSON_PRETTY_PRINT) . "</pre>");


if ($web) {
    $url = $_GET['url'] ?? '';
    $url = $url ?: array_search('', $_GET);
    $url = $url ?: 'https://wordpress.org/';
} else {
    $opts = getopt("u:", ["url:"]);
    $url = $opts['url'] ?? ( $opts['u'] ?? 'https://wordpress.org/'); 
}

echo("Detecting $url ... ");

try {
    $cms = new \DetectCMS\DetectCMS($url);

    if($cms->getResult()) {
        echo $cms->getResult() . " detected!";
    } else {
        echo "Can't detect anything :(";
    }
} catch (Exception $e) {
    echo "\nError: \n\n";
    echo $web ? htmlspecialchars($e->getMessage()) : $e->getMessage();
}

echo "\n";

echo $web ? "</pre>\n" : '';
echo $web ? "</body></html>\n" : '';
