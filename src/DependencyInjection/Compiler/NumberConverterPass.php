<?php

declare(strict_types=1);

namespace App\DependencyInjection\Compiler;

use App\Service\NumberConverterContext;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class NumberConverterPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $service = $container->findDefinition(NumberConverterContext::class);

        $numSystemToIntServiceIds = array_keys($container->findTaggedServiceIds('num_system_to_int_strategy'));
        // Add an addStrategy call on the context for each strategy
        foreach ($numSystemToIntServiceIds as $id) {
            $service->addMethodCall('addNumSystemToIntStrategy', [new Reference($id)]);
        }


        $intToNumSystemServiceIds = array_keys($container->findTaggedServiceIds('int_to_num_system_strategy'));
        foreach ($intToNumSystemServiceIds as $id) {
            $service->addMethodCall('addIntToNumSystemConversionStrategy', [new Reference($id)]);
        }
    }
}
