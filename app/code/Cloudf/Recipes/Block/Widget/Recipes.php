<?php

namespace Cloudf\Recipes\Block\Widget;

use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;

class Recipes extends Template implements BlockInterface
{

    protected $_template = "widget/recipes.phtml";

    protected $_pageRepositoryInterface;
/*
    public function findPages($searchCriteria = null) {
    
        $this->_pageRepositoryInterface = new \Magento\Cms\Api\PageRepositoryInterface();

        $searchCriteria = $this->_pageRepositoryInterface->objectManager->create('Magento\Framework\Api\SearchCriteriaInterface');

        $this->_pageRepositoryInterface->getList($searchCriteria);

    
    }
*/
}