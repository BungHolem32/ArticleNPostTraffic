<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 02/02/17
 * Time: 20:45
 */

namespace App\Http\Entities;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="authors")
 */
class Author
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id;


    /**
     * @ORM\Column(type="string")
     */
    protected $name;


    /**
     * @ORM\OneToMany(targetEntity="Article", mappedBy="author", cascade={"persist"} )
     * @var ArrayCollection|Article[]
     */
    protected $articles;



    /**
     * Author constructor.
     */
    public function __construct()
    {
        $this->articles = new ArrayCollection;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return Article[]|ArrayCollection
     */
    public function getArticles()
    {
        return $this->articles;
    }

    /**
     * @internal param Article[]|ArrayCollection $articles
     * @param Article $article
     */
    public function setArticle(Article $article)
    {
        if (!$this->articles->contains($article)) {
            $article->setAuthor($this);
            $this->articles->add($article);
        }
    }
}