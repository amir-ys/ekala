<?php

namespace Tests\Feature\Controllers\Panel;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RoleControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_method()
    {
        $this->actingAsUser();
        $response = $this->get(route('panel.roles.create'));

        $response->assertViewIs('panel.roles.create')
            ->assertViewHas('permissions' , Permission::all());
    }

    public function test_edit_method()
    {
        $role = Role::factory()->create();
        $this->actingAsUser();
        $response = $this->get(route('panel.roles.edit' , $role->id));

        $response->assertOk()
            ->assertViewIs('panel.roles.edit')
            ->assertViewHas('role' , $role)
            ->assertViewHas('permissions' , Permission::all() );
    }

    public function test_store_role()
    {
        $count = rand(1,10);
        $this->actingAsUser();
        $permissions = Permission::factory()->count($count)->create();
        $role = Role::factory()->make()->toArray();
        $data = array_merge($role ,  [ 'permissions' => $permissions->pluck('id')->toArray()]);

        $response = $this->post(route('panel.roles.store') , $data);

        $response->assertRedirect();
        $this->assertDatabaseCount( 'roles',1 );
        $this->assertDatabaseHas( 'roles', $role  );
        $this->assertDatabaseCount( 'role_has_permissions' ,$count );
    }

    public function test_update_role()
    {
        $this->withoutExceptionHandling();
        $count = rand(1,10);
        $this->actingAsUser();
        $role = Role::factory()->create();
        $permissions = Permission::factory()->count($count)->create();
        $newRole = Role::factory()->make()->toArray();
        $data = array_merge($newRole , [ 'permissions' =>  $permissions->pluck('id')->toArray()]);

        $response = $this->patch(route('panel.roles.update' , $role->id) , $data);

        $response->assertRedirect();
        $this->assertDatabaseCount( 'roles',1 );
        $this->assertDatabaseHas( 'roles', $newRole );
        $this->assertDatabaseCount( 'role_has_permissions' ,$count );
    }

    public function test_destroy_role()
    {
        $this->actingAsUser();
        $role = Role::factory()->create();

        $response = $this->delete(route('panel.roles.destroy' , $role->id));

        $response->assertJson(['message' => 'نقش کاربری '.$role->fa_name.'  حذف شد.']);
        $this->assertDatabaseCount('roles' , 0);
        $this->assertDatabaseMissing('roles' , $role->toArray());

    }

    public function actingAsUser()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
    }
}
