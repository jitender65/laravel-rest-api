<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;

/**
 * UserController
 *
 * This controller is used to perform all the operation related to user. e.g register,login,logout etc.
 *
 * @author Jitender <jitender65@gmail.com>
 */
class UserController extends Controller {

    
    public function __construct() {
        
    }

    public function index() {
        return $this->respondServerError('Internal Server Error.Please try again.');
    }
    
    public function store() {
        echo "store";
    }
    
    
    public function show() {
        echo "show";
    }
    
    public function update() {
        echo "update";
    }
    
    public function destroy() {
        echo "destroy";
    }
    
    public function register() {
        echo "register";
    }
    
    public function login() {
        echo "login";
    }
    
    public function logout() {
        echo "logout";
    }
    
}
