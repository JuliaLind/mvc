<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerSav6Ddo\App_KernelTestDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerSav6Ddo/App_KernelTestDebugContainer.php') {
    touch(__DIR__.'/ContainerSav6Ddo.legacy');

    return;
}

if (!\class_exists(App_KernelTestDebugContainer::class, false)) {
    \class_alias(\ContainerSav6Ddo\App_KernelTestDebugContainer::class, App_KernelTestDebugContainer::class, false);
}

return new \ContainerSav6Ddo\App_KernelTestDebugContainer([
    'container.build_hash' => 'Sav6Ddo',
    'container.build_id' => '1495d69c',
    'container.build_time' => 1685833171,
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerSav6Ddo');
