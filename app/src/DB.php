<?php

namespace Homework;

use PDO;
use PDOException;

class DB
{
    protected $connection;


    public function __construct($servername = 'localhost', $username = 'root', $password = '', $DBName = 'clients') 
    {
        try {
            $this->connection = new PDO("mysql:host=".$servername.";dbname=".$DBName, $username, $password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connected successfully";
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }

    }

    /**
     * Create a new database 
     * @param string database name
     */
    public function createDB(string $DBName) 
    {
        try {
            $sql = "CREATE DATABASE $DBName";

            $stmt = $this->connection->prepare($sql);
          
            $stmt->execute();
            echo "Database created successfully<br>";
          } catch(PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
          }
          
          $this->connection = null;
    }

        /**
     * Create a table 
     * @param string query
     */
    public function createTable(string $sql) 
    {
        try {
            $stmt = $this->connection->prepare($sql);
          
            $stmt->execute();
            echo "table created successfully<br>";
          } catch(PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
          }
          
          $this->connection = null;
    }



    /**
     * insert into a table 
     * @param string query
     */
    public function insert(string $sql)
    {
        try {
            $stmt = $this->connection->prepare($sql);
          
            $stmt->execute();
            echo "New record created successfully";
        } catch(PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
          }
      
      $this->connection = null;
    }


      /**
     * delete column 
     * @param string query
     */
    public function delete(string $sql)
    {
        try {
            $stmt = $this->connection->prepare($sql);

            $stmt->execute();
            echo "Record deleted successfully";
          } catch(PDOException $e) {
              echo $sql . "<br>" . $e->getMessage();
          }
      
    }   

    /**
     * update column 
     * @param string query
     */
    public function update(string $sql)
    {
        try {
            $stmt =  $this->connection->prepare($sql);
          
            $stmt->execute();
          
            echo $stmt->rowCount() . " records UPDATED successfully";
          } catch(PDOException $e) {
              echo $sql . "<br>" . $e->getMessage();
          }
      
    }   


    // /**
    //  * insert into a table 
    //  * @param string query
    //  */
    // public function deleteTable(string $sql) 
    // {

    // }

}