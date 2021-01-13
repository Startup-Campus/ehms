<?php

class Administration extends Controller {
    public function __construct() {
        $this->adminModel = $this->model('Admin');
    }

    public function index() {
        $data = [
            'title' => 'E-HMS Admin'
        ];
        $this->view('admin/index', $data);
    }

    public function login() {
        $data = [
            'usernameError' => '',
            'passwordError' => ''
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'username' => trim($_POST['username']),
                'password' => trim($_POST['password']),
                'usernameError' => '',
                'passwordError' => ''
            ];

            // validate username
            if (empty($data['username'])) {
                $data['usernameError'] = 'Please enter a username';
            }

            // validate password
            if (empty($data['password'])) {
                $data['passwordError'] = 'Please enter a password';
            }

            // check if errors are empty
            if (empty($data['usernameError']) && empty($data['passwordError'])) {
                $loggedInAdmin = $this->adminModel->login($data['username'], $data['password']);
            }

            if ($loggedInAdmin) {
                $this->createAdminSession($loggedInAdmin);
            } else {
                $data['passwordError'] = 'Password or username is incorrect. Please try again.';

                $this->view('admin/login', $data);
            }
        } else {
            $data = [
                'usernameError' => '',
                'passwordError' => ''
            ];
        }

        $this->view('admin/login', $data);
    }

    public function createAdminSession($admin) {
        $_SESSION['admin_id'] = $admin->id;
        $_SESSION['user_name'] = $admin->user_name;
    }

    public function viewapps() {
        $data = $this->adminModel->getApplications();

        $this->view('admin/viewapps', $data);
    }

    public function viewapp() {
        $id = $_GET['id'];

        $data = $this->adminModel->getApplication($id);

        if (empty($data)) {
            die('Application does not exist.');
        }

        $this->view('admin/viewapp', $data);

    }

    public function verify() {
        $id = $_GET["id"];

        $application = $this->adminModel->getApplication($id);

        if (empty($application)) {
            die('Application does not exist.');
        } else {
            if ($this->adminModel->checkApplicationStatus($id)) {
                $this->adminModel->verifyApplication($id);
            } else {
                die('Application has already been verified.');
            }
        }

        $data = $this->adminModel->getApplications();

        $this->view('admin/viewapps', $data);
    }

    public function viewrecords() {
        $data = [];
        $this->view('admin/viewrecords', $data);
    }

    public function viewrecord() {
        $record_name = $_GET["name"];

        $data = [];

        switch ($record_name) {
            case "students":
                $data = $this->adminModel->getStudents();
                break;
            case "rooms":
                $data = $this->adminModel->getRooms();
                break;
            default:
                $data = $this->adminModel->getInventory();
        }

        $this->view('admin/viewrecord', $data);
    }

    public function deletestudent() {
        if ($this->adminModel->deleteStudent($_GET['id'])) {
            die("Student deleted. " . "<a href='" . URLROOT . "/administration/viewrecord?name=students'>Go back</a>");
        } else {
            die("Something went wrong " . "<a href='" . URLROOT . "/administration/viewrecord?name=students'>Go back</a>");
        }
    }

    public function addroom() {
        $data = [
            'number' => '',
            'capacity' => '',
            'type' => '',
            'price' => '',
            'numberError' => '',
            'capacityError' => '',
            'typeError' => '',
            'priceError' => '',
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'number' => $_POST['number'],
                'capacity' => $_POST['capacity'],
                'type' => $_POST['type'],
                'price' => $_POST['price'],
                'numberError' => '',
                'capacityError' => '',
                'typeError' => '',
                'priceError' => '',
            ];

            if (empty($data['number'])) {
                $data['numberError'] = 'Please fill this field.';
            }

            if (empty($data['capacity'])) {
                $data['capacityError'] = 'Please fill this field.';
            }

            if (empty($data['type'])) {
                $data['typeError'] = 'Please fill this field.';
            }

            if (empty($data['price'])) {
                $data['priceError'] = 'Please fill this field.';
            }

            if (empty($data['numberError']) && empty($data['capacityError']) && empty($data['typeError']) && empty($data['priceError'])) {
                if ($this->adminModel->addRoom($data)) {
                    die("Room Added. " . "<a href='" . URLROOT . "/administration/addroom'>Go back</a>");
                } else {
                    die("Something went wrong. " . "<a href='" . URLROOT . "/admimistration/addroom'>Go back</a>");
                }
            }
        }

        $this->view('admin/addroom', $data);
    }

    public function deleteroom() {
        if ($this->adminModel->deleteRoom($_GET['number'])) {
            die("Room deleted. " . "<a href='" . URLROOT . "/administration/viewrecord?name=rooms'>Go back</a>");
        } else {
            die("Cannot delete room that has students in it. " . "<a href='" . URLROOT . "/administration/viewrecord?name=rooms'>Go back</a>");
        }
    }

    public function additem() {
        $data = [
            'name' => '',
            'quantity' => '',
            'nameError' => '',
            'quantityError' => '',
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'name' => $_POST['name'],
                'quantity' => $_POST['quantity'],
                'nameError' => '',
                'quantityError' => '',
            ];

            if (empty($data['name'])) {
                $data['nameError'] = 'Please fill this field.';
            }

            if (empty($data['quantity'])) {
                $data['quantityError'] = 'Please fill this field.';
            }

            if (empty($data['nameError']) && empty($data['quantityError'])) {
                if ($this->adminModel->addItem($data)) {
                    die("Item Added. " . "<a href='" . URLROOT . "/administration/additem'>Go back</a>");
                } else {
                    die("Something went wrong. " . "<a href='" . URLROOT . "/admimistration/additem'>Go back</a>");
                }
            }
        }

        $this->view('admin/additem', $data);
    }

    public function deleteitem() {
        if ($this->adminModel->deleteItem($_GET['name'])) {
            die("Item deleted. " . "<a href='" . URLROOT . "/administration/viewrecord?name=inventory'>Go back</a>");
        } else {
            die("Something went wrong. " . "<a href='" . URLROOT . "/administration/viewrecord?name=inventory'>Go back</a>");
        }
    }

    public function addinformation() {
        $data = [
            'title' => '',
            'content' => '',
            'titleError' => '',
            'contentError' => '',
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'title' => $_POST['title'],
                'content' => $_POST['content'],
                'titleError' => '',
                'contentError' => '',
            ];

            if (empty($data['title'])) {
                $data['titleError'] = 'Please fill this field.';
            }

            if (empty($data['content'])) {
                $data['contentError'] = 'Please fill this field.';
            }

            if (empty($data['titleError']) && empty($data['contentError'])) {
                if ($this->adminModel->addInformation($data)) {
                    die("Info Added. " . "<a href='" . URLROOT . "/administration/addinformation'>Go back</a>");
                } else {
                    die("Something went wrong. " . "<a href='" . URLROOT . "/admimistration/addinformation'>Go back</a>");
                }
            }
        }

        $this->view('admin/addinformation', $data);
    }

    public function deleteinformation() {
        if ($this->adminModel->deleteInformation($_GET['id'])) {
            die("Info deleted. " . "<a href='" . URLROOT . "/administration/informationcentre'>Go back</a>");
        } else {
            die("Something went wrong. " . "<a href='" . URLROOT . "/administration/informationcentre'>Go back</a>");
        }
    }

    public function informationcentre() {
        $data = $this->adminModel->getInformation();

        $this->view('admin/informationcentre', $data);
    }

    public function logout() {
        unset($_SESSION['admin_id']);
        unset($_SESSION['user_name']);
        header('location:' . URLROOT . '/administration/login');
    }
}

?>