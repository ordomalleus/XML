<?php

namespace Aplication\Controllers;

use Aplication\Models\Importxml as ImportxmlModels;
use Aplication\Classes\Views;

class Importxml
{
    public function actionAddForm()
    {
        $view = new Views();
        $view->display('importxml/importxmlAdd.php');
    }

    public function actionAdd()
    {
        $file = $_FILES['newXml']['tmp_name'];
        $xml = new ImportxmlModels();
        $result = $xml->importXml($file);

        $view = new Views();
        $view->xml = $result;
        $view->display('importxml/importxmlOne.php');
    }
}