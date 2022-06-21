<?php

namespace Tests\Feature\v1\GoodsGroup;

use App\Models\GoodsGroup;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\Traits\AssertModelJsonDataTrait;

class ListGoodsGroupTest extends TestCase
{
    use RefreshDatabase, AssertModelJsonDataTrait;

    //Initialize structure json to assert
    protected array $arrayData = ['data' => []];

    /** @test */
    public function can_fetch_all_goods_groups()
    {
        $goodsGroups = GoodsGroup::factory(3)->create();

        $response = $this->getJson(route('api.v1.goods-groups.index'));

        $this->arrayData['data'] = $this->goodsGroupJsonData($goodsGroups);

        $response
            ->assertExactJson($this->arrayData)
            ->assertSuccessful();
    }

    /** @test */
    public function can_fetch_a_single_goods_class()
    {
        $goodsGroup = GoodsGroup::factory()->create();

        $response = $this->getJson(route('api.v1.goods-groups.show', $goodsGroup));

        $this->arrayData['data'] = $this->goodsGroupJsonData($goodsGroup);

        $response
            ->assertExactJson($this->arrayData)
            ->assertSuccessful();
    }
}
