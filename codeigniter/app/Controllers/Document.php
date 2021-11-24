<?php namespace App\Controllers;

class Document extends BaseController
{

    public function index(){
        $email = \Config\Services::email();

        $email->setFrom('mateusgregorio179@gmail.com', 'Painel Covid MG');
        $email->setTo('mateusgregorio178@gmail.com');

        $email->setSubject('Alerta de atenção');
        $email->setMessage('Testing the email class.');

        if($email->send()){

        }else{
            echo "invalid";
        };
        
    }
}