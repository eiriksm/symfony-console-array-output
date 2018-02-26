<?php

namespace eiriksm\ArrayOutput\Test;

use eiriksm\ArrayOutput\ArrayOutput;

class ArrayOutputTest extends \PHPUnit\Framework\TestCase
{
    public function testArrayOutput()
    {
        $ao = new ArrayOutput();
        $this->assertEquals(0, count($ao->fetch()));
        // Write something.
        $ao->write('test');
        $this->assertNotEquals(0, count($ao->fetch()));
        $this->assertEquals(1, count($ao->fetch()));
        // Write something more.
        $ao->write('more');
        $this->assertEquals(1, count($ao->fetch()));
        // And then a new line.
        $ao->write('thing', true);
        // ...and something on the next one
        $ao->write('thing again', true);
        $this->assertNotEquals(1, count($ao->fetch()));
        $this->assertEquals(2, count($ao->fetch()));
        // Check the actual lines we have written.
        $lines = $ao->fetch();
        $this->assertEquals('test', $lines[0][0]);
        $this->assertEquals('more', $lines[0][1]);
        $this->assertEquals('thing', $lines[0][2]);
        $this->assertEquals('thing again', $lines[1][0]);
        // Clear it and see it is empty.
        $ao->clear();
        $this->assertEquals(0, count($ao->fetch()));
        $output = $ao->fetch();
        $this->assertEquals(true, empty($output));
    }
}
