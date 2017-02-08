<?php

// src/Core/IconbarBundle/Entity/Image
/*
 * C'est ici qu'on gère nos images. A noter qu'il n'est pas obligatoire d'uploader un fichier, si on renseigne une URL !
 * Pour que ça puisse fonctionner, le dossier web/uploads/img doit exister
 * Pour afficher une entité image, c'est simple, qu'elle soit enregistrée par son url ou bien par le fichier en base :
 * {% set image = myEntity.image %}
 * {% include("Core/IconbarBundle:components/file:image.html.twig") %}
 * Pour personnaliser le style, on utilisera :
 * {% set image = myEntity.image %}
 * {% embed "Core/IconbarBundle:components/file:image.html.twig" %}
 *  {% block imageClass %} class1 class2 {% endblock %}
 *  {% block imageStyle %} style1 style2 {% endblock %}
 * {% endembed %}
 *  
 */


namespace Core\IconbarBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Table(name="core_image")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class Image
{
  /**
   * @ORM\Column(name="id", type="guid")
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="UUID")
   */
  private $id;

  /**
   * @ORM\Column(name="url", type="string", length=255)
   */
  private $url="";

  /**
   * @ORM\Column(name="alt", type="string", length=255)
   */
  private $alt=""; // on le génère à la création de l'image, par le code

  /**
   * @Assert\Image
    (mimeTypes = {"image/jpg", "image/jpeg", "image/png"}, 
     mimeTypesMessage = "core/iconbar.assert.image",
     maxSize="2000k")
   */
  private $file;

  // On ajoute cet attribut pour y stocker le nom du fichier temporairement
  private $tempFilename="";

  /**
   * @ORM\PrePersist()
   * @ORM\PreUpdate()
   */
  public function preUpload()
  {
    // Si jamais il n'y a pas de fichier (champ facultatif), on ne fait rien
    if (null === $this->file) {
      return;
    }

    // Le nom du fichier est son id, on doit juste stocker également son extension
    // Pour faire propre, on devrait renommer cet attribut en « extension », plutôt que « url »
    $this->url = $this->file->guessExtension();

    // Et on génère l'attribut alt de la balise <img>, à la valeur du nom du fichier sur le PC de l'internaute
    $this->alt = $this->file->getClientOriginalName();
  }

  /**
   * @ORM\PostPersist()
   * @ORM\PostUpdate()
   */
  public function upload()
  {
    // Si jamais il n'y a pas de fichier (champ facultatif), on ne fait rien
    if (null === $this->file) {
      return;
    }

    // Si on avait un ancien fichier (attribut tempFilename non null), on le supprime
    if (null !== $this->tempFilename) {
      $oldFile = $this->getUploadRootDir().'/'.$this->id.'.'.$this->tempFilename;
      if (file_exists($oldFile)) {
        unlink($oldFile);
      }
    }

    // On déplace le fichier envoyé dans le répertoire de notre choix
    $this->file->move(
      $this->getUploadRootDir(), // Le répertoire de destination
      $this->id.'.'.$this->url   // Le nom du fichier à créer, ici « id.extension »
    );
  }

  /**
   * @ORM\PreRemove()
   */
  public function preRemoveUpload()
  {
    // On sauvegarde temporairement le nom du fichier, car il dépend de l'id
    $this->tempFilename = $this->getUploadRootDir().'/'.$this->id.'.'.$this->url;
  }

  /**
   * @ORM\PostRemove()
   */
  public function removeUpload()
  {
    // En PostRemove, on n'a pas accès à l'id, on utilise notre nom sauvegardé
    if (file_exists($this->tempFilename)) {
      // On supprime le fichier
      unlink($this->tempFilename);
    }
  }

  public function getUploadDir()
  {
    // On retourne le chemin relatif vers l'image pour un navigateur (relatif au répertoire /web donc)
    return 'uploads/img';
  }

  protected function getUploadRootDir()
  {
    // On retourne le chemin relatif vers l'image pour notre code PHP
    return __DIR__.'/../../../web/'.$this->getUploadDir();
  }

  public function getName()
  {
    return $this->getId().'.'.$this->getUrl();
  }


  /**
   * @param string $url
   */
  public function setUrl($url)
  {
    $this->url = $url;
  }

  /**
   * @return string
   */
  public function getUrl()
  {
    return $this->url;
  }

  /**
   * @param string $alt
   */
  public function setAlt($alt)
  {
    $this->alt = $alt;
  }

  /**
   * @return string
   */
  public function getAlt()
  {
    return $this->alt;
  }

  /**
   * @return UploadedFile
   */
  public function getFile()
  {
    return $this->file;
  }

  /**
   * @param UploadedFile $file
   */
  // On modifie le setter de File, pour prendre en compte l'upload d'un fichier lorsqu'il en existe déjà un autre
  public function setFile(UploadedFile $file)
  {
    $this->file = $file;

    // On vérifie si on avait déjà un fichier pour cette entité
    if (null !== $this->url) {
      // On sauvegarde l'extension du fichier pour le supprimer plus tard
      $this->tempFilename = $this->url;

      // On réinitialise les valeurs des attributs url et alt
      $this->url = null;
      $this->alt = null;
    }
  }

    /**
     * Get id
     *
     * @return guid
     */
    public function getId()
    {
        return $this->id;
    }
}
