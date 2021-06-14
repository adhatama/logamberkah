<?php

namespace App\Console\Commands;

use App\Domains\HargaDasarKamiJualEmasCertiCardSqlite;
use App\Domains\SqliteHargaDasarDataSource;
use DOMDocument;
use DOMXPath;
use Goutte\Client;
use Illuminate\Console\Command;
use Symfony\Component\DomCrawler\Crawler;

class ScrapHargaDasarKamiJual extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scrap:harga-dasar-kami-jual';

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
        $hargaKamiJualPerGrams = [
            ['gram' => 0.5, 'harga' => 0],
            ['gram' => 1, 'harga' => 0],
            ['gram' => 2, 'harga' => 0],
            ['gram' => 3, 'harga' => 0],
            ['gram' => 5, 'harga' => 0],
            ['gram' => 10, 'harga' => 0],
            ['gram' => 25, 'harga' => 0],
            ['gram' => 50, 'harga' => 0],
            ['gram' => 100, 'harga' => 0],
            ['gram' => 250, 'harga' => 0],
            ['gram' => 500, 'harga' => 0],
            ['gram' => 1000, 'harga' => 0]
        ];

        $client = new Client();
        $crawler = $client->request('GET', 'https://www.logammulia.com/id/purchase/gold');

        $table = $crawler->filter('.ctd.item-2.n-1-2per3.n-540-1per3.n-768-1per5');
        $table->each(function (Crawler $node, $i) use (&$hargaKamiJualPerGrams) {
            $text = $node->text();
            $textExploded = explode('Rp', $text);
            $textTrimmed = trim($textExploded[1]);
            $textNumber = (int) str_replace(',', '', $textTrimmed);
            $hargaKamiJualPerGrams[$i]['harga'] = $textNumber;
        });

        $storage = new HargaDasarKamiJualEmasCertiCardSqlite();
        $storage->store(date('Y-m-d H:i'), $hargaKamiJualPerGrams);
    }
}
