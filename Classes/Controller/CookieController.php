<?php
namespace NeosRulez\CookieOptIn\Controller;

/*
 * This file is part of the NeosRulez.CookieOptIn package.
 */

use Neos\Flow\Annotations as Flow;
use Neos\Flow\Mvc\Controller\ActionController;

class CookieController extends ActionController
{

    /**
     * @Flow\Inject
     * @var \NeosRulez\CookieOptIn\Domain\Repository\CookieRepository
     */
    protected $cookieRepository;

    /**
     * @Flow\Inject
     * @var \NeosRulez\CookieOptIn\Domain\Repository\CookieGroupRepository
     */
    protected $cookieGroupRepository;

    /**
     * @return void
     */
    public function indexAction()
    {
        $this->view->assign('cookies', $this->cookieRepository->findAll());
        $this->view->assign('cookieGroups', $this->cookieGroupRepository->findAll());
    }

    /**
     * @return void
     */
    public function newAction()
    {
        $this->view->assign('cookieGroups', $this->cookieGroupRepository->findAll());
    }

    /**
     * @param \NeosRulez\CookieOptIn\Domain\Model\Cookie $newCookie
     * @return void
     */
    public function createAction($newCookie)
    {
        $this->cookieRepository->add($newCookie);
        $this->redirect('index');
    }

    /**
     * @param \NeosRulez\CookieOptIn\Domain\Model\Cookie $cookie
     * @return void
     */
    public function editAction($cookie) {
        $this->view->assign('cookie', $cookie);
        $this->view->assign('cookieGroups', $this->cookieGroupRepository->findAll());
    }

    /**
     * @param \NeosRulez\CookieOptIn\Domain\Model\Cookie $cookie
     * @return void
     */
    public function updateAction($cookie) {
        $this->cookieRepository->update($cookie);
        $this->redirect('index','cookie');
    }

    /**
     * @param \NeosRulez\CookieOptIn\Domain\Model\Cookie $cookie
     * @return void
     */
    public function deleteAction($cookie) {
        $this->cookieRepository->remove($cookie);
        $this->redirect('index','cookie');
    }


}
