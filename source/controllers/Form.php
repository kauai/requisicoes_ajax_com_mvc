<?php
/**
 * Created by PhpStorm.
 * User: thiago
 * Date: 27/09/2019
 * Time: 11:33
 */

namespace Source\controllers;

use League\Plates\Engine;
use Source\models\User;

class Form
{
    /** @var  Engine */
    private $view;

    function __construct($router)
    {
        $this->router = $router;
        
        $this->view = Engine::create(
            dirname(__DIR__, 2) . '/theme',
            "php"
        );

        $this->view->addData(['router' => $router]);
    }

    public function home():void
    {
      echo $this->view->render('home',[
         "users" => (new User())
             ->find()
             ->order('id DESC')
             ->fetch(true)
      ]);
    }


    public function create(array $data):void
    {
        $userData = filter_var_array($data,FILTER_SANITIZE_STRING);
        
        if(in_array("",$userData)){
           $calback['message'] = message('Informe todos os campos','error');
           echo json_encode($calback);
           return;
        }

    
        
        $user = new User();
        $user->first_name = $data['first_name'];
        $user->last_name = $data['last_name'];
        $user->email = $data['email'];
        $userId = $user->save();

        $calback['message'] = message('Usuario cadastrado com sucesso','success');
        $calback['user'] = $this->view->render('user',['user' => $user]);
        echo json_encode($calback);

        // if($userId) {
        //     echo json_encode(["id" => $userId]);
        // }else{
        //     echo message("Erro ao criar usuario");
        // }
    }



    public function delete(array $data):void
    {
        if(empty($data['id'])) {
            return;
        }

        $id = filter_var($data['id'], FILTER_VALIDATE_INT);
        $user = (new User())->findById($id);

        if($user){
            $user->destroy();
        }

        echo json_encode(['ok' => true]);
    }

}

