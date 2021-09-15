<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DatabaseTests extends TestCase
{
    /**
     * A test that checks the DB connection
     *
     * @return void
     */
    public function testUsingTestingDatabase()
    {
        $this->assertEquals('/var/home/dave/local/giftshare/database/testing.db', \DB::connection()->getDatabaseName());
    }
}
