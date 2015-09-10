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

    //Поиск по полю и значению, возвращает объект / переопределенный метод
    public static function getOneColumn($column, $value)
    {
        $config = new Config();
        $db = new PdoSql($config->bd, $config->server, $config->user, $config->password);

        $db->setClassName(get_called_class());

        $query = 'SELECT * FROM ' . static::getTable() . ' WHERE ' . $column . '=:value';
        $res = $db->query($query, [':value' => $value]);

        if (empty($res)) {
            return false;
        }

        return $res[0];
    }

    //обновление по xml файлу
    public function importXml($files)
    {
        $file = simplexml_load_file($files);
        $userXml = $file->user;
        //$countXml=$file->count();
        $a = 0;
        $test = [];
        foreach($userXml as $key){
            $this->login = $key->login;
            $this->name = $this->login;
            $this->password = $key->password;
            $this->email =  $this->login.'@example.com';
            $this->insert();
            $a++;
            //$test[] = $key;
        }
        return 'Добавлено '.$a.' записей';
        //return $test;
    }


}