<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
class UserController extends BaseController
{
    
    public function index()
    {
        helper(['form']);
        $data = [];
        echo view('signup', $data);
    }
    public function signin(){
        helper(['form']);
        $data = [];
        echo view('signin', $data);
    }
    public function store()
    {
        $session = session();
        helper(['form']);
        $rules = [
            'full_name' => 'required|min_length[2]|max_length[50]',
            'gender' => 'required',
            'city' => 'required|min_length[2]|max_length[50]',
            'state' => 'required|min_length[2]|max_length[50]',
            'status' => 'required',
            'username' => 'required|min_length[2]|max_length[50]',
            'email'=> 'required|min_length[4]|max_length[100]|valid_email|is_unique[users.email]',
            'password'=> 'required|min_length[4]|max_length[50]',
        ]; 
        if($this->validate($rules)){
            $file = $this->request->getFile("profile_picture");
            $file_type = $file->getClientMimeType();
            $valid_file_types = array("image/png", "image/jpeg", "image/jpg");
            $session = session();
            if (in_array($file_type, $valid_file_types)) {
                $profile_image = $file->getName();
                if ($file->move("images", $profile_image)) {
                    $userModel = new UserModel();
                    $data = [
                        "profile_picture" => $profile_image,
                        'full_name'     => $this->request->getVar('full_name'),
                        'gender'     => $this->request->getVar('gender'),
                        'city'     => $this->request->getVar('city'),
                        'state'     => $this->request->getVar('state'),
                        'status'     => $this->request->getVar('status'),
                        'address'     => $this->request->getVar('address'),
                        'username'     => $this->request->getVar('username'),
                        'email'    => $this->request->getVar('email'),
                        'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT)
                    ];
                    if($userModel->insert($data)){
                        $session->setFlashdata("success", "Data saved successfully");
                        return redirect()->to('signup');
                    }else{
                        $session->setFlashdata("error", "Failed to save data");
                        return redirect()->to('signup');
                    }
                } else {
                    $session->setFlashdata("error", "Failed to move file");
                    return redirect()->to('signup');
                }
            } else {
                // invalid file type
                $session->setFlashdata("error", "Invalid file type selected");
                return redirect()->to('signup');
            }
            
        }else{
            $data['validation'] = $this->validator;
            echo view('signup', $data);
        } 
    }

    public function update()
    {
        $userModel = new UserModel();
        $session = session();
        helper(['form']);
        $rules = [
            'full_name' => 'required|min_length[2]|max_length[50]',
            'gender' => 'required',
            'city' => 'required|min_length[2]|max_length[50]',
            'state' => 'required|min_length[2]|max_length[50]',
        ]; 
        if($this->validate($rules)){
            $id = $this->request->getVar('id');
            $full_name = $this->request->getVar('full_name');
            $gender = $this->request->getVar('gender');
            $city = $this->request->getVar('city');
            $state = $this->request->getVar('state');
            $address = $this->request->getVar('address');
            $filenamet = '';
            if($file = $this->request->getFile("profile_picture")){
                $file_type = $file->getClientMimeType();
                $valid_file_types = array("image/png", "image/jpeg", "image/jpg");
                $session = session();
                if (in_array($file_type, $valid_file_types)) {
                    $profile_image = $file->getName();
                    $filenamet = $file->getName();
                    if ($file->move("images", $profile_image)) {

                    }
                }
            }
            if($filenamet !=''){
                $data = [
                    'profile_picture'=>$profile_image,
                    'full_name'		=> $full_name,
                    'gender'		=> $gender,
                    'city'		=> $city,
                    'state'			=> $state,
                    'address'			=> $address,
                ];
            }else{
                $data = [
                    'full_name'		=> $full_name,
                    'gender'		=> $gender,
                    'city'		=> $city,
                    'state'			=> $state,
                    'address'			=> $address,
                ];
            }
            $result = $userModel->update($id, $data);
            if($result) {
                $session->setFlashdata("success", "User details are updated successfully.");
                 return redirect()->to('profile');
            } else {
                $session->setFlashdata("error", "Something went wrong!");
                 return redirect()->to('profile');
            }
        }else{
            $session->setFlashdata("error", "Invalid input!");
            return redirect()->to('profile');
        } 
    }

    public function userlogin()
    {
        $session = session();
        $userModel = new UserModel();
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        $data = $userModel->where('email', $email)->first();
        if($data){
            $pass = $data['password'];
            $authenticatePassword = password_verify($password, $pass);
            if($authenticatePassword){
                $ses_data = [
                    'id' => $data['id'],
                    'username' => $data['username'],
                    'email' => $data['email'],
                    'isLoggedIn' => TRUE
                ];
                $session->set($ses_data);
                $session->setFlashdata('success', 'Login successfully...');
                return redirect()->to('profile');
            
            }else{
                $session->setFlashdata('error', 'Password is incorrect.');
                return redirect()->to('signin');
            }
        }else{
            $session->setFlashdata('error', 'Email does not exist.');
            return redirect()->to('signin');
        }
    }
    public function resetPassword(){
        helper(['form']);
        $session = session();
        $userModel = new UserModel();
        $id = $this->request->getVar('id');
        $oldpassword = $this->request->getVar('oldpassword');
        $newpassword = $this->request->getVar('newpassword');
        $conformpassword = $this->request->getVar('conformpassword');
        $data = $userModel->where('id', $id)->first();

        $rules = [
            'oldpassword'  => 'required|min_length[2]|max_length[50]',
            'newpassword'  => 'required|min_length[2]|max_length[50]',
            'conformpassword'  => 'matches[newpassword]'
        ];

        if($this->validate($rules)){
            if($data){
                $pass = $data['password'];
                $authenticatePassword = password_verify($oldpassword, $pass);
                if($authenticatePassword){
                    $ses_data = [
                        'password' =>  password_hash($newpassword, PASSWORD_DEFAULT),
                    ];
                    $result = $userModel->update($id, $ses_data);
                    $session->setFlashdata('success', 'Reset password successfully...');
                    return redirect()->to('profile');
                
                }else{
                    $session->setFlashdata('error', 'Password is incorrect.');
                    return redirect()->to('profile');
                }
            }else{
                $session->setFlashdata('error', 'User does not exist.');
                return redirect()->to('profile');
            }
        }else{
            $session->setFlashdata('error', 'Please enter valid input.');
            return redirect()->to('profile');
        }

        
    }
    public function getProfile(){
        $session = session();
        $userModel = new UserModel();
        $id = $session->get('id');
        $data = $userModel->where('id', $id)->first();
        echo view('profile', $data);
    }
    public function logout()
    {
        $session = session();
        $array_items = ['id','username', 'email','isLoggedIn'];
        $session->remove($array_items);
         return redirect()->to('signin');
    }
}
