<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DbNameTest extends TestCase
{
    /**
     * A basic feature test example.
     */
 public function test_which_database_is_being_used()
    {
      $db = \DB::getDatabaseName();
      dump("BASE USADA: " . $db);
      $this->assertTrue(true);
    }
}
