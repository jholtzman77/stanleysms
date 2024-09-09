<?php

use Magento\Framework\App\Bootstrap;
require __DIR__ . '/app/bootstrap.php';

$bootstrap = Bootstrap::create(BP, $_SERVER);

$obj = $bootstrap->getObjectManager();

$state = $obj->get('Magento\Framework\App\State');
$state->setAreaCode('frontend');


######################################################################################################################

/**
 * @var \Magento\Framework\Encryption\EncryptorInterfaceFactory $ef
 */
$ef = $obj->get('Magento\Framework\Encryption\EncryptorInterfaceFactory');

class CustomDeploymentConfig extends \Magento\Framework\App\DeploymentConfig {
    public function get($key = null, $defaultValue = null)
    {
        return '8343d1c27ee612c73131c0ec693ed86e';
    }
}

/**
 * @var CustomDeploymentConfig $d
 */
$d = $obj->get(CustomDeploymentConfig::class);

/**
 * @var \Magento\Framework\Encryption\EncryptorInterface $e
 */
$e = $ef->create(['deploymentConfig' => $d]);

echo ">>>", $e->decrypt('carriers/ups/username'), "<<<\n";
