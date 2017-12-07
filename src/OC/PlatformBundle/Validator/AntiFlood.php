<?php


namespace OC\PlatformBundle\Validator;


use Symfony\Component\Validator\Constraint;


/*
 * @Annotations
 */
class AntiFlood extends Constraint
{
    public $message = "Vous avez déjà posté un message il y a moins de 15 secondes, merci d'attendre un peu.";

    public function validatedBy()
    {
        return 'oc_platform_antiflood';
    }
}