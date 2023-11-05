<?php


class Database
{

   private static $dbHost="localhost";
   private static $dbName="boutique-NL";
   private static $dbUser="root";
   private static $dbPass="";

   private static $connect=null;

   public static function Connection()
    {

        try
        {
        
            self::$connect=new PDO("mysql:host=".self::$dbHost.";dbname=".self::$dbName,self::$dbUser,self::$dbPass);
            self::$connect->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            self::$connect->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
        }
        catch(PDOException $e)
        {
            die($e->getMessage());
        }
        return self::$connect;
    }

    public static function deconnection()
    {
        self::$connect=null;
    }
    

}

Database::Connection();


?>