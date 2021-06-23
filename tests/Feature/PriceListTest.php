<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetHargaKamiBeliInGrams()
    {
        $response = $this->get('/harga-kami-beli/emas');

        $response->assertStatus(200);
    }
}
