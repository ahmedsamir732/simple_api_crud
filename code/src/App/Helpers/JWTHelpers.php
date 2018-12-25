<?php 
namespace APICrud\App\Helpers;

use \Firebase\JWT\JWT;

trait JWTHelpers
{
	private $KEY = 'simple_api_crud';

	public function jwt_encode(array $token): string
	{
		return JWT::encode($token, $this->KEY);
	}

	public function jwt_decode(string $token): array
	{
		return (array) JWT::decode($token, $this->KEY, array('HS256'));
	}
}