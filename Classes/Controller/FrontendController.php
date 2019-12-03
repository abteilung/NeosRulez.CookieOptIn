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
        $cookieName = 'NeosRulezCookieOptIn';
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
    }

    /**
     * @return void
     */
    public function setSelectedCookiesAction()
    {
        $cookieGroupArray = $this->request->getArgument('cookieGroupArray');
        $cookieName = 'NeosRulezCookieOptIn';
        $cookieValue = $cookieGroupArray;
        setcookie($cookieName, $cookieValue, time() + (86400 * 30), "/");
        $this->redirectToUri('/');
    }

    /**
     * @return void
     */
    public function setEssentialCookiesAction()
    {
        $cookieName = 'NeosRulezCookieOptIn';
        $cookieValue = 'essential';
        setcookie($cookieName, $cookieValue, time() + (86400 * 30), "/");
        $this->redirectToUri('/');
    }

    /**
     * @return void
     */
    public function setAllCookiesAction()
    {
        $cookieName = 'NeosRulezCookieOptIn';
        $cookieValue = 'all';
        setcookie($cookieName, $cookieValue, time() + (86400 * 30), "/");
        $this->redirectToUri('/');
    }

    /**
     * @return void
     */
    public function revokeCookiesAction()
    {
        $cookieName = 'NeosRulezCookieOptIn';
        $cookieValue = 'revoked';
        setcookie($cookieName, $cookieValue, time() + (86400 * 30), "/");
        $this->redirectToUri('/');
    }


}
