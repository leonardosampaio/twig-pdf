<?php

error_reporting(E_ERROR | E_WARNING | E_PARSE);
ini_set('max_execution_time', 60);

require_once 'vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

$prices = [
    // SKU         Price
    'TPA0308C' => 265.42,
    'TPA0308C-6' => 208.173,
    'TPA0408C' => 281.037,
    'TPA0408C-6' => 221.191,
    'TPA0508C' => 299.253,
    'TPA0508C-6' => 234.186,
    'TPA0608C' => 382.513,
    'TPA0608C-6' => 299.253,
    'TPAG0304C' => 514.303,
    'TPAG0304C-A' => 737.771,
    'TPAG0304CD' => 1028.5945,
    'TPAG0305C' => 617.987,
    'TPAG0305CD' => 1235.9855,
    'TPAG0342C' => 507.4145,
    'TPAG0342CD' => 1014.8175,
    'TPAG0404C' => 546.4455,
    'TPAG0404C-A' => 751.686,
    'TPAG0404CD' => 1092.8795,
    'TPAG0405C' => 650.532,
    'TPAG0405CD' => 1301.0525,
    'TPAG0406C' => 754.607,
    'TPAG0406CD' => 1509.2255,
    'TPAG0504C' => 650.532,
    'TPAG0504C-A' => 841.8575,
    'TPAG0504CD' => 1301.0525,
    'TPAG0505C' => 754.607,
    'TPAG0505CD' => 1509.2255,
    'TPAG0506C' => 858.6935,
    'TPAG0506CD' => 1717.387,
    'TPAG0604C' => 702.5695,
    'TPAG0604C-A' => 893.895,
    'TPAG0604CD' => 1405.139,
    'TPAG0605C' => 806.656,
    'TPAG0605CD' => 1613.3005,
    'TPAG0606C' => 910.7425,
    'TPAG0606CD' => 1821.4735,
    'TPAP3807CC' => 53.337,
    'TPAP3807EC' => 53.337,
    'TPAP3807LC' => 53.337,
    'TPAP3812C' => 130.111,
    'TPAP3812EC' => 94.967,
    'TPAP4807CC' => 57.2585,
    'TPAP4807EC' => 57.2585,
    'TPAP4807LC' => 57.2585,
    'TPAP4812C' => 130.111,
    'TPAP4812EC' => 101.4875,
    'TPAP5807CC' => 68.9425,
    'TPAP5807EC' => 68.9425,
    'TPAP5807LC' => 68.9425,
    'TPAP5812C' => 130.111,
    'TPAP5812EC' => 114.494,
    'TPAP6807CC' => 81.949,
    'TPAP6807EC' => 81.949,
    'TPAP6807LC' => 81.949,
    'TPAP6812C' => 130.111,
    'TPAP6812EC' => 130.111,
    'TPDD0565A' => 1627.4225,
    'TPDD0566A' => 1679.92,
    'TPDD0567A' => 1942.4075,
    'TPDD0568A' => 2178.652,
    'TPDD0569A' => 2467.3825,
    'TPDD0675A' => 1758.672,
    'TPDD0676A' => 1811.1695,
    'TPDD0677A' => 2099.9,
    'TPDD0678A' => 2414.885,
    'TPDD0679A' => 2703.627,
    'TPDD5610A' => 2703.627,
    'TPDD6710A' => 3018.612,
    'TPSD5610A' => 1777.42,
    'TPSD5612A' => 1829.92,
    'TPSD6710A' => 1908.67,
    'TPSD6712A' => 1961.17,
    'TPA5408C' => 286.235,
    'TPA5408C-6' => 227.7115,
    'TPAG0544C' => 546.4455,
    'TPAG0544C-A' => 737.771,
    'TPAG0544CD' => 1092.8795,
    'TPAG0545C' => 650.532,
    'TPAG0545CD' => 1301.0525,
    'TPAG0546C' => 754.607,
    'TPAG0546CD' => 1509.2255,
    'TPAP5407CC' => 67.666,
    'TPAP5407EC' => 67.666,
    'TPAP5407LC' => 67.666,
    'TPAP5412C' => 130.111,
    'TPAP5412EC' => 113.183,
    'TPDD0566ASM' => 1679.92,
    'TPDD0567ASM' => 1942.4075,
    'TPDD0568ASM' => 2178.652,
    'TPDD0676ASM' => 1811.1695,
    'TPDD0677ASM' => 2099.9,
    'TPDD0678ASM' => 2414.885,
    'TPA0306R' => 145.728,
    'TPA0406R' => 152.858,
    'TPA0506R' => 189.9685,
    'TPA0606R' => 230.2645,
    'TPAG0304R' => 382.6625,
    'TPAG0304R-A' => 573.9995,
    'TPAG0304RD' => 765.325,
    'TPAG0305R' => 455.377,
    'TPAG0305RD' => 910.7425,
    'TPAG0342R' => 377.315,
    'TPAG0342RD' => 754.607,
    'TPAG0404R' => 405.9385,
    'TPAG0404R-A' => 597.2755,
    'TPAG0404RD' => 811.8655,
    'TPAG0405R' => 481.4015,
    'TPAG0405RD' => 962.78,
    'TPAG0406R' => 611.501,
    'TPAG0406RD' => 1222.9905,
    'TPAG0504R' => 457.976,
    'TPAG0504R-A' => 649.313,
    'TPAG0504RD' => 915.952,
    'TPAG0505R' => 546.4455,
    'TPAG0505RD' => 1092.8795,
    'TPAG0506R' => 650.532,
    'TPAG0506RD' => 1301.0525,
    'TPAG0604R' => 510.025,
    'TPAG0604R-A' => 701.3505,
    'TPAG0604RD' => 1020.0385,
    'TPAG0605R' => 611.501,
    'TPAG0605RD' => 1222.9905,
    'TPAG0606R' => 689.563,
    'TPAG0606RD' => 1379.1145,
    'TPAP3606CR' => 39.0425,
    'TPAP3606ER' => 39.0425,
    'TPAP3606LR' => 39.0425,
    'TPAP3612ER' => 63.733,
    'TPAP3612R' => 96.278,
    'TPAP4606CR' => 41.6415,
    'TPAP4606ER' => 41.6415,
    'TPAP4606LR' => 41.6415,
    'TPAP4612ER' => 67.666,
    'TPAP4612R' => 96.278,
    'TPAP5606CR' => 49.45,
    'TPAP5606ER' => 49.45,
    'TPAP5606LR' => 49.45,
    'TPAP5612ER' => 79.35,
    'TPAP5612R' => 96.278,
    'TPAP6606CR' => 59.8575,
    'TPAP6606ER' => 59.8575,
    'TPAP6606LR' => 59.8575,
    'TPAP6612ER' => 96.278,
    'TPAP6612R' => 96.278,
    'TPA5406R' => 166.543,
    'TPAG0544R' => 431.963,
    'TPAG0544R-A' => 623.2885,
    'TPAG0544RD' => 863.903,
    'TPAG0545R' => 520.421,
    'TPAG0545RD' => 1040.842,
    'TPAG0546R' => 624.5075,
    'TPAG0546RD' => 1249.015,
    'TPAP5406CR' => 45.5285,
    'TPAP5406ER' => 45.5285,
    'TPAP5406LR' => 45.5285,
    'TPAP5412ER' => 74.1405,
    'TPAP5412R' => 96.278,
    'TP05009-BHA' => 9.0965,
    'TP05010-BHA' => 10.4075,
    'TP05012-ALBH' => 39.0425,
    'TP05014-ALBH' => 52.0375,
    'TP06004-BHA' => 4.5425,
    'TP06006-ALBH' => 19.55,
    'TP06007-ALBH' => 31.234,
    'TP06010-BHA' => 5.2095,
    'TP12208B' => 15.6285,
    'TP12209B' => 15.6285,
    'TP4408A' => 247.204,
    'TP4409A' => 247.204,
    'TP6609A' => 377.315,
    'TPAFBAR2' => 5.2095,
    'TPAFBRC3' => 7.82,
    'TPAFBRC4' => 7.82,
    'TPAFBRR1' => 5.2095,
    'TPSDS108' => 10.4075,
    'TP0304-CG' => 461.8975,
    'TP0304-CGA' => 653.2345,
    'TP0304-CGD' => 923.7835,
    'TP0305-CG' => 465.313,
    'TP0305-CGD' => 930.6375,
    'TP0308-2C' => 296.6425,
    'TP0342-CG' => 453.698,
    'TP0342-CGD' => 907.373,
    'TP0404-CG' => 488.589,
    'TP0404-CGA' => 679.926,
    'TP0404-CGD' => 977.178,
    'TP0405-CG' => 546.756,
    'TP0405-CGD' => 1093.5005,
    'TP0406-CG' => 651.452,
    'TP0406-CGD' => 1302.904,
    'TP0408-2C' => 311.19,
    'TP0504-CG' => 564.2015,
    'TP0504-CGA' => 755.5385,
    'TP0504-CGD' => 1128.403,
    'TP0505-CG' => 639.814,
    'TP0505-CGD' => 1279.628,
    'TP0506-CG' => 767.7745,
    'TP0506-CGD' => 1535.5605,
    'TP0508-2C' => 328.6355,
    'TP0604-CG' => 680.5355,
    'TP0604-CGA' => 871.861,
    'TP0604-CGD' => 1361.0595,
    'TP0605-CG' => 779.4125,
    'TP0605-CGD' => 1558.825,
    'TP0606-CG' => 866.663,
    'TP0606-CGD' => 1733.3145,
    'TP0608-3C' => 436.241,
    'TPDD0565' => 1627.4225,
    'TPDD0566' => 1679.92,
    'TPDD0567' => 1942.4075,
    'TPDD0568' => 2178.652,
    'TPDD0569' => 2467.3825,
    'TPDD0675' => 1758.672,
    'TPDD0676' => 1811.1695,
    'TPDD0677' => 2099.9,
    'TPDD0678' => 2414.885,
    'TPDD0679' => 2703.627,
    'TPDD5610' => 2703.627,
    'TPDD6710' => 3018.612,
    'TPDD6712' => 4037.88,
    'TPGW448' => 299.253,
    'TPGW548' => 390.3215,
    'TPSD5610' => 1777.42,
    'TPSD5612' => 1829.92,
    'TPSD6710' => 1908.67,
    'TPSD6712' => 1961.17,
    'TPDD676DPR' => 2631.844,
    'TPDD677DPR' => 2967.8625,
    'TPDD678DPR' => 3386.727,
    'TP5004-CG' => 511.8535,
    'TP5004-CGD' => 1023.707,
    'TP5008-2C' => 270.8825,
    'TPDD0566SM' => 1679.92,
    'TPDD0567SM' => 1942.4075,
    'TPDD0568SM' => 2178.652,
    'TPDD0676SM' => 1811.1695,
    'TPDD0677SM' => 2099.9,
    'TPDD0678SM' => 2414.885,
    'TP0304-RG' => 337.364,
    'TP0304-RGA' => 528.6895,
    'TP0304-RGD' => 674.7165,
    'TP0305-RG' => 348.9905,
    'TP0305-RGD' => 697.981,
    'TP0308-2R' => 197.7655,
    'TP0342-RG' => 325.726,
    'TP0342-RGD' => 649.865,
    'TP0404-RG' => 348.9905,
    'TP0404-RGA' => 540.316,
    'TP0404-RGD' => 697.981,
    'TP0405-RG' => 383.893,
    'TP0405-RGD' => 767.7745,
    'TP0406-RG' => 442.06,
    'TP0406-RGD' => 884.1085,
    'TP0408-2R' => 212.3015,
    'TP0504-RG' => 401.35,
    'TP0504-RGA' => 592.6755,
    'TP0504-RGD' => 802.677,
    'TP0505-RG' => 430.4335,
    'TP0505-RGD' => 860.844,
    'TP0506-RG' => 500.2155,
    'TP0506-RGD' => 1000.4425,
    'TP0508-2R' => 244.2945,
    'TP0604-RG' => 453.698,
    'TP0604-RGA' => 645.0235,
    'TP0604-RGD' => 907.373,
    'TP0605-RG' => 535.118,
    'TP0605-RGD' => 1070.236,
    'TP0606-RG' => 622.3685,
    'TP0606-RGD' => 1244.737,
    'TP0608-3R' => 308.2805,
    'TP0304HPG' => 368.989,
    'TP0304HPGD' => 737.978,
    'TP0305HPG' => 380.6155,
    'TP0305HPGD' => 761.231,
    'TP0404HPG' => 380.6155,
    'TP0404HPGD' => 761.231,
    'TP0405HPG' => 415.518,
    'TP0405HPGD' => 831.0245,
    'TP0408PPR' => 270.5835,
    'TP0508PPR' => 310.4425,
    'TPG44PPR' => 551.034,
    'TPG44PPRD' => 1102.068,
    'TPG45PPR' => 612.26,
    'TPG45PPRD' => 1224.52,
    'TPG54PPR' => 642.873,
    'TPG54PPRD' => 1285.746,
    'TPG55PPR' => 704.099,
    'TPG55PPRD' => 1408.198,
    'TP5004-RG' => 430.4335,
    'TP5004-RGD' => 860.844,
    'TP5008-2R' => 184.7935,
    'TP05009BH' => 6.0375,
    'TP05010BH' => 9.3495,
    'TP05011BH' => 11.5115,
    'TP05012BH' => 22.2065,
    'TP05014BH' => 45.5285,
    'TP06004BH' => 4.5425,
    'TP06005BH' => 6.0375,
    'TP06006BH' => 9.3495,
    'TP06007BH' => 16.905,
    'TP06010BH' => 4.876,
    'TP2205' => 39.238,
    'TP2206' => 42.895,
    'TP2207' => 50.876,
    'TP2208' => 55.982,
    'TP2209' => 73.416,
    'TP252506' => 52.3595,
    'TP252507' => 63.986,
    'TP252508' => 77.05,
    'TP252509' => 85.7785,
    'TP3305' => 61.0765,
    'TP3306' => 70.5065,
    'TP3307' => 84.3525,
    'TP3308' => 96.6805,
    'TP3309' => 105.409,
    'TP3311' => 145.176,
    'TP4408' => 290.8235,
    'TP4409' => 319.907,
    'TP44714' => 143.2095,
    'TP44814' => 152.674,
    'TP44914' => 174.4895,
    'TP6608' => 450.7885,
    'TP6609' => 479.8605,
    'TP6610' => 546.4455,
    'TPFB01R' => 2.093,
    'TPFB01R-F' => 3.887,
    'TPFB02C' => 2.3,
    'TPFB02C-F' => 4.5425,
    'TPFBA05R' => 3.887,
    'TPFBA06C' => 4.5425,
    'TPPFL253' => 43.631,
    'TPPFL254' => 47.9665,
    'TPPFL255' => 58.167,
    'TPPFL256' => 68.3215,
    'TPSDS114' => 16.905,
    'TPWG446' => 757.735,
    'TP12001-2BH' => 19.481,
    'TP12002-2BH' => 23.276,
    'TP12004-2BH' => 19.481,
    'TP12010-BH' => 2.6105,
    'TPDRA02C' => 7.82,
    'TPSDS058' => 14.5705,
    'TP12001-BH' => 19.481,
    'TP12002-BH' => 23.276,
    'TP12004-BH' => 19.481,
    'TP12010-2BH' => 2.6105,
    'TPDRA01R' => 7.82,
    'Flange' => 7.59,
    'NW61955BKR' => 9.4645,
    'NW6228BKC' => 9.4645,
    'TP0308HP' => 222.5365,
    'TP0404-2R' => 80.5,
    'TP0408HP' => 238.832,
    'TP09010-1B' => 26.0245,
    'TP09044B' => 36.432,
    'TP11056B' => 10.005,
    'TP347IH' => 42.297,
    'TP9010B' => 32.5105,
    'TP9X' => 1.587,
    'TP9Y' => 3.7375,
    'TPF100' => 222.9965,
    'TPF310' => 115.437,
    'TPF3100MBC' => 500.94,
    'TPF3101MBC' => 253.9545,
    'TPFM123' => 284.5675,
    'TPFM139' => 230.644,
    'TPFM144' => 196.0635,
    'TPFM145' => 451.605,
    'TPFM345' => 26.933,
    'TPHBOLTS' => 21.275,
    'TPHPB4XL' => 359.559,
    'TPIKIT60BL' => 36.501,
    'TPJB07' => 35.972,
    'TPJB55' => 22.2985,
    'TPLK40FBL' => 160.0225,
    'TPLK50FBL' => 160.0225,
    'TPR4222' => 202.3425,
    'TPR4388' => 68.632,
    'TPR4500' => 338.7095,
    'TPR4KPTO' => 123.004,
    'TPRB101' => 11.546,
    'TPRB500' => 61.5825,
    'TPRB570' => 38.479,
    'TPRB741' => 33.8905,
    'TPRB742' => 44.6085,
    'TPSDS108P' => 14.5705,
    'TPSDS348' => 14.5705,
    'TPSHG-90L' => 36.8805,
    'TPSHH-110LS' => 14.9615,
    'TPSHH-135LS' => 68.126,
    'TPSL-25' => 69.368,
    'TPSL-50' => 69.368,
    'TPSL1000' => 44.252,
    'TPSL2000' => 95.3235,
    'TPSL2000B' => 1790.8605,
    'TPSOS2510373' => 910.8,
    'TPSW2000XLS' => 877.3465,
    'TPSW2002XLS' => 1356.7125,
    'TPSW3000XLS' => 1075.25,
    'TPSW3200XLS' => 683.1,
    'TPSW4000XLS' => 1564.7475,
    'TPSW4200XLS' => 1067.2805];

