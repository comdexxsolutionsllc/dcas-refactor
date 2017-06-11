<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class HelpersTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertEquals('0th', str_ordinal('foo'));
        $this->assertEquals('0th', str_ordinal(0));
        $this->assertEquals('0th', str_ordinal('0'));
        $this->assertEquals('1st', str_ordinal('1'));
        $this->assertEquals('2nd', str_ordinal('2'));
        $this->assertEquals('3rd', str_ordinal('3'));
        $this->assertEquals('4th', str_ordinal('4'));
        $this->assertEquals('11th', str_ordinal('11'));
        $this->assertEquals('112th', str_ordinal('112'));
        $this->assertEquals('1,113th', str_ordinal('1113'));
        $this->assertEquals('1,000<sup>th</sup>', str_ordinal('1000', true));
    }
}
