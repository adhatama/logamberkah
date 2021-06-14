<?php

namespace App\Console\Commands;

use App\Domains\HargaDasarKamiBeliEmasCertiCardSqlite;
use App\Domains\RedisHargaDasarDataSource;
use App\Domains\SqliteHargaDasarDataSource;
use DOMDocument;
use DOMXPath;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class ScrapHargaDasarKamiBeli extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scrap:harga-dasar-kami-beli';

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

        $storage = new HargaDasarKamiBeliEmasCertiCardSqlite();
        $storage->store(date('Y-m-d H:i'), [$hargaKamiBeli]);

        return 0;
    }

    private function scrapPrice($url, $query)
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

            return $this->parseCurrency($value);
        }

        return 0;
    }

    function parseCurrency($strCurrency)
    {
        if (strpos($strCurrency, 'Rp') !== false) {
            $splitted = explode('Rp', $strCurrency);
            return $this->getAmount($splitted[1]);
        }

        return $this->getAmount($strCurrency);
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
}