// Undefined:

// TP66010
// TP06004-ALBH
// TP05009-ALBH
// TP06010-ALBH
// TP05010-ALBH
// TP-OM_BL-K
// TP09010B
// TPFM3100MBC
// TPFM3101MBC
// TPDRA01C

$loader = new \Twig\Loader\FilesystemLoader(__DIR__.'/templates');
$twig = new \Twig\Environment($loader,[]);

foreach($prices as $k => $v)
{
    //if needed, round numbers here
    // $v = round($v, 2);
    $v = '$' . $v;
    if (strpos($k,'-')!==false)
    {
        unset($prices[$k]);
        $prices[str_replace('-','',$k)] = $v;
    }
    else {
        $prices[$k] = $v;
    }
}

$context = $prices;

$context['version']  = '2021 Version 1.01';

$context['style'] = file_get_contents(__DIR__.'/templates/style.css');

//1
$context['image1'] = 'data:image/png;base64, '. 
    base64_encode(file_get_contents(__DIR__.'/libreoffice/PDF Source_html_e60215f190e3fd7f.png'));
    
//2    
$context['image2'] = 'data:image/png;base64, '. 
    base64_encode(file_get_contents(__DIR__.'/libreoffice/PDF Source_html_4efe3888f76de3ce.png'));

//5
$context['image3'] = 'data:image/png;base64, '. 
    base64_encode(file_get_contents(__DIR__.'/libreoffice/PDF Source_html_e4f835c134b51d6b.png'));
