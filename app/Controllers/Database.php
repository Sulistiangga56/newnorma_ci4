<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Database extends BaseController
{
    public function index()
    {
        //
    }

    public function backup()
    {
        // get host, password, username, database from config
        $db = \Config\Database::connect();
        $query = $db->query("SHOW TABLES");
        $result = $query->getResultArray();
        $allTables = [];
        foreach ($result as $key => $value) {
            if (isset($value['Tables_in_' . $db->database])) {
                $allTables[] = $value['Tables_in_' . $db->database];
            }
        }
        // create name for backup file
        $name = $db->database;
        // create filename as database name plus current date
        $name .= date('Y-m-d-H-i-s');
        // write sql command to file
        $file = WRITEPATH . 'uploads/' . $name . '.sql';
        $handle = fopen($file, 'w+');
        foreach ($allTables as $key => $value) {
            $query = $db->query("SHOW CREATE TABLE $value");
            $result = $query->getResultArray();
            $sql = $result[0]['Create Table'];
            fwrite($handle, $sql . ";\n\n");
        }
        foreach ($allTables as $key => $namaTable) {
            $query = $db->query("SELECT * FROM $namaTable");
            $result = $query->getResultArray();
            foreach ($result as $key => $value) {
                $sql = "INSERT INTO $namaTable VALUES (";
                foreach ($value as $key => $value2) {
                    $sql .= "'$value2',";
                }
                $sql = rtrim($sql, ',');
                $sql .= ");\n";
                fwrite($handle, $sql);
            }
        }
        fclose($handle);
        // download backup file
        return $this->response->download($file, null);
        // get current date
        // $date = date('Ymd');
        // backup file name
        // $fileName = "backup-$name-$date.sql";
        // backup file path
        // $filePath = WRITEPATH . 'uploads/' . $fileName;
        // command to backup database
        // $command = "mysqldump --opt -h $host -u $user -p$pass $name > $filePath";
        // execute command
        // exec($command);
        // system($command); // alternative
        // check if command executed successfully

        // download backup file
        // return $this->response->download($filePath, null);
        

    }
}
