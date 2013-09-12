<?php


namespace Application\Controller;


class GuestBookMessageController {

    protected  $guestBookMessageTable;

    public function getGuestBookMessageTable()
    {
        if (!$this->guestBookMessageTable) {
            $sm = $this->getServiceLocator();
            $this->guestBookMessageTable = $sm->get('Album\Model\GuestBookMessageTable');
        }
        return $this->guestBookMessageTable;
    }

    public function indexAction()
    {
        return new ViewModel(array(
            'gbMessages' => $this->getGuestBookMessageTable()->fetchAll(),
        ));
    }
}