$context['image4'] = 'data:image/png;base64, '. 
    base64_encode(file_get_contents(__DIR__.'/libreoffice/PDF Source_html_e9b063ec3e818fd6.png'));    
$context['image5'] = 'data:image/png;base64, '. 
    base64_encode(file_get_contents(__DIR__.'/libreoffice/PDF Source_html_a607c5e358cf4419.png'));    

//6
$context['image6'] = 'data:image/png;base64, '. 
    base64_encode(file_get_contents(__DIR__.'/libreoffice/PDF Source_html_79ff85c4317f162c.png'));    
$context['image7'] = 'data:image/png;base64, '. 
    base64_encode(file_get_contents(__DIR__.'/libreoffice/PDF Source_html_a9d55802d73890f1.png'));    

//7
$context['image8'] = 'data:image/png;base64, '. 
    base64_encode(file_get_contents(__DIR__.'/libreoffice/PDF Source_html_30dacdddd9b3ab72.png'));
$context['image9'] = 'data:image/png;base64, '. 
    base64_encode(file_get_contents(__DIR__.'/libreoffice/PDF Source_html_709743d4813d4c92.png'));
$context['image10'] = 'data:image/png;base64, '. 
    base64_encode(file_get_contents(__DIR__.'/libreoffice/PDF Source_html_f7e25e28b74193ca.png'));
