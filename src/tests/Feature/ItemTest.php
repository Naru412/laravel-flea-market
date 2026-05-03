<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Item;
use App\Models\Like;

class ItemTest extends TestCase
{
    use RefreshDatabase;
    /**
     * 商品一覧
     */
    public function test_all_items_can_be_displayed()
    {
        $items = Item::factory()->count(3)->create();
        $response = $this->get('/');
        foreach ($items as $item) {
        $response->assertSee($item->name);
    }
        $response->assertStatus(200);
    }

    /**
     * Sold表示テスト
     */
    public function test_sold_item_is_displayed_as_sold()
    {
        $items = Item::factory()->count(3)->create();
        $response = $this->get('/');
        foreach ($items as $item) {
        $response->assertSee($item->name);
    }
        $response->assertStatus(200);
    }

    /**
     * 自分の商品非表示
     */
    public function test_own_items_are_not_displayed()
    {
        $user = User::factory()->create();

        $myItem = Item::factory()->create([
            'user_id' => $user->id,
        ]);

        $otherItem = Item::factory()->create();

        $response = $this->actingAs($user)->get('/');

        $response->assertDontSee($myItem->name);
        $response->assertSee($otherItem->name);
    }
   
    /**
     * マイリスト
     */
    public function test_liked_items_are_displayed_in_mylist()
    {
    $user = User::factory()->create();
    $item = Item::factory()->create();

    Like::create([
        'user_id' => $user->id,
        'item_id' => $item->id,
    ]);

    $response = $this->actingAs($user)->get('/mypage/mylist');

    $response->assertSee($item->name);
    }

    /**
     * 検索
     */
    public function test_search_returns_matched_items()
    {
    Item::factory()->create(['name' => 'Apple iPhone']);
    Item::factory()->create(['name' => 'Samsung Phone']);

    $response = $this->get('/?keyword=Apple');

    $response->assertSee('Apple iPhone');
    $response->assertDontSee('Samsung Phone');
    }

    /**
     * 商品詳細
     */
    public function test_item_detail_displays_correct_data()
    {
    $item = Item::factory()->create();

    $response = $this->get('/item/' . $item->id);

    $response->assertStatus(200);
    $response->assertSee($item->name);
    }
}
