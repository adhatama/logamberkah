<?php

$hargaKamiJual = scrapPrice('https://www.logammulia.com/id', '//span[@class="current"]');
$hargaKamiBeli = scrapPrice('https://www.logammulia.com/id/sell/gold', '//input[@id="valBasePrice"]/attribute::value');
   
var_dump($hargaKamiBeli, $hargaKamiJual);

$path = __DIR__ . '/../db.txt';
writeToFile($path, serialize(['HARGA_BELI' => $hargaKamiBeli, 'HARGA_JUAL' => $hargaKamiJual]));

function scrapPrice($url, $query)
{
    $html = file_get_contents($url);

    $doc = new DOMDocument();

    libxml_use_internal_errors(TRUE);

    if (!empty($html)) {
        $doc->loadHTML($html);
        libxml_clear_errors();

        $xpath = new DOMXPath($doc);
        $result = $xpath->query($query);
        $value = $result->item(0)->nodeValue;

        return parseCurrency($value);
    }

    return 0;
}

function parseCurrency($strCurrency)
{
    if (strpos($strCurrency, 'Rp') !== false) {
        $splitted = explode('Rp', $strCurrency);
        return getAmount($splitted[1]);
    }

    return getAmount($strCurrency);
}

// Solution came from here https://stackoverflow.com/a/19764699
function getAmount($money)
{
    $cleanString = preg_replace('/([^0-9\.,])/i', '', $money);
    $onlyNumbersString = preg_replace('/([^0-9])/i', '', $money);

    $separatorsCountToBeErased = strlen($cleanString) - strlen($onlyNumbersString) - 1;

    $stringWithCommaOrDot = preg_replace('/([,\.])/', '', $cleanString, $separatorsCountToBeErased);
    $removedThousandSeparator = preg_replace('/(\.|,)(?=[0-9]{3,}$)/', '',  $stringWithCommaOrDot);

    $val = (int) str_replace(',', '.', $removedThousandSeparator);
    $val = (int) round($val, 0);

    return $val;
}

function writeToFile($path, $content)
{
    file_put_contents($path, $content);
}
