<?php
require_once 'vendor/autoload.php';
use Dompdf\Dompdf;
use Dompdf\Options;

$loader = new \Twig\Loader\FilesystemLoader(__DIR__.'/templates');
$twig = new \Twig\Environment($loader,[]);


// Generate HTML
$html = $twig->render('price_book.html.twig', [
    'version'  => '2021 Version 1.01',
    // SKU         Price
    'TP0308-2R' => 171.97,
    'TP0408-2R' => 184.61,
]);

// Convert HTML to PDF
$options = new Options();
$options->set('defaultFont', 'Garmond');
$dompdf = new Dompdf($options);
$dompdf->loadHtml($html);
$dompdf->setPaper('letter', 'portrait');

$dompdf->render();
file_put_contents("output.pdf",$dompdf->output());
