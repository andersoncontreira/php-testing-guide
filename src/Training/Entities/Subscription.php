<?php


namespace Training\Entities;

use Training\Utils\ObjectUtil;

/**
 * Class Subscription
 *
 * @package Training\Entities
 */
class Subscription implements \JsonSerializable
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * Hash unico para a entidade
     * @var string
     */
    protected $uuid;

    /**
     * Nome da pessoa ou empresa
     * @var string
     */
    protected $name;

    /**
     * @var
     */
    protected $locale;

    /**
     * Número do documento
     * @var string
     */
    protected $document;

    /**
     * CPF ou CNPJ
     * @var string
     */
    protected $documentType;

    /**
     * @var string
     */
    protected $email;

    /**
     * @var string
     */
    protected $password;

    /**
     * @var \Training\VOs\Address
     */
    protected $address;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getUuid()
    {
        return $this->uuid;
    }

    /**
     * @param string $uuid
     */
    public function setUuid($uuid)
    {
        $this->uuid = $uuid;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * @param mixed $locale
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;
    }

    /**
     * @return string
     */
    public function getDocument()
    {
        return $this->document;
    }

    /**
     * @param string $document
     */
    public function setDocument($document)
    {
        $this->document = $document;
    }

    /**
     * @return string
     */
    public function getDocumentType()
    {
        return $this->documentType;
    }

    /**
     * @param string $documentType
     */
    public function setDocumentType($documentType)
    {
        $this->documentType = $documentType;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return \Training\VOs\Address
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param \Training\VOs\Address $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * Method __toString
     *
     * @return string
     *
     */
    public function __toString()
    {
        return sprintf("%s - %s",$this->id,$this->name);
    }

    /**
     * Method toArray
     *
     * @return array
     *
     */
    public function toArray()
    {
        return ObjectUtil::toArray($this);

    }

    /**
     * Method toJson
     *
     * @return string
     *
     */
    public function toJson()
    {
        return ObjectUtil::toJson($this);
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return ObjectUtil::toJson($this);
    }
}