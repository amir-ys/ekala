<?php

namespace Tests\Feature\Models;

use App\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RoleTest extends TestCase
{
    use RefreshDatabase , ModelHelperTesting;

    public function model()
    {
        return new Role();
    }
}
