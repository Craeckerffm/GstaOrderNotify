<?php declare(strict_types=1);

namespace GstaOrderNotify;

use Shopware\Core\Framework\Plugin;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class GstaOrderNotify extends Plugin
{
    public function build(ContainerBuilder $container): void
    {
        parent::build($container);
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__ . '/DependencyInjection/'));
        $loader->load('Sender.xml');
        $loader->load('MessageHandler.xml');
        $loader->load('Subscriber.xml');
        $loader->load('Util.xml');
    }
}
