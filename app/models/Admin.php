<?php

class Admin {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function login($username, $password) {
        $this->db->query('SELECT * FROM administrators WHERE user_name = :username');

        // bind value
        $this->db->bind(':username', $username);

        $admin = $this->db->single();

        if ($this->db->rowCount() == 0) {
            return false;
        }

        $hashedPassword = $admin->password;

        if (password_verify($password, $hashedPassword)) {
            return $admin;
        } else {
            return false;
        }
    }

    public function getApplications() {
        $this->db->query('SELECT * FROM applications');

        $result = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $result;
        } else {
            return [];
        }
    }

    public function getApplication($id) {
        $this->db->query('SELECT * FROM applications WHERE student_id = :id');

        $this->db->bind(':id', $id);

        $result = $this->db->single();

        if ($this->db->rowCount() > 0) {
            return $result;
        } else {
            return [];
        }
    }

    public function verifyApplication($id) {
        $this->db->query('UPDATE applications SET status = 1 WHERE student_id = :id');

        $this->db->bind(':id', $id);

        $this->db->execute();

        $student = $this->getStudent($id);

        $room_type = $student->room_type;

        $available_rooms = $this->getAvailableRoomType($room_type);

        $room_no = $available_rooms[array_rand($available_rooms)]->room_number;

        $this->db->query('UPDATE students SET application_verified = 1, room_allocated = 1, room_number=:number WHERE student_id = :id');

        $this->db->bind(':number', $room_no);
        $this->db->bind(':id', $id);

        $this->db->execute();

    }

    public function checkApplicationStatus($id) {
        $this->db->query('SELECT * FROM applications WHERE student_id = :id');

        $this->db->bind(':id', $id);

        $application = $this->db->single();

        if ($application->status != 1) {
            return true;
        } else {
            return false;
        }
    }

    public function getStudents() {
        $this->db->query('SELECT * FROM students ORDER BY room_number');

        $result = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $result;
        } else {
            return [];
        }
    }

    public function getStudent($id) {
        $this->db->query('SELECT * FROM students WHERE student_id = :id');

        $this->db->bind(':id', $id);

        $result = $this->db->single();

        return $result;
    }

    public function getRooms() {
        $this->db->query('SELECT * FROM rooms ORDER BY room_number');

        $result = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $result;
        } else {
            return [];
        }
    }

    public function getRoom($number) {
        $this->db->query('SELECT * FROM rooms WHERE room_number = :number');

        $this->db->bind(':number', $number);

        $result = $this->db->single();

        return $result;
    }

    public function getAvailableRoomType($type) {
        $this->db->query('SELECT * FROM rooms WHERE room_type = :type');

        $this->db->bind(':type', $type);

        $result = $this->db->resultSet();

        if (sizeof($result) > 0) {
            return $result;
        } else {
            return [];
        }
    }

    public function getInventory() {
        $this->db->query('SELECT * FROM inventory');

        $result = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $result;
        } else {
            return [];
        }
    }

    public function getInformation() {
        $this->db->query('SELECT * FROM information');

        $result = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $result;
        } else {
            return [];
        }
    }

    public function deleteStudent($id) {
        $this->db->query('SELECT * FROM students WHERE student_id = :id');

        $this->db->bind(':id', $id);

        $student = $this->db->single();

        if (!is_null($student->room_number)) {
            $room_number = $student->room_number;
            $capacity = $this->getRoom($room_number)->capacity + 1;

            $this->db->query('UPDATE rooms SET capacity = :capacity WHERE room_number = :number');

            $this->db->bind(':capacity', $capacity);
            $this->db->bind(':number', $room_number);

            if (!$this->db->execute()) {
                return false;
            }
        }

        $this->db->query('DELETE FROM students WHERE student_id = :id');

        $this->db->bind(':id', $id);

        if (!$this->db->execute()) {
            return false;
        }

        return true;
    }

    public function addRoom($data) {
        $this->db->query(
            'INSERT INTO rooms (room_number, capacity, price, room_type)
            VALUES (:number, :capacity, :price, :type)'
        );

        $this->db->bind(':number', $data['number']);
        $this->db->bind(':capacity', $data['capacity']);
        $this->db->bind(':price', $data['price']);
        $this->db->bind(':type', $data['type']);

        if ($this->db->execute()) {
            return true;
        } else {
            false;
        }
    }

    public function deleteRoom($number) {
        $this->db->query('SELECT * FROM rooms WHERE room_number = :number');

        $this->db->bind(':number', $number);

        $room = $this->db->single();

        if ($room->capacity < $room->room_type) {
            return false;
        }

        $this->db->query('DELETE FROM rooms WHERE room_number = :number');

        $this->db->bind(':number', $number);

        $this->db->execute();

        return true;
    }

    public function addItem($data) {
        $this->db->query(
            'INSERT INTO inventory (item_name, quantity)
            VALUES (:name, :quantity)'
        );

        $this->db->bind(':name', $data['name']);
        $this->db->bind(':quantity', $data['quantity']);

        if ($this->db->execute()) {
            return true;
        } else {
            false;
        }
    }

    public function deleteItem($name) {
        $this->db->query('DELETE FROM inventory WHERE item_name = :name');

        $this->db->bind(':name', $name);

        if (!$this->db->execute()) {
            return false;
        }

        return true;
    }

    public function addInformation($data) {
        $this->db->query(
            'INSERT INTO information (title, content)
            VALUES (:title, :content)'
        );

        $this->db->bind(':title', $data['title']);
        $this->db->bind(':content', $data['content']);

        if ($this->db->execute()) {
            return true;
        } else {
            false;
        }
    }

    public function deleteInformation($id) {
        $this->db->query('DELETE FROM information WHERE id = :id');

        $this->db->bind(':id', $id);

        if (!$this->db->execute()) {
            return false;
        }

        return true;
    }
    
}

?>