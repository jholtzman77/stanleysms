<?php
namespace Magesales\Shippingrules\Block\Adminhtml\Rule;
use Magento\Backend\Block\Widget\Context as Context;
use Magento\Backend\Block\Widget\Grid\Extended;
use Magento\Backend\Helper\Data as BackendHelper;

class Grid extends Extended
{
	protected $_methodCollection;
	protected $_helper;

    public function __construct(
        \Magesales\Shippingrules\Model\Resource\Rule\CollectionFactory $methodCollection,
		\Magesales\Shippingrules\Helper\Data $helper,
        Context $context,
		BackendHelper $backendHelper		
    ) {
        $this->_methodCollection = $methodCollection;
		$this->_helper = $helper;

        parent::__construct($context, $backendHelper);
    }
  
  	public function _construct()
  	{
		parent::_construct();
      	$this->setId('methodGrid');
      	$this->setDefaultSort('pos');
  	}

  	protected function _prepareCollection()
  	{
      	$collection = $this->_methodCollection->create();
      	$this->setCollection($collection);
      	return parent::_prepareCollection();
  	}

  	protected function _prepareColumns()
  	{
    	$hlp =  $this->_helper;
    	$this->addColumn('rule_id', [
     		'header'    => __('ID'),
      		'align'     => 'right',
      		'width'     => '50px',
      		'index'     => 'rule_id',
    	]);

		$this->addColumn('name', [
			'header'    => __('Rule Name'),
			'index'     => 'name',
		]);
		
		$this->addColumn('methods', [
			'header'    => __('Shipping Methods'),
			'align'     => 'left',
			'width'     => '80px',
			'renderer'	=> '\Magesales\Shippingrules\Block\Adminhtml\Rule\Grid\Renderer\Methods',
			'index'     => 'methods',
		]);
		
		$this->addColumn('calc', [
			'header'    => __('Rate Calculation Type'),
			'index'     => 'calc',
			'type'      => 'options',
			'options'   => $hlp->getCalculations(),        
		]);
		
		$this->addColumn('rate_base', [
        'header'    => __('Shipping Rate per the Order'),
        'index'     => 'rate_base',
   		 ]);
    
		$this->addColumn('rate_fixed', [
			'header'    => __('Fixed Shipping Rate per Product'),
			'index'     => 'rate_fixed',
		]);
	
		$this->addColumn('rate_percent', [
			'header'    => __('Percentage Shipping Rate per Product'),
			'index'     => 'rate_percent',
		]);
		
		$this->addColumn('handling', [
			'header'    => __('Handling Shipping Rate in Percentage'),
			'index'     => 'handling',
		]);    
		
		$this->addColumn('pos', [
			'header'    => __('Priority'),
			'index'     => 'pos',
		]);    
		
		$this->addColumn('is_active', [
			'header'    => __('Status'),
			'align'     => 'left',
			'width'     => '80px',
			'renderer'	=> '\Magesales\Shippingrules\Block\Adminhtml\Rule\Grid\Renderer\Color',
			'index'     => 'is_active',
			'type'      => 'options',
			'options'   => $hlp->getStatuses(),
		]);    
		
		return parent::_prepareColumns();
  	}

	public function getRowUrl($row)
	{
		return $this->getUrl('magesales_shippingrules/rule/edit', ['id' => $row->getId()]);
	}
  
	protected function _prepareMassaction()
	{
	  	$this->setMassactionIdField('method_id');
	  	$this->getMassactionBlock()->setFormFieldName('methods');
	  
	  	$actions = [
			'massActivate'   => 'Activate',
		  	'massInactivate' => 'Inactivate',
		  	'massDelete'     => 'Delete',
	  	];
	  
	  	foreach ($actions as $code => $label){
		  	$this->getMassactionBlock()->addItem($code, [
			   'label'    => __($label),
			   'url'      => $this->getUrl('*/*/' . $code),
			   'confirm'  => ($code == 'massDelete' ? __('Are you sure?') : null),
		  	]);        
	  	}
	  	return $this; 
	}
}