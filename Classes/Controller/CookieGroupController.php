<?php
namespace NeosRulez\CookieOptIn\Controller;

/*
 * This file is part of the NeosRulez.CookieOptIn package.
 */

use Neos\Flow\Annotations as Flow;
use Neos\Flow\Mvc\Controller\ActionController;
use NeosRulez\Blog\Domain\Model\Category;

class CookieGroupController extends ActionController
{

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
        $this->view->assign('cookieGroups', $this->cookieGroupRepository->findAll());
    }

    /**
     * @return void
     */
    public function newAction()
    {

    }

    /**
     * @param \NeosRulez\CookieOptIn\Domain\Model\CookieGroup $newCookieGroup
     * @return void
     */
    public function createAction($newCookieGroup)
    {
        $this->cookieGroupRepository->add($newCookieGroup);
        $this->redirect('index');
    }


}
