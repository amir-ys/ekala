<?php

namespace Tests\Feature\Models;

use App\Models\Attribute;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AttributeTest extends TestCase
{
    use RefreshDatabase , ModelHelperTesting;
    public function model()
    {
        return new Attribute();
    }
}
