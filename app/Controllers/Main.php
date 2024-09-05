<?php

namespace App\Controllers;

use App\Models\User_Model;

class Main extends BaseController
{
    public function index()
    {
        if (session()->get("user_id")) {
            session()->set("current_page", "dashboard");
            session()->set("title", "Dashboard");

            $User_Model = new User_Model();

            $data["user_data"] = $User_Model->where('id', session()->get("user_id"))->first();

            $header = view("templates/header", $data);
            $body = view("main/dashboard_view");
            $footer = view("templates/footer");

            return $header . $body . $footer;
        } else {
            session()->set("notification", array(
                "type" => "alert-danger",
                "message" => "You must login first!",
            ));

            return redirect()->to(base_url());
        }
    }

    public function change_mode()
    {
        $mode = $this->request->getPost("mode");

        session()->set("mode", $mode);

        echo json_encode(true);
    }
}