$context['image11'] = 'data:image/png;base64, '. 
    base64_encode(file_get_contents(__DIR__.'/libreoffice/PDF Source_html_2fcb1c7ec2603fd1.png'));

//8
$context['image12'] = 'data:image/png;base64, '. 
    base64_encode(file_get_contents(__DIR__.'/libreoffice/PDF Source_html_5c9a89a677c00796.png'));
$context['image13'] = 'data:image/png;base64, '. 
    base64_encode(file_get_contents(__DIR__.'/libreoffice/PDF Source_html_8fbfe9ab723119f7.png'));
$context['image14'] = 'data:image/png;base64, '. 
    base64_encode(file_get_contents(__DIR__.'/libreoffice/PDF Source_html_f75ebbcc794033e.png'));

//9
$context['image15'] = 'data:image/png;base64, '. 
    base64_encode(file_get_contents(__DIR__.'/libreoffice/PDF Source_html_b3da0b4150730cf8.png'));
$context['image16'] = 'data:image/png;base64, '. 
    base64_encode(file_get_contents(__DIR__.'/libreoffice/PDF Source_html_6052c131b7278599.png'));

//11
$context['image17'] = 'data:image/png;base64, '. 
    base64_encode(file_get_contents(__DIR__.'/libreoffice/PDF Source_html_3274db1a89198a0a.png'));
