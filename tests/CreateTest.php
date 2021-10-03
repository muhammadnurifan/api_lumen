<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use App\Models\Item;

class CreateTest extends TestCase
{
    public function testGetData()
    {
        $response = $this->call('GET', 'item-list');

        $this->assertEquals(200, $response->status());
    }

    public function testPostData()
    {
        $value = [
            'item_code' => 'ITM-0006',
            'item_name' => 'gula',
            'uom' => 'Pcs'
        ];

        $this->post('item-create', $value)->assertEquals(200, $this->response->status());
    }

}
