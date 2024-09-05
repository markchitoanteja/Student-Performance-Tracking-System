<?php

namespace App\Controllers;

use App\Models\User_Model;
use App\Models\Student_Model;

date_default_timezone_set('Asia/Manila');

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

    public function manage_students()
    {
        if (session()->get("user_id")) {
            session()->set("current_page", "manage_students");
            session()->set("title", "Manage Students");

            $User_Model = new User_Model();
            $Student_Model = new Student_Model();

            $data["user_data"] = $User_Model->where('id', session()->get("user_id"))->first();
            $data["students"] = $Student_Model->orderBy('id', 'DESC')->findAll();

            $header = view("templates/header", $data);
            $body = view("main/manage_students_view");
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

    public function student_profile()
    {
        $student_number = $this->request->getGet("student_number");

        if ($student_number) {
            if (session()->get("user_id")) {
                session()->set("current_page", "manage_students");

                $User_Model = new User_Model();
                $Student_Model = new Student_Model();

                $data["user_data"] = $User_Model->where('id', session()->get("user_id"))->first();
                $data["student_data"] = $Student_Model->where('student_number', $student_number)->first();

                $middle_initial = isset($data["student_data"]["middle_name"]) && !empty($data["student_data"]["middle_name"]) ? strtoupper($data["student_data"]["middle_name"][0]) . '. ' : '';
                $full_name = $data["student_data"]["first_name"] . " " . $middle_initial . $data["student_data"]["last_name"];

                session()->set("title", $full_name);

                $header = view("templates/header", $data);
                $body = view("main/student_profile_view");
                $footer = view("templates/footer");

                return $header . $body . $footer;
            } else {
                session()->set("notification", array(
                    "type" => "alert-danger",
                    "message" => "You must login first!",
                ));

                return redirect()->to(base_url());
            }
        } else {
            return redirect()->to(base_url() . "manage_students");
        }
    }

    public function change_mode()
    {
        $mode = $this->request->getPost("mode");

        session()->set("mode", $mode);

        echo json_encode(true);
    }

    public function save_student()
    {
        $student_number = $this->request->getPost("student_number");
        $course = $this->request->getPost("course");
        $year = $this->request->getPost("year");
        $section = $this->request->getPost("section");
        $first_name = $this->request->getPost("first_name");
        $middle_name = $this->request->getPost("middle_name");
        $last_name = $this->request->getPost("last_name");
        $birthday = $this->request->getPost("birthday");
        $mobile_number = $this->request->getPost("mobile_number");
        $email = $this->request->getPost("email");
        $address = $this->request->getPost("address");
        $image = $this->request->getFile("image_file");

        $Student_Model = new Student_Model();

        $student_data = $Student_Model->where('student_number', $student_number)->first();

        $response = false;

        if (!$student_data) {
            $image = $this->upload_image("public/dist/img/uploads/students/", $image);

            $data = [
                "student_number" => $student_number,
                "course" => $course,
                "year" => $year,
                "section" => $section,
                "first_name" => $first_name,
                "middle_name" => $middle_name,
                "last_name" => $last_name,
                "birthday" => $birthday,
                "mobile_number" => $mobile_number,
                "email" => $email,
                "address" => $address,
                "image" => $image,
                "created_at" => date("Y-m-d H:i:s"),
                "updated_at" => date("Y-m-d H:i:s"),
            ];

            $Student_Model->save($data);

            session()->set("notification", array(
                "title" => "Success!",
                "text" => "A student has been successfully added to the list.",
                "icon" => "success",
            ));

            $response = true;
        }

        echo json_encode($response);
    }

    public function delete_student()
    {
        $student_id = $this->request->getPost("student_id");

        $Student_Model = new Student_Model();

        $Student_Model->delete($student_id);

        session()->set("notification", array(
            "title" => "Success!",
            "text" => "A student has been successfully deleted from the list.",
            "icon" => "success",
        ));

        echo json_encode(true);
    }

    public function get_student_data()
    {
        $student_id = $this->request->getPost("student_id");

        $Student_Model = new Student_Model();

        $student_data = $Student_Model->where('id', $student_id)->first();

        echo json_encode($student_data);
    }

    public function update_student()
    {
        $student_number = $this->request->getPost("student_number");
        $course = $this->request->getPost("course");
        $year = $this->request->getPost("year");
        $section = $this->request->getPost("section");
        $first_name = $this->request->getPost("first_name");
        $middle_name = $this->request->getPost("middle_name");
        $last_name = $this->request->getPost("last_name");
        $birthday = $this->request->getPost("birthday");
        $mobile_number = $this->request->getPost("mobile_number");
        $email = $this->request->getPost("email");
        $address = $this->request->getPost("address");
        $image = $this->request->getFile("image_file");

        $id = $this->request->getPost("id");
        $is_new_student_number = $this->request->getPost("is_new_student_number");
        $is_new_image = $this->request->getPost("is_new_image");
        $old_image = $this->request->getPost("old_image");

        $errors = 0;

        $Student_Model = new Student_Model();

        if ($is_new_student_number == "true") {
            $student_data = $Student_Model->where('student_number', $student_number)->first();

            if ($student_data) {
                $errors++;
            }
        }

        $response = false;

        if (!$errors) {
            if ($is_new_image == "true") {
                $image = $this->upload_image("public/dist/img/uploads/students/", $image);
            } else {
                $image = $old_image;
            }

            $data = [
                "student_number" => $student_number,
                "course" => $course,
                "year" => $year,
                "section" => $section,
                "first_name" => $first_name,
                "middle_name" => $middle_name,
                "last_name" => $last_name,
                "birthday" => $birthday,
                "mobile_number" => $mobile_number,
                "email" => $email,
                "address" => $address,
                "image" => $image,
                "updated_at" => date("Y-m-d H:i:s"),
            ];

            $Student_Model->update($id, $data);

            session()->set("notification", array(
                "title" => "Success!",
                "text" => "A student has been successfully updated.",
                "icon" => "success",
            ));

            $response = true;
        }

        echo json_encode($response);
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
