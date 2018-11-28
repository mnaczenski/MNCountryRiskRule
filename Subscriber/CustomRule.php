<?php

namespace MNCountryRiskRule\Subscriber;

use Enlight\Event\SubscriberInterface;
use Enlight_Event_EventArgs;
use Symfony\Component\DependencyInjection\ContainerInterface;


class CustomRule implements SubscriberInterface
{

    /**
     * @var ContainerInterface
     */

    private $container;


    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }


    public static function getSubscribedEvents()
    {
        return [
            'Shopware_Modules_Admin_Execute_Risk_Rule_sRiskMNCountryRiskRule' => 'onMNCountryRiskRule'
        ];
    }

    /**
     * @param Enlight_Event_EventArgs $args
     * @return bool
     */
    public function onMNCountryRiskRule(Enlight_Event_EventArgs $args)
    {
        $user   = $args->get('user');
        $config = $this->container->get('config')->getByNamespace('MNCountryRiskRule','riskcountryselection');

        if(in_array($user['additional']['country']['id'],$config)) {
            return true;
        }
        
        return false;
    }
}
