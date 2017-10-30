<?php
namespace App\Controller;

use RestApi\Controller\ApiController;
use RestApi\Utility\JwtToken;
use Migrations\Migrations;
use Cake\Auth\DefaultPasswordHasher;
use App\Model\Util\Resposta;
use Cake\I18n\Time;

class HomeController extends ApiController
{
    public function initialize() {
        parent::initialize();
        $migrations = new Migrations();
        $migrations->migrate();
        
        
        $this->loadModel('Users');
    }

    public function login()
    {
        $usuario = "";
        $senha = "";
        if($this->request->allowMethod('post')){
            $request_data = $this->request->getData();
            if((!isset($request_data['email'])) || (!isset($request_data['senha']))){
                $this->httpStatusCode = 300;
                $this->apiResponse['mesagen'] = 'Os campos email e senha são obrigatórios';
                return;
            }else{
                $usuario = strval($request_data['email']);
                $senha = strval($request_data['senha']);
            }
            
            $user = $this->Users->find('all')->where(['email' => $usuario ])->first();
            if($user){
                if((new DefaultPasswordHasher)->check($senha, $user->password)){
                    $time = Time::now()->timestamp;
                    $token =  JwtToken::generateToken($time);
                    $this->httpStatusCode = 200;
                    $this->apiResponse['user'] = $user;
                    $this->apiResponse['token'] = $token;
                }else{
                    Resposta::erro($this, "Email ou senha invalidos");
                }
                
            }else{
                Resposta::erro($this, "Email ou senha invalidos");
            }
            
        }
        
    }
    
    public function createuser(){
        $user = $this->Users->newEntity();
        
        if($this->request->allowMethod('post')){
            
            $request_data = $this->request->getData();
            
            $user = $this->Users->patchEntity($user, $request_data);
            if ($this->Users->save($user)) {
                $array = [
                    "email" => $user->email,
                    "created" => $user->created,
                    "modified" => $user->modified,
                ];
                Resposta::resposta_correta($this, $array);
            }else{
                Resposta::erro($this, "Dados invalidos");
            }
            
            
        }
    }
    
}