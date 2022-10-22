<?php 


namespace App\Database\Models;
use App\Database\Config\connection;


class user extends connection {

    private $id , $first_name , $last_name , $email , $phone , $password , $gender , $image,
    $verification_code , $status , $email_verified_at , $created_at , $updated_at;

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of first_name
     */ 
    public function getFirst_name()
    {
        return $this->first_name;
    }

    /**
     * Set the value of first_name
     *
     * @return  self
     */ 
    public function setFirst_name($first_name)
    {
        $this->first_name = $first_name;

        return $this;
    }

    /**
     * Get the value of last_name
     */ 
    public function getLast_name()
    {
        return $this->last_name;
    }

    /**
     * Set the value of last_name
     *
     * @return  self
     */ 
    public function setLast_name($last_name)
    {
        $this->last_name = $last_name;

        return $this;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of phone
     */ 
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set the value of phone
     *
     * @return  self
     */ 
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get the value of password
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of gender
     */ 
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set the value of gender
     *
     * @return  self
     */ 
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get the value of image
     */ 
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set the value of image
     *
     * @return  self
     */ 
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get the value of verification_code
     */ 
    public function getVerification_code()
    {
        return $this->verification_code;
    }

    /**
     * Set the value of verification_code
     *
     * @return  self
     */ 
    public function setVerification_code($verification_code)
    {
        $this->verification_code = $verification_code;

        return $this;
    }

    /**
     * Get the value of status
     */ 
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @return  self
     */ 
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get the value of email_verified_at
     */ 
    public function getEmail_verified_at()
    {
        return $this->email_verified_at;
    }

    /**
     * Set the value of email_verified_at
     *
     * @return  self
     */ 
    public function setEmail_verified_at($email_verified_at)
    {
        $this->email_verified_at = $email_verified_at;

        return $this;
    }

    /**
     * Get the value of created_at
     */ 
    public function getCreated_at()
    {
        return $this->created_at;
    }

    /**
     * Set the value of created_at
     *
     * @return  self
     */ 
    public function setCreated_at($created_at)
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * Get the value of updated_at
     */ 
    public function getUpdated_at()
    {
        return $this->updated_at;
    }

    /**
     * Set the value of updated_at
     *
     * @return  self
     */ 
    public function setUpdated_at($updated_at)
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    public function createData(){
        $query = "INSERT INTO users (first_name , last_name , email , password , verification_code , gender , phone) VALUES (? , ? , ? , ? , ? , ? , ?)";
        $conn = new connection;
        $statement = $conn->connection->prepare($query);
        if(! $statement){
            return $statement;
        }
        $passwordHash = password_hash($this->password , PASSWORD_BCRYPT);
        $statement->bind_param('ssssisi' , $this->first_name , $this->last_name , $this->email , $passwordHash , $this->verification_code , $this->gender , $this->phone);
        return $statement->execute();
    }

    public function checkEmail(){
        $query = "SELECT * FROM users WHERE email = ?  ";
        $statement = $this->connection->prepare($query);
        if(! $statement){
            return "something went wrong";
        }
        $statement->bind_param('s' , $this->email );
        $statement->execute();
        return $statement->get_result();
    }

    public function updatePassword(){
        $query = "UPDATE users SET password = ? WHERE email = ?";
        $statement = $this->connection->prepare($query);
        $statement->bind_param('ss' , $this->password , $this->email);
        $statement->execute();
        return $this;
    }

    public function updateInformation(){
        $query = "UPDATE users SET first_name = ? , last_name = ? , email = ? , phone =? WHERE id = ?";
        $statement = $this->connection->prepare($query);
        $statement->bind_param('sssii' , $this->first_name , $this->last_name , $this->email  , $this->phone, $this->id);
        $statement->execute();
    }


    public function checkCode(){
        $query = "SELECT * FROM users WHERE email = ? AND verification_code = ? ";
        $statement = $this->connection->prepare($query);
        $statement->bind_param('si' , $this->email , $this->verification_code);
        $statement->execute();
        return $statement->get_result();
    }

    public function verify(){
        $query = "UPDATE users SET email_verified_at = ? WHERE email = ?";
        $statement = $this->connection->prepare($query);
        $statement->bind_param('ss' , $this->email_verified_at , $this->email);
        $statement->execute();
        return $statement->get_result();
    }
}

    