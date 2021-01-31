<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function getResponseData($response, $key)
    {
        $content = $response->getOriginalContent();

        $content = $content->getData();

        return $content[$key];
    }
}
