<?php
/**
 * @category  Shopware
 * @package   Shopware\Plugins\SwagNewRelic
 * @copyright Copyright (c) shopware AG (http://www.shopware.de)
 */
class Shopware_Plugins_Frontend_SwagNewRelic_Bootstrap extends Shopware_Components_Plugin_Bootstrap
{
    public function install()
    {
        $this->subscribeEvent(
            'Enlight_Controller_Action_PostDispatch',
            'onPostDispatch'
        );
        return true;
    }

    public function onPostDispatch(Enlight_Controller_ActionEventArgs $args)
    {
        $action = $args->getSubject();
        $request = $action->Request();
        $response = $action->Response();

        if (!$request->isDispatched() || $response->isException()) {
            return;
        }

        if (extension_loaded('newrelic')) {
            newrelic_name_transaction($request->getModuleName() . '/' . $request->getControllerName() . '/' . $request->getActionName());

            $action->View()->addTemplateDir(__DIR__ . '/Views/');
        }
    }
}
