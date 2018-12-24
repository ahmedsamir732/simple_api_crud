<?php
namespace APICrud\App\OutputFormatters;

interface OutputFormatterInterface
{
    public function setHeader(string $type, string $value): self;
    
    public function setOutput(int $statusCode, array $output): bool;
}