$context['image18'] = 'data:image/png;base64, '. 
    base64_encode(file_get_contents(__DIR__.'/libreoffice/PDF Source_html_519e11dcbf5b06c8.png'));
$context['image19'] = 'data:image/png;base64, '. 
    base64_encode(file_get_contents(__DIR__.'/libreoffice/PDF Source_html_fc685f70a3b195e1.png'));

//12
$context['image20'] = 'data:image/png;base64, '. 
    base64_encode(file_get_contents(__DIR__.'/libreoffice/PDF Source_html_f6c053faca790d52.png'));
$context['image21'] = 'data:image/png;base64, '. 
    base64_encode(file_get_contents(__DIR__.'/libreoffice/PDF Source_html_e61d49ad55faca9a.png'));
$context['image22'] = 'data:image/png;base64, '. 
    base64_encode(file_get_contents(__DIR__.'/libreoffice/PDF Source_html_865c957e7e9d15b6.png'));

//13
$context['image23'] = 'data:image/png;base64, '. 
    base64_encode(file_get_contents(__DIR__.'/libreoffice/PDF Source_html_f9bad52c5de3ac87.png'));

//14
$context['image24'] = 'data:image/png;base64, '. 
    base64_encode(file_get_contents(__DIR__.'/libreoffice/PDF Source_html_5c9a89a677c00796.png'));
