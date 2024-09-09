namespace Cloud\Disablereg\Plugin;
use Magento\Customer\Model\Registration;
class RegistrationPlugin
{
    /**
     * @param Registration $subject
     */
    public function afterIsAllowed(Registration $subject)
    {
        return false;
    }
}