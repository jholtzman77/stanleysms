<?php

use Magento\Framework\App\Bootstrap;
require __DIR__ . '/app/bootstrap.php';

$bootstrap = Bootstrap::create(BP, $_SERVER);

$obj = $bootstrap->getObjectManager();

$state = $obj->get('Magento\Framework\App\State');
$state->setAreaCode('frontend');

protected $_encryptor;

public function __construct(
    \Magento\Framework\Encryption\EncryptorInterface $encryptor,
) {
    $this->_encryptor = $encryptor;
    parent::__construct($context);
}
$test = '0:3:ZYsiHKvAgpMyNF6ik/47vXlCtN/I+8iErjbrQEESWFBW+XZkjKEhhzLFSRg=';
$test = $this->_encryptor->decrypt($test);
echo $test;


######################################################################################################################


