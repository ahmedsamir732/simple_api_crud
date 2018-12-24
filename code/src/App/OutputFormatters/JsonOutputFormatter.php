<?php
namespace APICrud\App\OutputFormatters;

class JsonOutputFormatter extends AbstractOutputFormatter
{    
    public function setOutput(int $statusCode, array $output): bool
    {
        $this->setHeader('Content-Type', 'application/json');
        // $this->setHeader('status_code', $statusCode);
        http_response_code($statusCode);

        echo json_encode($output);die;
    }
}