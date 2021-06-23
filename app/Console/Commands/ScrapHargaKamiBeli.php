<?php

namespace App\Console\Commands;

use DOMDocument;
use DOMXPath;
use Illuminate\Console\Command;

class ScrapHargaKamiBeli extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scrap:harga-kami-beli';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $hargaKamiBeli = $this->scrapPrice('https://www.logammulia.com/id/sell/gold', '//input[@id="valBasePrice"]/attribute::value');

        $input = [
            ['gram' => 1, 'harga' => $hargaKamiBeli]
        ];

        file_put_contents(base_path() . '/harga_kami_beli.storage', json_encode($input));

        return 0;
    }

    private function scrapPrice($url, $query)
    {
        $html = file_get_contents($url);

        $doc = new DOMDocument();

        libxml_use_internal_errors(true);

        if (!empty($html)) {
            $doc->loadHTML($html);
            libxml_clear_errors();

            $xpath = new DOMXPath($doc);
            $result = $xpath->query($query);
            $value = $result->item(0)->nodeValue;

            return $this->parseCurrency($value);
        }

        return 0;
    }

    public function parseCurrency($strCurrency)
    {
        if (strpos($strCurrency, 'Rp') !== false) {
            $splitted = explode('Rp', $strCurrency);
            return $this->getAmount($splitted[1]);
        }

        return $this->getAmount($strCurrency);
    }

    // Solution came from here https://stackoverflow.com/a/19764699
    public function getAmount($money)
    {
        $cleanString = preg_replace('/([^0-9\.,])/i', '', $money);
        $onlyNumbersString = preg_replace('/([^0-9])/i', '', $money);

        $separatorsCountToBeErased = strlen($cleanString) - strlen($onlyNumbersString) - 1;

        $stringWithCommaOrDot = preg_replace('/([,\.])/', '', $cleanString, $separatorsCountToBeErased);
        $removedThousandSeparator = preg_replace('/(\.|,)(?=[0-9]{3,}$)/', '', $stringWithCommaOrDot);

        $val = (int) str_replace(',', '.', $removedThousandSeparator);
        $val = (int) round($val, 0);

        return $val;
    }
}
