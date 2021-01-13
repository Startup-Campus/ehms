<?php

class Students extends Controller {
    public function __construct() {
        $this->userModel = $this->model('Student');
    }

    public function index() {
        $data = [];

        $this->view('students/index', $data);
    }

    public function register() {
        $data = [
            'fullname' => '',
            'id' => '',
            'password' => '',
            'confirmPassword' => '',
            'fullnameError' => '',
            'idError' => '',
            'passwordError' => '',
            'confirmPasswordError' => ''
        ];

      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Process form
        // Sanitize POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

              $data = [
                'fullname' => trim($_POST['fullname']),
                'id' => $_POST['id'],
                'password' => trim($_POST['password']),
                'confirmPassword' => trim($_POST['confirmPassword']),
                'fullnameError' => '',
                'idError' => '',
                'passwordError' => '',
                'confirmPasswordError' => ''
            ];

            $nameValidation = "/^(\w+\s?)*\s*$/";
            $passwordValidation = "/^(.{0,7}|[^a-z]*|[^\d]*)$/i";

            //Validate username on letters/numbers
            if (empty($data['fullname'])) {
                $data['fullnameError'] = 'Please enter full name.';
            } elseif (!preg_match($nameValidation, $data['fullname'])) {
                $data['fullnameError'] = 'Name can only contain letters and whitespaces.';
            }

            // Validate id
            if (empty($data['id'])) {
                $data['idError'] = 'Please enter ID';
            } else {
                //Check if id exists.
                if ($this->userModel->findStudentById($data['id'])) {
                $data['idError'] = 'An account with this Student ID already exists';
                }
            }

           // Validate password on length, numeric values,
            if(empty($data['password'])){
              $data['passwordError'] = 'Please enter password.';
            } elseif(strlen($data['password']) < 8){
              $data['passwordError'] = 'Password must be at least 8 characters';
            } elseif (preg_match($passwordValidation, $data['password'])) {
              $data['passwordError'] = 'Password must be have at least one numeric value.';
            }

            //Validate confirm password
             if (empty($data['confirmPassword'])) {
                $data['confirmPasswordError'] = 'Please enter password.';
            } else {
                if ($data['password'] != $data['confirmPassword']) {
                $data['confirmPasswordError'] = 'Passwords do not match, please try again.';
                }
            }

            // Make sure that errors are empty
            if (empty($data['fullnameError']) && empty($data['idError']) && empty($data['passwordError']) && empty($data['confirmPasswordError'])) {

                // Hash password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                //Register user from model function
                if ($this->userModel->register($data)) {
                    //Redirect to the login page
                    header('location: ' . URLROOT . '/users/login');
                } else {
                    die('Something went wrong.');
                }
            }
        }
        $this->view('students/register', $data);
    }

    public function login() {
        $data = [
            'idError' => '',
            'passwordError' => ''
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'id' => $_POST['id'],
                'password' => trim($_POST['password']),
                'idError' => '',
                'passwordError' => ''
            ];

            // validate id
            if (empty($data['id'])) {
                $data['idError'] = 'Please enter Student ID';
            }

            // validate password
            if (empty($data['password'])) {
                $data['passwordError'] = 'Please enter a password';
            }

            // check if errors are empty
            if (empty($data['idError']) && empty($data['idError'])) {
                $loggedInUser = $this->userModel->login($data['id'], $data['password']);
            }

            if ($loggedInUser) {
                $this->createStudentSession($loggedInUser);
            } else {
                $data['passwordError'] = 'Password or username is incorrect. Please try again.';

                $this->view('students/login', $data);
            }
        } else {
            $data = [
                'idError' => '',
                'passwordError' => ''
            ];
        }

        $this->view('students/login', $data);
    }

    public function createStudentSession($student) {
        $_SESSION['student_id'] = $student->student_id;
        $_SESSION['student_name'] = $student->full_name;
        $_SESSION['room_allocated'] = $this->userModel->roomAllocated($student->student_id) ? true : false;
    }

    public function support() {
        $this->view('students/support');
    }

    public function viewrooms() {
        $data = $this->userModel->getRooms();

        $this->view('students/viewrooms', $data);
    }

    public function apply() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $_SESSION['type'] = $_GET['type'];
        }

        $data = [
            'name' => '',
            'student_id' => $_SESSION['student_id'],
            'type' => $_SESSION['type'],
            'email' => '',
            'department' => '',
            'level' => '',
            'phone' => '',
            'dob' => '',
            'age' => '',
            'guardian_name' => '',
            'guardian_email' => '',
            'guardian_phone' => '',
            'nameError' => '',
            'emailError' => '',
            'departmentError' => '',
            'levelError' => '',
            'phoneError' => '',
            'dobError' => '',
            'ageError' => '',
            'guardianNameError' => '',
            'guardianEmailError' => '',
            'guardianPhoneError' => '',
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // process form
            // sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'name' => $_POST['name'],
                'student_id' => $_SESSION['student_id'],
                'type' => $_SESSION['type'],
                'email' => trim($_POST['email']),
                'department' => trim($_POST['department']),
                'level' => $_POST['level'],
                'phone' => $_POST['phone'],
                'dob' => $_POST['dob'],
                'age' => $_POST['age'],
                'guardian_name' => trim($_POST['guardian_name']),
                'guardian_email' => trim($_POST['guardian_email']),
                'guardian_phone' => $_POST['guardian_phone'],
                'nameError' => '',
                'emailError' => '',
                'departmentError' => '',
                'levelError' => '',
                'phoneError' => '',
                'dobError' => '',
                'ageError' => '',
                'guardianNameError' => '',
                'guardianEmailError' => '',
                'guardianPhoneError' => '',
            ];

            $textValidation = "/^(\w+\s?)*\s*$/";

            if ($this->userModel->findApplicationById($_SESSION['student_id'])) {
                die("You can only submit one application at a time " . "<a href='" . URLROOT . "/students/index'>Go to home</a>");
            }

            if (empty($data['email'])) {
                $data['emailError'] = 'Please enter email address.';
            } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $data['emailError'] = 'Please enter the correct format';
            }

            if (empty($data['department'])) {
                $data['departmentError'] = 'Please enter your department';
            }

            if (empty($data['level'])) {
                $data['levelError'] = 'Please enter your level';
            }

            if (empty($data['phone'])) {
                $data['phoneError'] = 'Please enter your phone number';
            }

            if (empty($data['dob'])) {
                $data['dobError'] = 'Please enter your date of birth';
            }

            if (empty($data['age'])) {
                $data['ageError'] = 'Please enter your age';
            }

            if (empty($data['guardian_name'])) {
                $data['guardianNameError'] = 'Please enter the name of your guardian';
            }

            if (empty($data['guardian_email'])) {
                $data['guardianEmailError'] = "Please enter your guardian's email";
            }

            if (empty($data['guardian_phone'])) {
                $data['guardianPhoneError'] = "Please enter your guardian's phone number";
            }

            if (empty($data['nameError']) && empty($data['emailError']) && empty($data['departmentError']) && empty($data['levelError']) 
                && empty($data['phoneError']) && empty($data['dobError']) && empty($data['ageError']) && empty($data['guardianNameError'])
                && empty($data['guardianEmailError']) && empty($data['guardianPhoneError'])) {
                    if ($this->userModel->apply($data)) {
                        die("Application successful. " . "<a href='" . URLROOT . "/students/index'>Go to home</a>");
                    } else {
                        die("Something went wrong " . "<a href='" . URLROOT . "/students/index'>Go to home</a>");
                    }
                }
        }
        
        $this->view('students/apply', $data);
    }

    public function wait() {
        $type = $_GET['type'];
        $id = $_SESSION['student_id'];
        $data = [
            'message' => ''
        ];

        if ($this->userModel->onWaitingList($id)) {
            $data = [
                'message' => 'You are already on the waiting list.' . "<a href='" . URLROOT . "/students/index'>Go to home</a>"
            ];   
        } else {
            if ($this->userModel->joinWaitingList($id, $type)) {
                $data = [
                    'message' => 'You have joined the waiting list for this room type. 
                    An email will be sent to your schoole email when there is a vacany' 
                    . "<a href='" . URLROOT . "/students/index'>Go to home</a>"
                ];
            } else {
                die("Something went wrong " . "<a href='" . URLROOT . "/students/index'>Go to home</a>");
            }
        }
    }

    public function payfees() {
        $data = [
            'message' => '',
        ];

        if ($this->userModel->feesPaid($_SESSION['student_id'])) {
            $data = [
                'message' => 'Fees have already been paid.' . "<a href='" . URLROOT . "/students/index'>Go to home</a>"
            ];
        } else {
            if ($this->userModel->payFees($_SESSION['student_id'])) {
                $data = [
                    'message' => 'Payment successful' . "<a href='" . URLROOT . "/students/index'>Go to home</a>"
                ];
            } else {
                die("Something went wrong " . "<a href='" . URLROOT . "/students/index'>Go to home</a>");
            }
        }

        $this->view('students/payfees', $data);
    }

    public function complain() {
        $data = [
            'complaint' => '',
            'complaintError' => ''
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'complaint' => $_POST['complaint'],
                'complaintError' => ''
            ];

            if (empty($data['complaint'])) {
                $data['complaintError'] = 'Please write something.';
            }

            if (empty($data['complaintError'])) {
                if ($this->userModel->complain($data)) {
                    die("Your complaint has been recieved. " . "<a href='" . URLROOT . "/students/index'>Go to home</a>");
                } else {
                    die("Something went wrong " . "<a href='" . URLROOT . "/students/index'>Go to home</a>");
                }
            }
        }

        $this->view('students/complain', $data);
    }

    public function bookcounselor() {
        $data = [
            'date' => '',
            'time' => '',
            'id' => $_SESSION['student_id'],
            'dateError' => '',
            'timeError' => ''
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'date' => $_POST['date'],
                'time' => $_POST['time'],
                'id' => $_SESSION['student_id'],
                'dateError' => '',
                'timeError' => ''
            ];

            if (empty($data['date'])) {
                $data['dateError'] = 'Date cannot be empty.';
            }

            if (empty($data['time'])) {
                $data['timeError'] = 'Date cannot be empty.';
            }

            if (empty($data['dateError']) && empty($data['timeError'])) {
                if ($this->userModel->bookCounselor($data)) {
                    die("Your appointment has been booked. " . "<a href='" . URLROOT . "/students/index'>Go to home</a>");
                } else {
                    die("Something went wrong. " . "<a href='" . URLROOT . "/students/index'>Go to home</a>");
                }
            }
        }

        $this->view('students/bookcounselor', $data);
    }

    public function informationcentre() {
        $data = $this->userModel->getInformation();

        $this->view('students/informationcentre', $data);
    }

    public function viewinformation() {
        $data = $this->userModel->getInformationSingle($_GET['id']);
        $this->view('students/viewinformation', $data);
    }

    public function logout() {
        unset($_SESSION['student_id']);
        unset($_SESSION['student_name']);
        header('location:' . URLROOT . '/students/login');
    }
}

?>