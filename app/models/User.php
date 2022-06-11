<?php

class User {
    private $db;

    public function __construct () {
        $this->db = new Database;
    }


    public function register($data) {
        $this->db->query('INSERT INTO mvcframework.users (user_name, user_email, password) 
        VALUES (:username, :email, :password)');

        //Bind values
        $this->db->bind(':username', $data['username']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']);

        //Execute function
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function login($username, $password) {
        $this->db->query('SELECT * FROM mvcframework.users WHERE user_name = :username');

        //Bind value
        $this->db->bind(':username', $username);

        $row = $this->db->single();

        $hashedpassword = $row->password;

        if (password_verify($password, $hashedpassword)) {
            return $row;
        } else {
            return false;
        }
    }


    //Find user by email. Email is passed in by Controller.
    public function findUserByEmail ($email) {
        //Prepared statement
        $this->db->query('SELECT * FROM mvcframework.users WHERE user_email = :email');

        //Bind email param with email variable
        $this->db->bind(':email', $email);

        //Check if email is already registered
        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }


    public function getUsers() {
        $this->db->query("SELECT * FROM mvcframework.users");

        $result = $this->db->resultSet();

        return $result;
    }
}