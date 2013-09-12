<?php


namespace Guestbook\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class GuestBookMessageController extends AbstractActionController{

    protected  $guestBookMessageTable;

    public function getGuestBookMessageTable()
    {
        if (!$this->guestBookMessageTable) {
            $sm = $this->getServiceLocator();
            $this->guestBookMessageTable = $sm->get('Guestbook\Model\GuestBookMessageTable');
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