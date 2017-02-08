<?php

namespace Core\IconbarBundle\Listener;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;

class TwigConstructorListener
{
    protected $twig;

    public function __construct(\Twig_Environment $twig)
    {
        $this->twig = $twig;
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        date_default_timezone_set("Europe/Paris");
        $this->twig->addGlobal('user_timezone', "Europe/Paris");
    }

}