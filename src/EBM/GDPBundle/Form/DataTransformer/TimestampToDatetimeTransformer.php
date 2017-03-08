<?php

namespace EBM\GDPBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\UnexpectedTypeException;

/**
 * Transformer une date stocké au format UNIX en un objet date
 */
class TimestampToDatetimeTransformer implements DataTransformerInterface
{

    public function transform($value)
    {
        // $value est ici la valeur stockée en base
        // On la convertit en date

        if ($value != null && get_class($value) == \DateTime::class) {
            return $value->format('m/d/Y');
        }

        // Par défaut, date vide
        return "";
    }

    public function reverseTransform($value)
    {
        // $value est ici la valeur stockée dans le formulaire
        // On la convertit en DateTime
        // http://php.net/manual/fr/function.strtotime.php

        $dateTime = \DateTime::createFromFormat('m/d/Y',$value);

        return $dateTime;
    }
}

