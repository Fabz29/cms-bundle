<?php

namespace Fabz29\CmsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Block
 *
 * @ORM\Table(name="fabz29_cms_block")
 * @ORM\Entity(repositoryClass="Fabz29\CmsBundle\Repository\BlockRepository")
 * @ORM\AttributeOverrides({
 *      @ORM\AttributeOverride(name="keyName",
 *          column=@ORM\Column(
 *              name     = "keyName",
 *              length   = 191,
 *              unique   = true
 *          )
 *      ),
 * })
 */
class Block
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Length(
     *     max=50,
     *     maxMessage="Ce nom contient trop de caractère (maximum : {{ limit }}).",
     * )
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="key_name", type="string", length=255, unique=true)
     * @Assert\NotBlank()
     */
    private $keyName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="rich_content", type="text", nullable=true)
     */
    private $richContent;

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name.
     *
     * @param string $name
     *
     * @return Block
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set keyName.
     *
     * @param string $keyName
     *
     * @return Block
     */
    public function setKeyName($keyName)
    {
        $this->keyName = $keyName;

        return $this;
    }

    /**
     * Get keyName.
     *
     * @return string
     */
    public function getKeyName()
    {
        return $this->keyName;
    }

    /**
     * Set content.
     *
     * @param string|null $richContent
     *
     * @return Block
     */
    public function setRichContent($richContent = null)
    {
        $this->richContent = $richContent;

        return $this;
    }

    /**
     * Get content.
     *
     * @return string|null
     */
    public function getRichContent()
    {
        return $this->richContent;
    }

}
