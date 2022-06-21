<?php

namespace Tests\Feature\v1\Role;

use App\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\Traits\AssertModelJsonDataTrait;

class ListRoleTest extends TestCase
{
    use RefreshDatabase, AssertModelJsonDataTrait;

    //Initialize structure json to assert
    protected array $arrayData = ['data' => []];

    /** @test */
    public function can_fetch_all_roles()
    {
        $roles = Role::factory(2)->create();

        $response = $this->getJson(route('api.v1.roles.index'));

        $this->arrayData['data'] = $this->roleJsonData($roles);

        $response
            ->assertExactJson($this->arrayData)
            ->assertSuccessful();
    }

    /** @test */
    public function can_fetch_a_single_role()
    {
        $role = Role::factory()->create();

        $response = $this->getJson(route('api.v1.roles.show', $role));

        $this->arrayData['data'] = $this->roleJsonData($role);

        $response
            ->assertExactJson($this->arrayData)
            ->assertSuccessful();
    }
}
