<?php

namespace EBM\KMBundle\Service;

use Core\UserBundle\Entity\User;
use EBM\KMBundle\Entity\Tag;
use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * Class TagService
 * @package EBM\KMBundle\Service
 */
class TagService
{
    private $em;
    private $unrestricted_tags = array('general');
    private $restricted_tags = array('machine','departement','type_document');

    public function __construct(\Doctrine\ORM\EntityManager $e)
    {
        $this->em = $e;
    }

    /**
     * Récupère tous les tags présents dans la base de données.
     *
     * @return array(Tags)
     */
    public function getAllTags()
    {
        return $this->em->getRepository('EBMKMBundle:Tag')->findAll();
    }

    /**
     * Récupère le tag dont l'id vaut $id.
     *
     * @param $id
     * @return null|object(Tag)
     */
    public function getTagById($id)
    {
        return $this->em->getRepository('EBMKMBundle:Tag')->find($id);
    }

    /**
     * Retourne tous les tags d'un type donné.
     *
     * @param $type (general, machine...)
     * @return array
     */
    public function getTagsByType($type) {
        return $this->em->getRepository('EBMKMBundle:Tag')->getTagsByType($type);
    }

    /**
     * Retourne tous les tags dont le nom commence par $begin.
     *
     * @param $begin
     * @return array
     */
    public function getTagsByBeginning($begin) {
        return $this->em->getRepository('EBMKMBundle:Tag')->getTagsByBegin($begin);
    }

    /**
     * Créer un nouveau tag.
     *
     * Nécessite les informations à mettre dans le tag.
     * Nécessite aussi l'utilisateur qui va créer le tag afin de vérifier
     * qu'il a les droits sur le type de tag selectionné.
     *
     * @param $name
     * @param $type
     * @param $description
     * @param $type
     * @param $user
     */
    public function createTag($name, $type, $description, User $user) {
        $tag = new Tag();

        // Tags protégés
        if(in_array($type, $this->restricted_tags))
        {
            if($user->getManagedTags()->contains($name))
            {
                $tag->setName($name);
                $tag->setType($type);
                $tag->setDescription($description);

                $this->em->persist($tag);
                $this->em->flush();

            }
            else {
                throw new HttpException(500, "Non implémenté");
            }

        }
        // Tags libres
        else if(in_array($type, $this->unrestricted_tags))
        {
            $tag->setName($name);
            $tag->setType($type);
            $tag->setDescription($description);

            $this->em->persist($tag);
            $this->em->flush();
        }

        // Erreur dans les autres cas
        else {
            throw new HttpException('500','Server error');
        }
    }
}