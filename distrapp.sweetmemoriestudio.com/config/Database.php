<?php

class Database extends PDO {

    private $totalRows;
    private $columns;

    function __construct() {

        parent::__construct('mysql:host=distrapp.sweetmemoriestudio.com;dbname=distrapp', 'usuario_24092015', 'wOa8*4n7', array(
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',));
        /*
          parent::__construct('mysql:host=mysql.hostinger.co;dbname=u524098790_users',
          'u524098790_root',
          'yLt7yRuHOk',array(
          PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
          )); */
    }

    function selectQuery($table, $columns, $where) {

        $where = trim($where) == "" ? "" : " WHERE $where";
//        echo "SELECT COUNT(*) total FROM (SELECT $columns FROM $table $where)USU";
//        $this->totalRows = parent::query("SELECT COUNT(*) total FROM (SELECT $columns FROM $table $where)USU")->fetch();


//        echo "SELECT $columns FROM $table $where";
        return parent::query("SELECT $columns FROM $table $where");
    }

    function insertQuery($table, $columns, $values) {
        //echo "$table, $columns, $values";
//        echo "INSERT INTO $table ($columns) VALUES ($values)";
        $query = parent::query("INSERT INTO $table ($columns) VALUES ($values)");
//        echo "<h2>".parent::lastInsertId()."</h2>";
        return $query;
    }

    function updateQuery($table, $columnValues, $where) {
//			die( "UPDATE $table SET $columnValues WHERE $where");
        return parent::query("UPDATE $table SET $columnValues WHERE $where");
    }

    function query($query) {
//        echo $query;
        return parent::query($query);
    }

}

?>