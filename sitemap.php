<?php
header('Content-Type: application/xml');
echo '<?xml version="1.0" encoding="UTF-8"?>';

$data  = require_once __DIR__ . '/app/Models/Blame/data.php';
$count = count($data);
$host  = 'http://' . $_SERVER['HTTP_HOST'];
$urls  = array(
    '/', '/about/', '/blame/'
);
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
<?php
foreach ($urls as $url) {
    echo "<url><loc>{$host}{$url}</loc></url>";
}
for ($i = 1; $i <= $count; $i++) {
    echo "<url><loc>{$host}/blame/{$i}</loc></url>";
}
?>
</urlset>