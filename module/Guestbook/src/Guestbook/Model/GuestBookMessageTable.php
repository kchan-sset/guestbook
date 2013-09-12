<?php


namespace Guestbook\Model;

use Zend\Db\TableGateway\TableGateway;

class GuestbookMessageTable {

    protected $tableGateway;

    public function __construct(TableGateway $gateWay)
    {
        $this->tableGateway = $gateWay;
    }

    public function fetchAll()
    {
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }

    public function getGuestBookMessage($id)
    {
        $rowset = $this->tableGateway->select(['id' => $id]);
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }

    public function saveGuestBookMessage(GuestbookMessage $guestBookMessage)
    {
        $data = [
            'email'     => $guestBookMessage->getEmail(),
            'created'   => $guestBookMessage->getCreated(),
            'comment'   => $guestBookMessage->getComment()
        ];

        $id = $guestBookMessage->getId();

        if(!$id) {
            $this->tableGateway->insert($data);
        }else {
            if($this->getGuestBookMessage($id)) {
                $this->tableGateway->update($data, ['id'=>$id]);
            } else {
                throw new \Exception("Message was not found");
            }
        }
    }

    public function deleteGuestBookMessage($id)
    {
        $this->tableGateway->delete(['id'=>$id]);
    }

}