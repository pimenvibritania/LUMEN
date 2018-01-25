<?php 
	
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
	public function register(Request $request)
	{
		$hasher		= app()->make('hash');
		
		$username	= $request->input('username');
		$email		= $request->input('email');
		$password	= $hasher->make($request->input('password'));

		$register	= User::create([

			'username'	=> $username,
			'email'		=> $email,
			'password'	=> $password,
		]);

		if ($register) {
			
			$res['success']	= true;
			$res['message']	= 'Success Register!';

			return response($res);
		} 
		else {
		
			$res['success']	= false;
			$res['message']	= 'Failed to Register!';

			return response($res);	
		}
	}

	public function get_user(Request $request, $id)
	{
		
		$user = User::where('id', $id)->get();
		if ($user) {
			$res['success']	= true;
			$res['message']	= $user;
		}
		else {
			$res['success']	= true;
			$res['message']	= 'Cannot find user!';

			return response($res);
		}
	}
}

