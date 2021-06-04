<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Entities\UserEntity;
use App\Models\UserModel;
use CodeIgniter\API\ResponseTrait;


class User extends BaseController
{
    use ResponseTrait;

    public function index()
    {
        // if the user is logged in, redirect to profile?
        // if they aren`t, redirect to login.
    }

    // Logging in
    public function login()
    {

        if ($this->session->get('loggedIn')) {
            return redirect()->to('/');
        }

        helper('form');
        $data = [];

        if ($this->request->getMethod() == 'post') {

            $loginData = $this->request->getPost();
            $user = new UserEntity($loginData);

            $userModel = new UserModel();

            //$loginRules = $userModel->setValidationRules();

            if (!$this->validate([
                'number' => 'required|exact_length[10]|numeric',
                'password' => 'required',
            ])) {
                $data['validation'] = $this->validator;
                //echo 'validation failed';
                //log_message('error', 'validation error');
                //if ($this->validator->hasError('number') || $this->validator->hasError('password')) {
//                    return redirect()
//                        ->back()
//                        ->with('number', $this->validator->getError('number'))
//                        ->with('password', $this->validator->getError('password'))
//                        ->withInput();
               // }
            } else {
                $dbUser = $userModel->login($user);
                if($dbUser){
                    $userEn = new UserEntity([
                        'admin' => $dbUser->admin
                    ]);
                }
                if ($dbUser) {
                    $this->session->set('loggedIn', true);
                    $this->session->set('userID', $dbUser->id);
                    if($userModel->isAdmin($userEn)){
                        $this->session->set('isAdmin', true);
                    }
                    return redirect()->to('/')->with('success', 'Successfully Logged In');
                } else {
                    return redirect()->back()->with('password', 'Incorrect credentials!')->withInput();
                }
            }
        }
            $headerData = [
                'title' => 'Login'
            ];

            echo view('templates/header', $headerData);
            echo view('user/login', $data);
            echo view('templates/footer');

    }

    // Log out user
    public function logout()
    {
        if ($this->session->get('loggedIn') == true) {
            $this->session->destroy();
            return redirect()->to('/');
        } else {
            return redirect()->to('/user/login');
        }
    }

    // Register user
    public function register()
    {
        if ($this->session->get('loggedIn') == true) {
            return redirect()->to('/');
        }
        helper('form');
        $data = [];

        if ($this->request->getMethod() == 'post') {

            $registerData = $this->request->getPost();
            $user = new UserEntity($registerData);

            $userModel = new UserModel();

            $registerRules = $userModel->getValidationRules();

            if (!$this->validate($registerRules)) {
                $data['validation'] = $this->validator;
                //return redirect()->back()->with('error', $this->validator->listErrors());
                //echo 'validation failed';
                //log_message('error', 'validation error');
                //if ($this->validator->hasError('number') || $this->validator->hasError('password')) {
//                    return redirect()
//                        ->back()
//                        ->with('number', $this->validator->getError('number'))
//                        ->with('password', $this->validator->getError('password'))
//                        ->withInput();
                //}
            }else {
                echo 'validation passed';
                //$user->password = password_hash($user->password, PASSWORD_DEFAULT);
                if($userModel->insert($user))
                {
                    return redirect()->to('/')->with('success', 'Successfully Registered');
                }else{
                    return redirect()->to('/user/register');
                }
            }

        }
            $headerData = [
                'title' => 'Register'
            ];

            echo view('templates/header', $headerData);
            echo view('user/register', $data);
            echo view('templates/footer');

    }

//    // TODO: Remove this of course...
//    public function set()
//    {
//        $this->session->set('loggedIn', true);
//    }
}
