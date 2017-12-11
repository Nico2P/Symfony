<?php
/**
 * Created by PhpStorm.
 * User: Nico
 * Date: 11/12/2017
 * Time: 11:25
 */

namespace OC\PlatformBundle\Bigbrother;

use Symfony\Component\Security\Core\User\UserInterface;

class MessageNotificator
{
    protected $mailer;

    public function __construct(\Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function notifyByEmail($message, UserInterface $user)
    {
        $message = \Swift_Mailer::newInstance()
            ->setSubjet("Nouveau message d'un utilisateur surveillé")
            ->setFrom('admin@monsite.com')
            ->setTo('admin@monqite.com')
            ->setBody("L'utilisateur surveillé ' ". $user->getUsername()."' a posté le message suivant : '".$message."'")
        ;

        $this->mailer->send($message);
    }
}