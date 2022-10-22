<?php 
namespace App\Http\Requests;

use App\Database\Config\connection;


class validation  {

    private  $input;
    private  $inputName;
    private array $errs = [];


    public function required(): self {
        
        if( empty($this->input) ){
            $this->errs[$this->inputName][__FUNCTION__] = "this field is required";
        }
        return $this;
    }
    
    public function string(): self {

        if(! is_string($this->input)){
            $this->errs[$this->inputName][__FUNCTION__] = "the input must be string ";
        }
        return $this;
    }

    public function numeric(): self{
        if(! is_numeric($this->input)){
            $this->errs[$this->inputName][__FUNCTION__] = "phone must be numeric";
        }
        return $this;
    }

    public function between($min , $max): self {

        if(strlen($this->input) < $min || strlen($this->input)  > $max ){
            $this->errs[$this->inputName][__FUNCTION__] = "the input must be between {$min} and {$max}";
        }
        return $this;
    }

    public function unique($tableName , $columnName , $message=null) :self{
        $query = "SELECT * FROM {$tableName} WHERE {$columnName} = ?";
        $conn = new connection;
        $statement = $conn->connection->prepare($query);
        if(! $statement){
            $this->errs[$this->inputName][__FUNCTION__] = "something went wrong";
        }
        $statement->bind_param('s' , $this->input);
        $statement->execute();
        if($statement->get_result()->num_rows == 1){
            $this->errs[$this->inputName][__FUNCTION__] = $message ?? "email exists";
        }
        return $this;
    }

    public function existInDataBase(){

    }

    public function regex($value , $message=null): self {
        if(! preg_match($value , $this->input)){
            $this->errs[$this->inputName][__FUNCTION__] = $message ?? "you must enter a valid email";
        }
        return $this;
    }

    public function passwordMatch($password): self {

        if($this->input !== $password){
            $this->errs[$this->inputName][__FUNCTION__] = "password doesn't confirmed";
        }
        return $this;
    }

    public function allowed(array $values): self {
        if(! in_array($this->input , $values)){
            $this->errs[$this->inputName][__FUNCTION__] = "allowed values are " . implode(',' , $values);
        }
        return $this;
    }

    public function passwordCheck($message=null): self{

        $query = "SELECT * FROM users WHERE  email = ? AND password = ?";
        $conn = new connection;
        $statement = $conn->connection->prepare($query);
        print_r($statement);
        if(! $statement){
            echo "something went wrong";
            return $this;
        }
        $statement->bind_param('ss' , $_SESSION['user']->email , $this->input );
        $statement->execute();
        $result = $statement->get_result();
        if($result->num_rows == 1){
            $this->errs[$this->inputName][__FUNCTION__] = "old password is wrong";
            var_dump($this->errs);
            return $this;
        }
        return $this;
    }
    /**
     * Set the value of input
     *
     * @return  self
     */ 
    public function setInput($input)
    {
        $this->input = $input;

        return $this;
    }

    /**
     * Set the value of inputName
     *
     * @return  self
     */ 
    public function setInputName($inputName)
    {
        $this->inputName = $inputName;

        return $this;
    }

    /**
     * Set the value of errs
     *
     * @return  self
     */ 
    public function seterrs($errs)
    {
        $this->errs = $errs;

        return $this;
    }

    /**
     * Get the value of errs
     */ 
    public function getErrs()
    {
        return $this->errs;
    }

    // get first error message to display 
    public function errMessage(){
        if(isset($this->errs[$this->inputName])){
            foreach($this->errs[$this->inputName] as $err){
                    return "<p class='text-danger font-weight-bold' > " . $err . "</p>";
                
            }
        }
        
    }
}