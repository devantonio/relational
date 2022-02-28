<?php 

namespace Homework;

use Homework\DB;


class Client
{




    /**HANDLE CLIENTS TABLE**/

     /**
   * Add a Client to the Clients table
   * @param string Client name
   */

  public function addClient(string $name) {
    $db = new DB();

    $sql = "INSERT INTO clients (id, name) VALUES ('', '$name')";

    $db->insert($sql);
  }

  /**
   * editClient on the Clients table
   * When one client is edited, edit it's corresponding children (sections and links)  in a loop
   * @param int Client id
   * @param string Client name
   * 
   */
  public function editClient(int $id, string $name) 
  {
    $db = new DB();

    $tables = ["clients", "sections", "links"];

    foreach ($tables as $table) {
      $tableId = (
        ($table == "clients") ? "id" 
        : (($table == "sections") ? "client_id" 
        : (($table == "links") ? "section_id" 
        : '')));

      $sql = "UPDATE $table SET $table.name='$name' 
      WHERE $tableId=$id ";

      $db->update($sql);
    }
  }



  /**
   * deleteClient on the Clients table
   * When one client is deleted, delete it's corresponding children (sections and links) in a loop
   * @param int Client id
   * 
   */
  public function deleteClient(int $id) 
  {
    $db = new DB();

    $tables = ["clients", "sections", "links"];

    foreach ($tables as $table) {
      $tableId = (
        ($table == "clients") ? "id" 
        : (($table == "sections") ? "client_id" 
        : (($table == "links") ? "section_id" 
        : '')));

      $sql = "DELETE FROM $table WHERE $tableId=$id ";

      $db->delete($sql);

      }
  }


   /**HANDLE SECTIONS TABLE**/

    /**
   * Add a Section to the Sections table WHERE an id exists
   * @param int Client id
   * @param string Client name
   */
  public function addSection(int $client_id, string $name) 
  {
    $db = new DB();

    $sql = "INSERT INTO sections (id, client_id, name)
            SELECT '', $client_id, '$name' FROM DUAL
            WHERE EXISTS (SELECT id FROM clients
            WHERE id=$client_id AND name='$name'
          )";

    $db->insert($sql);

  }

    /**
   * editSection on the Sections table
   * When one Section is edited, edit it's corresponding child (links) in a loop
   * @param int Client id
   * @param string Client name
   * 
   */
  public function editSection(int $client_id, string $name) 
  {
    $db = new DB();

    $tables = ["sections", "links"];

    foreach ($tables as $table) {
      $tableId = (
        ($table == "sections") ? "client_id" 
        : (($table == "links") ? "section_id" 
        : ''));

      $sql = "UPDATE $table SET $table.name='$name' 
      WHERE $tableId=$client_id ";

      $db->update($sql);
    }
  }


    /**
   * deleteSection on the Sections table
   * When one Section is deleted, delete it's corresponding child (links) in a loop
   * @param int Client id
   * 
   */
  public function deleteSection(int $client_id) 
  {
    $db = new DB();

    $tables = ["sections", "links"];

    foreach ($tables as $table) {
      $tableId = (
        ($table == "sections") ? "client_id" 
        : (($table == "links") ? "section_id" 
        : ''));

      $sql = "DELETE FROM $table WHERE $tableId=$client_id ";

      $db->delete($sql);
    }
  }




  /**HANDLE LINKS TABLE**/


    /**
   * Add a Link to the Links table WHERE a client_id exists
   * @param int Section id
   * @param string Client name
   */
  public function addLink(int $section_id, string $name) 
  {
    $db = new DB();

    $sql = "INSERT INTO links (id, section_id, name)
            SELECT '', $section_id, '$name' FROM DUAL
            WHERE EXISTS (SELECT id FROM sections
            WHERE client_id=$section_id AND name='$name'
          )";

    $db->insert($sql);
  }



  /**
   * editLink on the Links table
   * @param int Section id
   * @param string Client name
   * 
   */
  public function editLink(int $section_id, string $name) 
  {
    $db = new DB();
    
    $sql = "UPDATE links SET name='$name' WHERE section_id=$section_id";

    $db->update($sql);
  }


  /**
   * deleteLink on the Links table
   * @param int Section id
   * 
   */
  public function deleteLink(int $section_id) 
  {
    $db = new DB();

    $sql = "DELETE FROM links WHERE section_id=$section_id";

    $db->delete($sql);
  }



    /**
   * Create a table to add to the database 
   * 
   */


  public function addTable(string $sql) {
    $db = new DB();

    // $sql = "CREATE TABLE clients (
    //   id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    //   name VARCHAR(30) NOT NULL
    //   )";

    // $sql = "CREATE TABLE sections (
    //   id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    //   client_id INT(6),
    //   name VARCHAR(30) NOT NULL
    //   )";

    // $sql = "CREATE TABLE links (
    //   id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    //   section_id INT(6),
    //   name VARCHAR(30) NOT NULL
    //   )";
    
    // $db->createTable("clients" , $sql);
   }
}

