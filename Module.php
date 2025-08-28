<?php
namespace ZoteroImportplus;


if (!class_exists(\Common\TraitModule::class)) {
    require_once dirname(__DIR__) . '/Common/TraitModule.php';
}

use Laminas\EventManager\Event;
use Laminas\EventManager\SharedEventManagerInterface;
use Laminas\ServiceManager\ServiceLocatorInterface;
use Laminas\ModuleManager\ModuleManager;
use Common\TraitModule;
use Omeka\Module\AbstractModule;


class Module extends AbstractModule
{
    use TraitModule;
    const NAMESPACE = __NAMESPACE__;

    protected $dependencies = [
        'Common'
    ];


    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }


    protected function preInstall(): void
    {
        $services = $this->getServiceLocator();
        $translate = $services->get('ControllerPluginManager')->get('translate');
        $translator = $services->get('MvcTranslator');

        if (!method_exists($this, 'checkModuleActiveVersion') || !$this->checkModuleActiveVersion('Common', '3.4.66')) {
            $message = new \Omeka\Stdlib\Message(
                $translate('The module %1$s should be upgraded to version %2$s or later.'), // @translate
                'Common', '3.4.66'
            );
            throw new \Omeka\Module\Exception\ModuleCannotInstallException((string) $message);
        }

        $this->getManageModuleAndResources();
    }

    protected function postUninstall(): void
    {
        $services = $this->getServiceLocator();

        if (!class_exists(\Generic\InstallResources::class)) {
            require_once file_exists(dirname(__DIR__) . '/Generic/InstallResources.php')
                ? dirname(__DIR__) . '/Generic/InstallResources.php'
                : __DIR__ . '/src/Generic/InstallResources.php';
        }

        $installResources = new \Generic\InstallResources($services);
        $installResources = $installResources();

        //parent::uninstall($services);   

    }

    public function warnUninstall(Event $event): void
    {
        $view = $event->getTarget();
        $module = $view->vars()->module;
        if ($module->getId() != __NAMESPACE__) {
            return;
        }

        $serviceLocator = $this->getServiceLocator();
        $t = $serviceLocator->get('MvcTranslator');

        $html = '<p>';
        $html .= '<strong>';
        $html .= $t->translate('WARNING'); // @translate
        $html .= '</strong>' . ': ';
        $html .= '</p>';

        echo $html;
    }


    public function attachListeners(SharedEventManagerInterface $sharedEventManager)
    {
        $sharedEventManager->attach(
            \Omeka\Api\Adapter\ItemAdapter::class,
            'api.search.query',
            function (Event $event) {
                $query = $event->getParam('request')->getContent();
                if (isset($query['zotero_importplus_id'])) {
                    $qb = $event->getParam('queryBuilder');
                    $adapter = $event->getTarget();
                    $importItemAlias = $adapter->createAlias();
                    $qb->innerJoin(
                        \ZoteroImportPlus\Entity\ZoteroImportPlusItem::class, $importItemAlias,
                        'WITH', "$importItemAlias.item = omeka_root.id"
                    )->andWhere($qb->expr()->eq(
                        "$importItemAlias.import",
                        $adapter->createNamedParameter($qb, $query['zotero_importplus_id'])
                    ));
                }
            }
        );

        // Display a warn before uninstalling.
        $sharedEventManager->attach(
            'Omeka\Controller\Admin\Module',
            'view.details',
            [$this, 'warnUninstall']
        );


    }

}
