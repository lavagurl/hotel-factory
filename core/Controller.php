<?php

namespace HotelFactory\core;

use HotelFactory\models\Model;
use SplObserver;
use SplObjectStorage;
use HotelFactory\core\events\ControllerEvent;

class Controller implements \SplSubject
{

    protected $observers;
    protected $event;

    public function __construct()
    {
        $this->event = new ControllerEvent();
        $this->observers = new SplObjectStorage();
        $this->attach($this->event);
    }


    // Permet la redirection
    public function redirectTo(string $controller, $action)
    {
        header('Location: '.Helper::getUrl($controller,$action));

    }

    // Récupère l'utilisateur connecté où retourne null
    public function getUser()
    {

    }

    public function render(string $controller, string $template, array $params = null)
    {
        $this->notify();
        $this->detach($this->event);



        $myView = new View($controller, $template);
        foreach($params as $key => $param) {
            $myView->assign($key, $param);
        }
    }

    public function attach(SplObserver $observer)
    {
        $this->observers->attach($observer);
    }

    public function detach(SplObserver $observer)
    {
        $this->observers->detach($observer);
    }

    public function notify()
    {
        //var_dump('COUCOU'); die;

        /** @var SplObserver $observer */
        foreach ($this->observers as $observer) {
            $observer->update($this);
            // $observer->logged($_SERVER['REQUEST_URI']);
        }
    }




}