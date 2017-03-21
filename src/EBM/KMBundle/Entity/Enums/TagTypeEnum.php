<?php

/**
 * Created by PhpStorm.
 * User: huber
 * Date: 21/03/2017
 * Time: 10:59
 */

namespace EBM\KMBundle\Entity\Enums;

abstract class TagTypeEnum
{

    CONST TYPE_GENERAL = "TYPE_GENERAL";
    CONST TYPE_MACHINE = "TYPE_MACHINE";
    CONST TYPE_DEPARTMENT = "TYPE_DEPARTMENT";
    CONST TYPE_DOCUMENT = "TYPE_DOCUMENT";

    /**
     * Tableau regroupant la correspondance entre type de tag et nom pour l'affichage.
     *
     * @var array
     */
    protected static $typeName = [
        self::TYPE_GENERAL => "Général",
        self::TYPE_MACHINE => "Machine",
        self::TYPE_DEPARTMENT => "Département",
        self::TYPE_DOCUMENT => "Document"
    ];

    /**
     * Fonction permettant de récupérer le nom d'un type pour l'affichage sur une IHM.
     * @param $typeName
     * @return mixed|string
     */
    public static function getTypeName($typeName)
    {
        if(!isset(static::$typeName[$typeName])){
            return "Type de tag inconnu ($typeName)";
        }

        return static::$typeName[$typeName];
    }

    /**
     * Renvoie l'ensemble des types de tags disponibles
     *
     * @return array
     */
    public static function getAvailableTypes()
    {
        return [
            self::TYPE_GENERAL,
            self::TYPE_MACHINE,
            self::TYPE_DEPARTMENT,
            self::TYPE_DOCUMENT
        ];
    }

    /**
     * Renvoie l'ensembel des tags dont l'accès est restreint.
     *
     * @return array
     */
    public static function getRestrictedTypes()
    {
        return [
            self::TYPE_MACHINE,
            self::TYPE_DEPARTMENT,
            self::TYPE_DOCUMENT
        ];
    }

    public static function getNonRestrictedTypes(){
        return [
            self::TYPE_GENERAL
        ];
    }
}