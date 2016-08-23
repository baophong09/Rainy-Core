<?php

namespace Rainy\Database\Connectors;

interface ConnectorInterface
{
    /**
     * Every connector need connect
     */
    public function connect($config);
}