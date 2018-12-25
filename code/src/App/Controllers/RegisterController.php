<?php
namespace APICrud\App\Controllers;

use APICrud\App\Models\User;

class RegisterController extends Controller
{
    public function create()
    {
        try {
        	if (isset($_POST['name'], $_POST['email'], $_POST['password'])) {
	            $user = new User;
	            $user->name = $_POST['name'];
	            $user->email = $_POST['email'];
	            $user->password = password_hash($_POST['password'], PASSWORD_DEFAULT);

	            if ($user->save()) {
	        		$this->outputer->setOutput(200, ['success' => 'user have registered successfully!']);
	            }

		        $this->outputer->setOutput(403, ['error' => 'we could not reguster you reight now, please try again later.']);
	        }

	        $this->outputer->setOutput(403, ['error' => 'missin parameters: you must specify name, email, password']);
        } catch (\Exception $e) {
        	if (stripos($e->getMessage(), 'Duplicate entry')) {
        		
	        	$this->outputer->setOutput(403, ['error' => 'your email is registered before please try to login with it.']);
        	}

	        $this->outputer->setOutput(403, ['error' => $e->getMessage()]);

        }
    }
}