<?php


namespace Application\Model;


class GuestbookMessage
{

    protected $id;
    protected $email;
    protected $created;
    protected $comment;


    public function exchangeArray($data) {
        $this->id = (!empty($data['id'])) ? $data['id'] : null;
        $this->email = (!empty($data['email'])) ? $data['email'] : null;
        $this->created = (!empty($data['created'])) ? $data['created'] : null;
        $this->comment = (!empty($data['comment'])) ? $data['comment'] : null;
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @return mixed
     */
    public function getComment()
    {
        return $this->comment;
    }

}
