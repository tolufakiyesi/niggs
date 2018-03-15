<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
    public function __construct(){
        parent::__construct();
        //$this->load->library(array('session','form_validation'));
        $this->load->model(array('user_model','api_model'));
        $this->load->helper(array('json_output_helper', 'date', 'string'));
    }

    public function login(){
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method != 'POST'){
            return json_output(400, array('status'=>400, 'message'=>'Bad Request'));
        }else{
            if ( isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true ){
                return json_output(200, array(
                    'status' => 200,
                    'message' => 'Login Successful',
                    'cookie_id' => $_SESSION['cookie_id'],
                    'expires' => mdate('%h:%i%a %d/%m/%Y', $_SESSION['expires'])
                ));
            }

            if ($this->api_model->validate_auth() == true){
                //Token and ApiKey Correct

                $json = file_get_contents('php://input');
                $obj = json_decode($json);

                //$params = $_REQUEST;

                    $username = @$obj->username;
                    $password = @$obj->password;
                //    var_dump($password);
                if ( !isset($username) || !isset($password)){
                    return json_output(401, array('status' => 401, 'message' => 'Incorrect Parameters'));
                }

                if ($this->api_model->resolve_login($username, $password)){

                    $user = $this->user_model->get_user_by_username($username);
                    $api_details = array(
                        'cookie_id' => random_string('alnum', 10),
                        'expires'   => now('+1:20'),
                    );
                    if ( !$this->user_model->super_update($user->id, $api_details) ){
                        return json_output(401, array('status' => 401, 'message' => 'Unable to access server'));
                    }

                    $_SESSION['user_id']      = (int)$user->id;
                    $_SESSION['username']     = (string)$user->username;
                    $_SESSION['logged_in']    = (bool)true;
                    $_SESSION['priviledge']    = (int)$user->priviledge;
                    $_SESSION['cookie_id']     = $api_details['cookie_id'];

                    $datestring = '%h:%i%a %d/%m/%Y';

                    return json_output(200, array(
                        'status' => 200,
                        'message' => 'Login Successful',
                        'cookie_id' => $_SESSION['cookie_id'],
                        'expires' => mdate($datestring, $api_details['expires'])
                    ));
                }else{
                    return json_output(203, array('status' => 203, 'message' => 'Login Failed, Incorrect Credentials'));
                }

                //return $this->api_model->resolve_login($username, $password);
                //return "Okay";

            }else{
                return json_output(401, array('status' => 401, 'message' => 'Access Denied, Authorization Failed'));
            }
        }
    }

    public function logout(){
        foreach ($_SESSION as $key => $value) {
            unset($_SESSION[$key]);
        }
        return json_output(200, array('status' => 200, 'message' => 'Successfully Logged out'));
    }

    public function test(){
//        $datestring = '%h:%i%a %d/%m/%Y';
//        $time = now('+1:01');
//        echo mdate($datestring, $time). " <br>";
//        return mdate($datestring, now()). " <br>";
//        //

            if ($this->api_model->validate_auth() == true){
                //return json_output(200, array('status'=>200, 'message'=>'Successful'));
                if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
                    $user = $this->user_model->get_user($_SESSION['user_id']);
                    return json_output(200, array('status'=>200, 'message'=>'Successful','username'=>$user->username));
                }else{
                    return json_output(400, array('status'=>400, 'message'=>'Not Logged in'));
                }
            }else{
                return json_output(400, array('status'=>400, 'message'=>'Failed'));
            }
        //}
    }


}