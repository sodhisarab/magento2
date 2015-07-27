<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Magento\Framework\View\Element\UiComponent\DataProvider;

use Magento\Framework\Model\Resource\Db\Collection\AbstractCollection;
use Magento\Framework\ObjectManagerInterface;

/**
 * Class CollectionPool
 */
class CollectionFactory
{
    /**
     * @var AbstractCollection[]
     */
    protected $collections;

    /**
     * @var ObjectManagerInterface
     */
    protected $objectManager;

    public function __construct(
        ObjectManagerInterface $objectManagerInterface,
        array $collections  = []
    ) {
        $this->collections = $collections;
        $this->objectManager = $objectManagerInterface;
    }

    /**
     * @param $requestName
     * @return AbstractCollection
     * @throws \Exception
     */
    public function getReport($requestName)
    {
        if (!isset($this->collections[$requestName])) {
            throw new \Exception(sprintf('Not registered handle %s', $requestName));
        }
        return $this->objectManager->create($this->collections[$requestName]);
    }
}
