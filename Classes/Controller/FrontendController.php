<?php
namespace NeosRulez\CookieOptIn\Controller;

/*
 * This file is part of the NeosRulez.CookieOptIn package.
 */

use Neos\Flow\Annotations as Flow;
use Neos\Flow\Mvc\Controller\ActionController;

class FrontendController extends ActionController
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


}
