<?php

namespace App\Controllers;

use App\Models\User_Model;
use App\Models\Log_Model;
use Exception;

date_default_timezone_set('Asia/Manila');

class Auth extends BaseController
{
    public function index()
    {
        if (!session()->get("user_id")) {
            return view('auth/login_view');
        } else {
            return redirect()->to(base_url() . "dashboard");
        }
    }

    public function get_user_details()
    {
        $username = $this->request->getPost("username");
        $password = $this->request->getPost("password");
        $remember_me = $this->request->getPost("remember_me");

        $User_Model = new User_Model();

        $user_data = $User_Model->where('username', $username)->first();

        $response = false;

        if ($user_data) {
            $hash = $user_data["password"];

            if (password_verify($password, $hash)) {
                if ($remember_me == "true") {
                    session()->set("username", $username);
                    session()->set("password", $password);
                } else {
                    session()->remove("username");
                    session()->remove("password");
                }

                session()->set("user_id", $user_data["id"]);

                $this->add_log_data(session()->get("user_id"), "Logged in to the system.");

                $response = true;
            }
        }

        echo json_encode($response);
    }

    public function get_admin_data()
    {
        $user_id = $this->request->getPost("user_id");

        $User_Model = new User_Model();

        $user_data = $User_Model->where('id', $user_id)->first();

        echo json_encode($user_data);
    }

    public function check_admin()
    {
        $username = $this->request->getPost("username");
        $password = $this->request->getPost("password");

        $response = false;

        $User_Model = new User_Model();

        $user_data = $User_Model->where('username', $username)->first();

        if ($user_data) {
            $hash = $user_data["password"];

            if (password_verify($password, $hash)) {
                $response = true;
            }
        }

        echo json_encode($response);
    }

    public function check_username()
    {
        $username = $this->request->getPost("username");

        $response = false;

        $User_Model = new User_Model();

        $user_data = $User_Model->where('username', $username)->first();

        if (!$user_data) {
            $response = true;
        }

        echo json_encode($response);
    }

    public function new_admin()
    {
        $name = $this->request->getPost("name");
        $username = $this->request->getPost("username");
        $password = $this->request->getPost("password");
        $image_file = $this->request->getFile("image_file");

        $User_Model = new User_Model();

        $image = $this->upload_image("public/dist/img/uploads/admin/", $image_file);

        $data = [
            "name" => $name,
            "username" => $username,
            "password" => password_hash($password, PASSWORD_BCRYPT),
            "image" => $image,
            "created_at" => date("Y-m-d H:i:s"),
            "updated_at" => date("Y-m-d H:i:s"),
        ];

        $User_Model->save($data);

        session()->set("notification", array(
            "type" => "alert-success",
            "message" => "Account has been successfully saved",
        ));

        $this->add_log_data($User_Model->getInsertID(), "Registered a new admin.");

        echo json_encode(true);
    }

    public function update_admin()
    {
        $id = $this->request->getPost("id");
        $name = $this->request->getPost("name");
        $username = $this->request->getPost("username");
        $password = $this->request->getPost("password");
        $is_new_password = $this->request->getPost("is_new_password");
        $image = $this->request->getPost("image");
        $is_new_image = $this->request->getPost("is_new_image");
        $image_file = $this->request->getFile("image_file");

        $response = false;

        $User_Model = new User_Model();

        $user_data = $User_Model->where('username', $username)->where('id !=', $id)->first();

        if (!$user_data) {
            if ($is_new_image == "true") {
                $image = $this->upload_image("public/dist/img/uploads/admin/", $image_file);
            }

            if ($is_new_password == "true") {
                $password = password_hash($password, PASSWORD_BCRYPT);
            }

            $data = [
                "name" => $name,
                "username" => $username,
                "password" => $password,
                "image" => $image,
                "updated_at" => date("Y-m-d H:i:s"),
            ];

            $User_Model->update($id, $data);

            session()->set("notification", array(
                "title" => "Success!",
                "text" => "Account has been successfully updated.",
                "icon" => "success",
            ));

            $this->add_log_data(session()->get("user_id"), "Updated account information.");

            $response = true;
        }

        echo json_encode($response);
    }

    public function logout()
    {
        $this->add_log_data(session()->get("user_id"), "Logged out from the system");

        session()->remove("user_id");

        session()->set("notification", array(
            "type" => "alert-success",
            "message" => "You had been logged out",
        ));

        echo json_encode(true);
    }

    private function add_log_data($user_id, $activity)
    {
        $Log_Model = new Log_Model();

        $data = [
            "user_id" => $user_id,
            "activity" => $activity,
            "created_at" => date("Y-m-d H:i:s"),
            "updated_at" => date("Y-m-d H:i:s"),
        ];

        $Log_Model->save($data);
    }

    private function upload_image($target_directory, $image_file)
    {
        $response = false;

        if ($this->request->getFile('image_file')->isValid()) {
            $target_dir = $target_directory;

            $uploadedFile = $image_file;

            if ($uploadedFile->getSize() > 0 && $uploadedFile->isValid() && !$uploadedFile->hasMoved()) {
                $unique_name = uniqid('img_', true) . '.' . $uploadedFile->getExtension();

                if ($uploadedFile->move($target_dir, $unique_name)) {
                    $response = $unique_name;
                }
            }
        }

        return $response;
    }
}
