<?php

class BaseXEncoderTest extends \PHPUnit_Framework_TestCase
{
    public function testDefaultAlphabet()
    {
        $e = new BaseXEncoder();

        $num = 123098231;

        $res = $e->encode($num);

        $this->assertEquals($num, $e->decode($res));
    }

    public function testCustomAlphabet()
    {
        $e = new BaseXEncoder('abcdefg');

        $num = 123098231;

        $res = $e->encode($num);

        $this->assertEquals($num, $e->decode($res));
    }
}
