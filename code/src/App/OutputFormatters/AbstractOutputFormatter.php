<?php
namespace APICrud\App\OutputFormatters;

abstract class AbstractOutputFormatter implements OutputFormatterInterface
{
    public function setHeader(string $type, string $value): OutputFormatterInterface
    {
        header($type.': '.$value);
        return $this;
    }
    
    abstract public function setOutput(int $statusCode, array $output): bool;
}