<?php

use Sridharkalaibala\ReadFile;

class ReadFileTest extends PHPUnit_Framework_TestCase
{
    public function test_has_returns_true_if_a_config_item_is_set()
    {
        $config = new ConfigRepository(['paths' => ['base' => 'path', 'app' => 'path']]);

        $this->assertTrue($config->has('paths'));
    }

}