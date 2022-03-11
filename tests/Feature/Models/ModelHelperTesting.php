<?php

namespace  Tests\Feature\Models;


use App\Models\User;

trait ModelHelperTesting {
    abstract public function model();
    public function test_insert_data ()
    {
        $data = $this->model()::factory()->make()->toArray();
        if ($this->model() instanceof User){
            $data['password'] = "123456";
            $data['remember_token'] = null;
        }
        $this->model()::create($data);

        $this->assertDatabaseCount($this->model()->getTable() , 1);
        $this->assertDatabaseHas($this->model()->getTable() , $data);
    }

}
