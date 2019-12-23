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
     * @var array
     */
    protected $settings;

    /**
     * @param array $settings
     * @return void
     */
    public function injectSettings(array $settings) {
        $this->settings = $settings;
    }

    /**
     * @return void
     */
    public function indexAction()
    {
        $this->view->assign('cookies', $this->cookieRepository->findAll());
        $this->view->assign('cookieGroups', $this->cookieGroupRepository->findAll());
        $position = $this->request->getInternalArgument('__position');
        $cookieName = 'nrco';
        if(isset($_COOKIE[$cookieName])) {
            $cookieValue = $_COOKIE[$cookieName];
            $cookieArray = array();
            if($cookieValue=='essential') {
                $cookieGroupArray = $this->cookieGroupRepository->findEssentialCookieGroups();
                foreach ($cookieGroupArray as $cookieGroup) {
                    $cookies = $this->cookieRepository->findByCookieGroup($cookieGroup);
                    while ($cookie = $cookies->current()) {
                        if($position==1) {
                            $output = $cookie->getInhead();
                        } else {
                            $output = $cookie->getInfooter();
                        }
                        array_push($cookieArray, $output);
                        $cookies->next();
                    }
                }
            } else if ($cookieValue=='all') {
                $cookies = $this->cookieRepository->findAll();
                while ($cookie = $cookies->current()) {
                    if ($position == 1) {
                        $output = $cookie->getInhead();
                    } else {
                        $output = $cookie->getInfooter();
                    }
                    array_push($cookieArray, $output);
                    $cookies->next();
                }
            } else {
                $cookieValue = str_replace('%2C', ',', $cookieValue);
                $cookieGroupArray = explode(",", $cookieValue);
                foreach ($cookieGroupArray as $cookieGroup) {
                    $cookies = $this->cookieRepository->findByCookieGroup($cookieGroup);
                    while ($cookie = $cookies->current()) {
                        if($position==1) {
                            $output = $cookie->getInhead();
                        } else {
                            $output = $cookie->getInfooter();
                        }
                        array_push($cookieArray, $output);
                        $cookies->next();
                    }
                }
            }
            if ($cookieValue!='revoked') {
                $this->view->assign('cookieArray', $cookieArray);
                $this->view->assign('noModal', 1);
            }

            if($position!=1) {
                $revoke = $this->settings['revoke'];
                $this->view->assign('revoke', $revoke);
            }

        }
        $this->view->assign('position',$position);

        $impressNode = $this->request->getInternalArgument('__impressNode');
        $privacyNode = $this->request->getInternalArgument('__privacyNode');
        $this->view->assign('impressNode', $impressNode);
        $this->view->assign('privacyNode', $privacyNode);

        $docNode = $this->request->getInternalArgument('__docNode');
        $exclude = 0;
        $excludeNodes = $this->settings['excludeNodes'];
        $excludeNodes = explode(",", $excludeNodes);
        foreach ($excludeNodes as $excludeNode) {
            if($docNode==$excludeNode) {
                $exclude = $exclude+1;
            }
        }
        if($exclude!=0) {
            $this->view->assign('noModal', 1);
        }
    }

    /**
     * @return void
     */
    public function setSelectedCookiesAction()
    {
        $cookieGroupArray = $this->request->getArgument('cookieGroupArray');
        $cookieName = 'nrco';
        $cookieValue = $cookieGroupArray;
        if($cookieGroupArray=='') {
            setcookie($cookieName, 'essential', time() + (86400 * 30), "/");
        } else {
            setcookie($cookieName, $cookieValue, time() + (86400 * 30), "/");
        }
        $this->redirectToUri($_SERVER['HTTP_REFERER']);
    }

    /**
     * @return void
     */
    public function setEssentialCookiesAction()
    {
        $cookieName = 'nrco';
        $cookieValue = 'essential';
        setcookie($cookieName, $cookieValue, time() + (86400 * 30), "/");
        $this->redirectToUri($_SERVER['HTTP_REFERER']);
    }

    /**
     * @return void
     */
    public function setAllCookiesAction()
    {
        $cookieName = 'nrco';
        $cookieValue = 'all';
        setcookie($cookieName, $cookieValue, time() + (86400 * 30), "/");
        $this->redirectToUri($_SERVER['HTTP_REFERER']);
    }

    /**
     * @return void
     */
    public function revokeCookiesAction()
    {
        $cookieName = 'nrco';
        $cookieValue = 'revoked';
        setcookie($cookieName, $cookieValue, time() + (86400 * 30), "/");
        $this->redirectToUri($_SERVER['HTTP_REFERER']);
    }


}
