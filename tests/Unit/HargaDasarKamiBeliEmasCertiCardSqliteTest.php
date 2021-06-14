<?php

namespace Tests\Unit;

use App\Domains\HargaDasarKamiBeliEmasCertiCardSqlite;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class HargaDasarKamiBeliEmasCertiCardSqliteTest extends TestCase
{
    use DatabaseTransactions;

    public function test_store()
    {
        $storage = new HargaDasarKamiBeliEmasCertiCardSqlite();

        $currentDate = date('Y-m-d H:i:s');
        $hargaArray = [1000];
        $storage->store($currentDate, $hargaArray);

        $this->assertDatabaseHas('harga_dasar_kami_beli', [
            'date' => $currentDate,
            'type' => 'emas-certicard',
            'data' => json_encode([
                'harga' => 1000,
                'date' => $currentDate
            ])
        ]);
    }
}
