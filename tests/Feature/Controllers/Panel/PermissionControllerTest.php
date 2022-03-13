<?php

namespace Tests\Feature\Controllers\Panel;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PermissionControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_method()
    {
        $this->actingAsUser();
        $response = $this->get(route('panel.permissions.create'));

        $response->assertViewIs('panel.permissions.create');
    }

    public function test_edit_method()
    {
        $permission = Permission::factory()->create();
        $this->actingAsUser();
        $response = $this->get(route('panel.permissions.edit' , $permission->id));

        $response->assertOk()
            ->assertViewIs('panel.permissions.edit')
            ->assertViewHas('permission' , $permission);
    }

    public function test_store_permission()
    {
        $this->actingAsUser();
        $data = Permission::factory()->make()->toArray();

        $response = $this->post(route('panel.permissions.store') , $data);

        $response->assertRedirect();
        $this->assertDatabaseCount( 'permissions',1 );
        $this->assertDatabaseHas( 'permissions', $data );
    }

    public function test_update_permission()
    {
        $this->actingAsUser();
        $permission = Permission::factory()->create();
        $data = Permission::factory()->make()->toArray();

        $response = $this->patch(route('panel.permissions.update' , $permission->id) , $data);

        $response->assertRedirect();
        $this->assertDatabaseCount( 'permissions',1 );
        $this->assertDatabaseHas( 'permissions', $data );
    }

    public function test_destroy_permission()
    {
        $this->actingAsUser();
        $permission = Permission::factory()->create();

        $response = $this->delete(route('panel.permissions.destroy' , $permission->id));

        $response->assertJson(['message' => 'پرمیژن '.$permission->fa_name.'  حذف شد.']);
        $this->assertDatabaseCount('permissions' , 0);
        $this->assertDatabaseMissing('permissions' , $permission->toArray());

    }

    public function actingAsUser()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
    }
}
