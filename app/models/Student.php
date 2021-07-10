<?php

class Student {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function register($data) {
        $this->db->query('INSERT INTO students (full_name, password, student_id) VALUES (:full_name, :password, :student_id)');

        // bind values
        $this->db->bind(':full_name', $data['fullname']);
        $this->db->bind(':password', $data['password']);
        $this->db->bind(':student_id', $data['id']);

        // execute function
        if ($this->db->execute()) {
            return true;
        } else {
            false;
        }
    }

    public function login($id, $password) {
        $this->db->query('SELECT * FROM students WHERE student_id = :student_id');

        // bind value
        $this->db->bind(':student_id', $id);

        $row = $this->db->single();

        $hashedPassword = $row->password;

        if (password_verify($password, $hashedPassword)) {
            return $row;
        } else {
            return false;
        }
    }

    /*public function getSt() {
        $this->db->query("SELECT * FROM users");

        $result = $this->db->resultSet();
        
        return $result;
    }*/

    // find student by id
    public function findStudentById($id) {
        // prepared statement
        $this->db->query('SELECT * FROM students WHERE student_id = :id');

        // id param will be binded with the id variable
        $this->db->bind(':id', $id);

        // check if email already exists
        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getRooms() {
        $data = [
            'type2' => '',
            'type3' => '',
            'type4' => '',
            'type5' => '',
            'type6' => ''
        ];

        $this->db->query('SELECT * FROM rooms WHERE room_type = :number AND capacity > 0');

        $this->db->bind(':number', 2);

        $result = $this->db->resultSet();

        if (sizeof($result) > 0) {
            $data['type2'] = true;
        } else {
            $data['type2'] = false;
        }

        $this->db->bind(':number', 3);

        $result = $this->db->resultSet();

        if (sizeof($result) > 0) {
            $data['type3'] = true;
        } else {
            $data['type3'] = false;
        }

        $this->db->bind(':number', 4);

        $result = $this->db->resultSet();

        if (sizeof($result) > 0) {
            $data['type4'] = true;
        } else {
            $data['type4'] = false;
        }

        $this->db->bind(':number', 5);

        $result = $this->db->resultSet();

        if (sizeof($result) > 0) {
            $data['type5'] = true;
        } else {
            $data['type5'] = false;
        }

        $this->db->bind(':number', 6);

        $result = $this->db->resultSet();

        if (sizeof($result) > 0) {
            $data['type6'] = true;
        } else {
            $data['type6'] = false;
        }

        return $data;
    }

    public function apply($data) {
        $this->db->query(
            "INSERT INTO applications (student_id, student_name, room_type, age, contact_no, 
            contact_email, guardian_no, guardian_email, date_of_birth, level, guardian_name, 
            department) 
            VALUES (:id, :name, :type, :age, :phone, :email, :g_phone, :g_email, :dob, :level, :g_name, :department)"
        );

        $this->db->bind(':id', $data['student_id']);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':type', $data['type']);
        $this->db->bind(':age', $data['age']);
        $this->db->bind(':phone', $data['phone']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':g_phone', $data['guardian_phone']);
        $this->db->bind(':g_email', $data['guardian_email']);
        $this->db->bind(':dob', $data['dob']);
        $this->db->bind(':level', $data['level']);
        $this->db->bind(':g_name', $data['guardian_name']);
        $this->db->bind(':department', $data['department']);

        if ($this->db->execute()) {
            return true;
        } else {
            false;
        }
    }

    public function findApplicationById($id) {
        // prepared statement
        $this->db->query('SELECT * FROM applications WHERE student_id = :id');

        // id param will be binded with the id variable
        $this->db->bind(':id', $id);

        $result = $this->db->resultSet();

        // check if email already exists
        if (sizeof($result) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function roomAllocated($id) {
        $this->db->query('SELECT * FROM students WHERE  student_id = :id');

        $this->db->bind(':id', $id);

        $result = $this->db->single();

        if ($result->room_allocated != 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getRoom($number) {
        $this->db->query('SELECT * FROM rooms WHERE room_number = :number');

        $this->db->bind(':number', $number);

        $result = $this->db->single();

        return $result;
    }

    public function payFees($id) {
        $this->db->query('UPDATE students SET fees_paid = 1 WHERE student_id = :id');

        $this->db->bind(':id', $id);

        if (!$this->db->execute()) {
            return false;
        }

        $this->db->query('SELECT * FROM students WHERE student_id = :id');

        $this->db->bind(':id', $id);

        $student = $this->db->single();

        $room_no = $student->room_number;

        $capacity = $this->getRoom($room_no)->capacity - 1;

        $this->db->query('UPDATE rooms SET capacity = :capacity WHERE room_number = :number');

        $this->db->bind(':capacity', $capacity);
        $this->db->bind(':number', $room_no);
        
        if (!$this->db->execute()) {
            return false;
        }

        return true;
    }

    public function feesPaid($id) {
        $this->db->query('SELECT * FROM students WHERE student_id = :id');

        $this->db->bind(':id', $id);

        $student = $this->db->single();

        if ($student->fees_paid == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function joinWaitingList($id, $type) {
        $this->db->query('SELECT * FROM students WHERE student_id = :id');

        $this->db->bind(':id', $id);

        $student = $this->db->single();

        if ($student->form_filled) {
            die('You have already applied for a room' . "<a href='" . URLROOT . "/students/index'>Go to home</a>");
        } else {
            $this->db->query('UPDATE students SET on_waiting_list = 1, room_type = :type WHERE student_id = :id');

            $this->db->bind(':id', $id);
            $this->db->bind(':type', $type);

            if (!$this->db->execute()) {
                return false;
            }
        }

        return true;
    }

    public function onWaitingList($id) {
        $this->db->query('SELECT * FROM students WHERE student_id = :id');

        $this->db->bind(':id', $id);

        $student = $this->db->single();

        if ($student->on_waiting_list == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function complain($data) {
        $this->db->query('INSERT INTO complaints (content) VALUES (:content)');

        $this->db->bind(':content', $data['complaint']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function bookCounselor($data) {
        $this->db->query('INSERT INTO counselorappointments (appointment_date, appointment_time, student_id) VALUES (:date, :time, :student_id)');

        $this->db->bind(':date', $data['date']);
        $this->db->bind(':time', $data['time']);
        $this->db->bind(':student_id', $data['id']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getInformation() {
        $this->db->query('SELECT * FROM information ORDER BY -post_date');

        $result = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $result;
        } else {
            return [];
        }
    }

    public function getInformationSingle($id) {
        $this->db->query('SELECT * FROM information WHERE id = :id');

        $this->db->bind(':id', $id);

        $result = $this->db->single();

        if ($this->db->rowCount() > 0) {
            return $result;
        } else {
            return [];
        }
    }
}

?>