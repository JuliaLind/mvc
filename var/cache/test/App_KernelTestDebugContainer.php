<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerVh5opRH\App_KernelTestDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerVh5opRH/App_KernelTestDebugContainer.php') {
    touch(__DIR__.'/ContainerVh5opRH.legacy');

    return;
}

if (!\class_exists(App_KernelTestDebugContainer::class, false)) {
    \class_alias(\ContainerVh5opRH\App_KernelTestDebugContainer::class, App_KernelTestDebugContainer::class, false);
}

return new \ContainerVh5opRH\App_KernelTestDebugContainer([
    'container.build_hash' => 'Vh5opRH',
    'container.build_id' => '24014335',
    'container.build_time' => 1687477867,
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerVh5opRH');