$context['image25'] = 'data:image/png;base64, '. 
    base64_encode(file_get_contents(__DIR__.'/libreoffice/PDF Source_html_8fbfe9ab723119f7.png'));
$context['image26'] = 'data:image/png;base64, '. 
    base64_encode(file_get_contents(__DIR__.'/libreoffice/PDF Source_html_b3da0b4150730cf8.png'));

//15 and 16
$context['image27'] = 'data:image/png;base64, '. 
    base64_encode(file_get_contents(__DIR__.'/libreoffice/PDF Source_html_b9c5da01086bdde3.png'));

//17
$context['image28'] = 'data:image/png;base64, '. 
    base64_encode(file_get_contents(__DIR__.'/libreoffice/PDF Source_html_61fcc76343235735.png'));
$context['image29'] = 'data:image/png;base64, '. 
    base64_encode(file_get_contents(__DIR__.'/libreoffice/PDF Source_html_519e11dcbf5b06c8.png'));
$context['image30'] = 'data:image/png;base64, '. 
    base64_encode(file_get_contents(__DIR__.'/libreoffice/PDF Source_html_fc685f70a3b195e1.png'));

//18
$context['image31'] = 'data:image/png;base64, '. 
    base64_encode(file_get_contents(__DIR__.'/libreoffice/PDF Source_html_353d1261c5e48eab.png'));
$context['image32'] = 'data:image/png;base64, '. 
    base64_encode(file_get_contents(__DIR__.'/libreoffice/PDF Source_html_85884d04b9e32a4d.png'));

//19
$context['image33'] = 'data:image/png;base64, '. 
    base64_encode(file_get_contents(__DIR__.'/libreoffice/PDF Source_html_cc536c9b2400bb33.png'));

//20
$context['image34'] = 'data:image/png;base64, '. 
    base64_encode(file_get_contents(__DIR__.'/libreoffice/PDF Source_html_2cfb58438f89e78c.png'));
$context['image35'] = 'data:image/png;base64, '. 
    base64_encode(file_get_contents(__DIR__.'/libreoffice/PDF Source_html_212ba16a48264d15.png'));
$context['image36'] = 'data:image/png;base64, '. 
    base64_encode(file_get_contents(__DIR__.'/libreoffice/PDF Source_html_a910215661acb990.png'));

$templatesDir = __DIR__.'/templates/';

$files = scandir($templatesDir);

foreach($files as $file) {

    if (strpos($file,'.twig')===false)
    {
        continue;
    }

    $html = $twig->render($file, $context);

    echo "Rendering $file" . PHP_EOL;

    $options = new Options();
    $options->set('defaultFont', 'Garmond');
    $options->set('enable_remote', true);
    
    $dompdf = new Dompdf($options);
    $dompdf->loadHtml($html);
    $dompdf->setPaper('letter', 'portrait');

    $dompdf->render();
    file_put_contents("preview/$file.pdf", $dompdf->output());
    
    echo "Done" . PHP_EOL;
}

echo "Joining files" . PHP_EOL;
exec("gs -dBATCH -dNOPAUSE -q -sDEVICE=pdfwrite -sOutputFile=output.pdf preview/*.pdf");
echo "Done" . PHP_EOL;

echo "Check " . __DIR__. "/output.pdf";
