<?php

namespace CaoMinhDuc\ExcelTemplate\Tests;

use Orchestra\Testbench\TestCase;
use CaoMinhDuc\ExcelTemplate\ExcelTemplateServiceProvider;

class ExampleTest extends TestCase
{

    protected function getPackageProviders($app)
    {
        return [ExcelTemplateServiceProvider::class];
    }
    
    /** @test */
    public function true_is_true()
    {
        $this->assertTrue(true);
    }
}
