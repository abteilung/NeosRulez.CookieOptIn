<?php
namespace NeosRulez\CookieOptIn\Domain\Repository;

/*
 * This file is part of the NeosRulez.CookieOptIn package.
 */

use Neos\Flow\Annotations as Flow;
use Neos\Flow\Persistence\Repository;

/**
 * @Flow\Scope("singleton")
 */
class CookieRepository extends Repository {

    public function findByCookieGroup($identifier) {
        $class = '\NeosRulez\CookieOptIn\Domain\Model\Cookie';
        $query = $this->persistenceManager->createQueryForType($class);
        $result = $query->matching($query->equals('cookiegroup', $identifier))->execute();
        return $result;
    }
}
