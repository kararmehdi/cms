<?php

namespace Custom\CMSBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;


/**
 * Document
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class Document
{
    
    /**
     * @var integer
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
     */
    private $name;
    
    /**
     * * @var string
     * 
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    public $path;
    
    /**
     * Set path
     *
     * @param string $path
     * @return Document
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string 
     */
    public function getPath()
    {
        return $this->path;
    }
    
    /**
     * Get web path to upload directory.
     * @return string
     *  Relative  path.
     */
    protected function getUploadPath()
    {
        // get rid of the __DIR__ so it doesn't screw up
        // when displaying uploaded doc/image in the view.
        return 'uploads/documents';
    }

    /**
     * Get absolute path to upload directory.
     * @return type
     *   Absolute path.
     */
    public function getUploadAbsolutePath()
    {
        return __DIR__ . '/../../../../web/' . $this->getUploadPath();
           
    }

    /**
     * 
     * @return null|string
     *   Relative path.
     */
    public function getWebPath()
    {
        return NULL === $this->getPath()
            ? NULL
            : $this->getUploadPath().'/'.$this->getPath();
    }

    /**
     * Get path on disk to a path.
     * 
     * @return null|string
     *    Absolute path.
     */
    public function getPathAbsolute(){
         return NULL === $this->getPath()
            ? NULL
            : $this->getUploadAbsolutePath().'/'.$this->getPath();
        
    }

    
    
    
    /**
     * @Assert\File(maxSize="6000000")
     */
    private $file;
    
    /**
     * Sets file.
     *
     * @param \Symfony\Component\HttpFoundation\File\UploadedFile $file
     */
    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;
    
    }
    
    
        /**
     * Get file.
     * 
     * @return UploadedFile
     */
    public function getFile() {
        return $this->file;
    }


    
    
   

  
    
    
    

    
  /**
     * Upload a cover file.
     */
    public function upload() {
        // File property can be empty.
        if (NULL === $this->getFile()) {
            return;
        }
        
        $filename = $this->getFile()->getClientOriginalName();
        
        // Move the uploaded file to target directory using original name.
        $this->getFile()->move(
                $this->getUploadAbsolutePath(),
                $filename);
        
        // Set the path.
        $this->setPath($filename);
        
        // Cleanup.
        $this->setFile();
    }

    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
        $file = $this->getUploadAbsolutePath();
        if (isset($this->file)) {
            unlink($this->file);
        }
    }
    
    /**
     * Set name
     *
     * @param string $name
     * @return Document
     */
     public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }
    
    /**
     * Set id
     *
     * @param string $id
     * @return Document
     */
     public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
    
    

}
