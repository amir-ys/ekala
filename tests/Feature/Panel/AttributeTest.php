<?php

namespace Tests\Feature\Panel;

use App\Models\Attribute;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AttributeTest extends TestCase
{
    use RefreshDatabase , WithFaker;

    public function test_normal_user_can_not_see_attributes_index()
    {
        $this->get(route('panel.attributes.index'))->assertStatus(302);
    }

    public function test_auth_user_can_see_attributes_index()
    {
        $this->actingAsUser();
        $this->get(route('panel.attributes.index'))->assertStatus(200);
    }

    public function test_normal_user_can_not_create_attribute()
    {
        $this->post(route('panel.attributes.store') , $this->getAttributeData());
        $this->assertEquals(0 , Attribute::count());
    }

    public function test_auth_user_can_create_attribute()
    {
        $this->actingAsUser();
        $this->post(route('panel.attributes.store') , $this->getAttributeData());
        $this->assertEquals(1 , Attribute::count());
    }

    public function test_normal_user_can_not_update_attribute()
    {
        $newName = '::power::' ;
        $attribute =  $this->createAttribute();
        $this->patch(route('panel.attributes.update' , $attribute->id ) , [
            'name' => $newName,
        ]);
        $this->assertEquals('::size::' , Attribute::whereId($attribute->id)->first()->name);
    }

    public function test_auth_user_can_update_attribute()
    {
        $newName = '::power::' ;
        $this->actingAsUser();
        $attribute = $this->createAttribute();
        $this->patch(route('panel.attributes.update' , $attribute->id ) , [
            'name' => $newName,
        ]);
        $this->assertEquals('::power::' , Attribute::whereId($attribute->id)->first()->name);
    }

    public function test_normal_user_can_not_delete_attribute()
    {
        Attribute::create($this->getAttributeData());
        $this->delete(route('panel.attributes.destroy' , 1 ));
        $this->assertEquals(1 , Attribute::count());
    }

    public function test_auth_user_can_delete_attribute()
    {
        $this->actingAsUser();
        $attribute = $this->createAttribute();
        $this->delete(route('panel.attributes.destroy' , $attribute->id ));
        $this->assertEquals(0 , Attribute::count());
    }

    private function actingAsUser()
    {
        $user = User::factory()->create();
        return  $this->actingAs($user);
    }

    private function createAttribute()
    {
        return  Attribute::create($this->getAttributeData());
    }

    private function getAttributeData(): array
    {
        return [
            'name' => '::size::',
        ];
    }
}
