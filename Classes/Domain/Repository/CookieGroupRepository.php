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
class CookieGroupRepository extends Repository {

    public function findEssentialCookieGroups() {
        $class = '\NeosRulez\CookieOptIn\Domain\Model\CookieGroup';
        $query = $this->persistenceManager->createQueryForType($class);
        $result = $query->matching($query->equals('essential', 1))->execute();
        return $result;
    }

}
