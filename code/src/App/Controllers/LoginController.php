<?php
namespace APICrud\App\Controllers;

use APICrud\App\Models\User;
use APICrud\App\Helpers\JWTHelpers;

class LoginController extends Controller
{

	use JWTHelpers;

    public function auth()
    {
        try {
        	if (isset($_POST['email'], $_POST['password'])) {
	            $user =  User::where('email', $_POST['email'])->first();
	            if ($user) {
	            	if (password_verify($_POST['password'], $user->password)) {
	            		
	            		$token = array(
						    "id" => $user->id,
						    "email" => $user->email,
						    "name" => $user->name,
						);

	        			$this->outputer->setOutput(200, ['success' => 'you have logged in', 'token' => $this->jwt_encode($token)]);
	            	}
	            }
	        	$this->outputer->setOutput(403, ['error' => 'Wrong creds: can not log you in.']);
	        }

	        $this->outputer->setOutput(403, ['error' => 'missin parameters: you must specify name, email, password']);
        } catch (\Exception $e) {        	
	        $this->outputer->setOutput(403, ['error' => $e->getMessage()]);

        }
    }
}