<?php

/**
 * Created by PhpStorm.
 * User: huber
 * Date: 21/03/2017
 * Time: 10:59
 */

namespace EBM\KMBundle\Entity\Enums;

abstract class PostStatusEnum
{

    CONST STATUS_DEFAULT = "STATUS_DEFAULT";
    CONST STATUS_BLOCKED = "STATUS_BLOCKED";
    CONST STATUS_CLOSED = "STATUS_CLOSED";

    /**
     * Tableau regroupant la correspondance entre statut d'un post et nom pour l'affichage.
     *
     * @var array
     */
    protected static $StatusName = [
        self::STATUS_DEFAULT => "Défaut",
        self::STATUS_BLOCKED => "Bloqué",
        self::STATUS_CLOSED => "Fermé",
    ];

    /**
     * Fonction permettant de récupérer le nom d'un statut pour l'afficher sur une IHM.
     * @param $statusName
     * @return mixed|string
     */
    public static function getStatusName($statusName)
    {
        if(!isset(static::$StatusName[$statusName])){
            return "Type de tag inconnu ($statusName)";
        }

        return static::$StatusName[$statusName];
    }

    /**
     * Renvoie l'ensemble des statuts possibles pour un post.
     *
     * @return array
     */
    public static function getAvailableStatus()
    {
        return [
            self::STATUS_DEFAULT,
            self::STATUS_BLOCKED,
            self::STATUS_CLOSED,
        ];
    }

}