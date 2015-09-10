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

    //обновление по xml файлу
    public function importXml($files)
    {
        $file = simplexml_load_file($files);
        $userXml = $file->user;
        $otchet = [];

        //проверяем пуста ли база
        $bdCnt = $this->countXml($this->getTable());

        $allBd = 0; //Считает сколько записей добавленно
        $nameBd = 0; //Считает сколько имен измененно
        $passworsBd = 0; //Считает сколько паролей изменнено
        $emailBd = 0; //Считает сколько емайлов изменнено
        $delBd = 0; //Считает сколько строк удаленно

        $allLogin = []; //собираем все лоигны из файла

        if ($bdCnt->cnt == 0) {
            //Если пуста то просто копируем все из файла
            foreach ($userXml as $key => $value) {
                //получаем значение из xml файла
                $this->id = '';
                $this->login = (string)$value->login;
                $this->name = (string)$value->login;
                $this->password = (string)$value->password;
                $this->email = (string)$value->login . '@example.com';
                $this->insert();
                $allBd++;
            }
            $otchet['addBd'] = $allBd;
        } else {
            //если не пуста то начинаем добовлять из файла или изменять из файла данные
            //обнуляет значения если их не было в файле
            foreach ($userXml as $key => $value) {
                //получаем значение из xml файла
                $this->id = '';
                $this->login = (string)$value->login;
                //собираем все лоигны из файла
                $allLogin[] = (string)$value->login;
                if (isset($value->name)) {
                    $this->name = (string)$value->name;
                } else {
                    $this->name = null;
                }
                if (isset($value->password)) {
                    $this->password = (string)$value->password;
                } else {
                    $this->password = null;
                }
                if (isset($value->email)) {
                    $this->email = (string)$value->email;
                } else {
                    $this->email = null;
                }

                //проверяем есть ли логин и надо ли его изменять
                if ($this->getOneColumnXml('login', $this->login)) {
                    $objBd = $this->getOneColumnXml('login', $this->login);
                    //изменение имени в бд
                    if (isset($this->name)) {
                        if ($objBd->name != $this->name) {
                            $this->updateXml($objBd->id, 'name', $this->name);
                            $nameBd++;
                        }
                    }
                    //изменение пароля в бд
                    if (isset($this->password)) {
                        if ($objBd->password != $this->password) {
                            $this->updateXml($objBd->id, 'password', $this->password);
                            $passworsBd++;
                        }
                    }
                    //изменение мыла в бд
                    if (isset($this->email)) {
                        if ($objBd->email != $this->email) {
                            $this->updateXml($objBd->id, 'email', $this->email);
                            $emailBd++;
                        }
                    }
                } else {
                    //если логина нет то просто добавляем запись в бд
                    $this->name = $this->login;
                    $this->email = $this->login . '@example.com';
                    $this->insert();
                    $allBd++;
                }
            }
            //По новой проходим файл и бд и удаляем из бд лишнии логины полсле добавление новых

            //получаем все данные из таблицы бд
            $allBdUser = $this->getAll();
            foreach ($allBdUser as $key => $value) {

                if (in_array((string)$value->login,$allLogin)){
                    continue;
                } else{
                    $this->deleteXml($value->id);
                    $delBd++;
                }
            }

            $otchet['addBd'] = $allBd;
            $otchet['updateName'] = $nameBd;
            $otchet['updatePassword'] = $passworsBd;
            $otchet['updateEmail'] = $emailBd;
            $otchet['delBd'] = $delBd;

        }

        return $otchet;
    }


}