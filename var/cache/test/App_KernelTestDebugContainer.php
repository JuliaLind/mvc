<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerVEfpesc\App_KernelTestDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerVEfpesc/App_KernelTestDebugContainer.php') {
    touch(__DIR__.'/ContainerVEfpesc.legacy');

    return;
}

if (!\class_exists(App_KernelTestDebugContainer::class, false)) {
    \class_alias(\ContainerVEfpesc\App_KernelTestDebugContainer::class, App_KernelTestDebugContainer::class, false);
}

return new \ContainerVEfpesc\App_KernelTestDebugContainer([
    'container.build_hash' => 'VEfpesc',
    'container.build_id' => 'f4970945',
    'container.build_time' => 1689083160,
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerVEfpesc');
