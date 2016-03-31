<?php
/**
 * Created by PhpStorm.
 * User: BENGEOS-PC
 * Date: 3/31/2016
 * Time: 5:47 AM
 */

namespace DeepLife_API\Model;


class Report
{
    protected $id;
    protected $category;
    protected $question;
    protected $created;

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
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param mixed $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }

    /**
     * @return mixed
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * @param mixed $question
     */
    public function setQuestion($question)
    {
        $this->question = $question;
    }

    /**
     * @return mixed
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param mixed $created
     */
    public function setCreated($created)
    {
        $this->created = $created;
    }
    public function getArray(){
        return array(
            'id' => $this->getId(),
            'category' => $this->getCategory(),
            'question' => $this->getQuestion(),
            'created' => $this->getCreated(),
        );
    }
}