<?php


namespace Aplication\Models;


/**
 * Class News
 * @property $id
 * @property $login
 * @property $name
 * @property $password
 * @property $email
 */
class Importxml extends \AbstractModelNews
{
    protected static $table = 'user';
    //сохраняет первоначальное значение таблицы
    //protected static $tableOld = 'user';


    /*
    protected function createTableXml($nameTable)
    {
        $config = new Config();

        $query = 'create table '.$nameTable.' (
            id int (10) AUTO_INCREMENT,
            login varchar(50) NOT NULL,
            name varchar(50) NOT NULL,
            password varchar(50) NOT NULL,
            email varchar(50) NOT NULL,
            PRIMARY KEY (id)
        )';

        $db = new PdoSql($config->bd, $config->server, $config->user, $config->password);

        $res = $db->execute($query);

        return $res;
    }*/

    //Поиск по полю и значению, возвращает обект \ переопределенный метод
    public static function getOneColumn($column, $value)
    {
        require_once __DIR__ . '\..\config.php';

        $config = new Config();
        $db = new PdoSql($config->bd, $config->server, $config->user, $config->password);

        $db->setClassName(get_called_class());

        $query = 'SELECT * FROM ' . static::getTable() . ' WHERE ' . $column . '=:value';
        $res = $db->query($query, [':value' => $value]);

        if (empty($res)) {
            false;
        }

        return $res[0];
    }

    //обновление по xml файлу
    public function importXml($files)
    {
        $file = simplexml_load_file($files);
        $userXml = $file->user;
        //создание временной таблицы
        /*$this->createTableXml('user_tmp');
        $this->table = 'user_tmp';*/

        $a = 0;
        $test = [];
        foreach($userXml as $key => $value){
            //получаем значение из xml файла
            $this->id = '';
            $this->login = (string)$value->login;
            $this->name = (string)$value->login;
            $this->password = (string)$value->password;
            $this->email =  (string)$value->login.'@example.com';

            if ($this->getOneColumn('login',$this->login)){

            }
            $this->insert();
            $a++;
            /*$test[] = [
                'login' => (string)$value->login,
                'name' => (string)$value->login,
                'password' => (string)$value->password,
                'email' => (string)$value->login.'@example.com'
            ];*/
            //$test[]= $value;
        }
        return 'Добавлено '.$a.' записей';
        //return $test;
    }


}