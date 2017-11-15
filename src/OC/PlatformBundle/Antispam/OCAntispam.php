<?php
/**
 * Created by PhpStorm.
 * User: Nico
 * Date: 15/11/2017
 * Time: 14:06
 */

namespace OC\PlatformBundle\Antispam;


class OCAntispam
{


    private $mailer;
    private $locale;
    private $minLength;

    public function __construct(\Swift_Mailer $mailer, $locale, $minLength)
    {
        $this->mailer = $mailer;
        $this->locale = $locale;
        $this->minLength = $minLength;
    }

    /** Verifie su le texte est spam
     * @param string $text
     * @return bool
     *
     **/

    public function isSpam($text)
    {
        return strlen($text) < 50;
    }

}