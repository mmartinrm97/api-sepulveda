<?php

namespace Tests\Feature\v1\GoodsClass;

use App\Models\GoodsClass;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\Traits\AssertModelJsonDataTrait;

class ListGoodsClassTest extends TestCase
{

    use RefreshDatabase, AssertModelJsonDataTrait;

    //Initialize structure json to assert
    protected array $arrayData = ['data' => []];

    /** @test */
    public function can_fetch_all_goods_classes()
    {
        $goodsClasses = GoodsClass::factory(3)->create();

        $response = $this->getJson(route('api.v1.goods-classes.index'));

        $this->arrayData['data'] = $this->goodsClassJsonData($goodsClasses);

        $response
            ->assertExactJson($this->arrayData)
            ->assertSuccessful();
    }

    /** @test */
    public function can_fetch_a_single_goods_class()
    {
        $goodsClass = GoodsClass::factory()->create();

        $response = $this->getJson(route('api.v1.goods-classes.show', $goodsClass));

        $this->arrayData['data'] = $this->goodsClassJsonData($goodsClass);

        $response
            ->assertExactJson($this->arrayData)
            ->assertSuccessful();
    }
}
