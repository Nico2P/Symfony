<?php
/**
 * Created by PhpStorm.
 * User: Nico
 * Date: 11/12/2017
 * Time: 09:54
 */

namespace OC\PlatformBundle\Event;

use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\Security\Core\User\UserInterface;

class MessagePostEvent extends Event
{
    protected $message;
    protected $user;

    public function __construct($message, UserInterface $user)
    {
        $this->message = $message;
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param mixed $message
     */
    public function setMessage($message)
    {
      return $this->message = $message;
      // Modification du message possible ici
    }

    /**
     * @return UserInterface
     */
    public function getUser()
    {
        return $this->user;
    }

}