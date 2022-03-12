<?php

namespace Tests\Feature\Models;

use App\Models\Permission;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PermissionTest extends TestCase
{
    use RefreshDatabase , ModelHelperTesting;

    public function model()
    {
        return new Permission();
    }

}
