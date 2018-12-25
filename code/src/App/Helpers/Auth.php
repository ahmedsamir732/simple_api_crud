<?php 
namespace APICrud\App\Helpers;

use \Firebase\JWT\JWT;

trait Auth
{

	public function checkAuth(): array
	{
		$token = $this->jwt_decode($_SERVER['HTTP_TOKEN']);
        if (!empty($token['error'])) {
            $this->outputer->setOutput(401, ['error' => $token['error']]);
        }

        return $token;
	}
}