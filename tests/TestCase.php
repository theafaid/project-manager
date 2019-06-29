<?php

namespace Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, RefreshDatabase;

    public function signIn($user = null)
    {
        $user = $user ?: create('App\User');
        $this->actingAs($user);

        return $this;
    }
}
