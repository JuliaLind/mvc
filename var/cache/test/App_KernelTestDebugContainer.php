<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerMTQXuGA\App_KernelTestDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerMTQXuGA/App_KernelTestDebugContainer.php') {
    touch(__DIR__.'/ContainerMTQXuGA.legacy');

    return;
}

if (!\class_exists(App_KernelTestDebugContainer::class, false)) {
    \class_alias(\ContainerMTQXuGA\App_KernelTestDebugContainer::class, App_KernelTestDebugContainer::class, false);
}

return new \ContainerMTQXuGA\App_KernelTestDebugContainer([
    'container.build_hash' => 'MTQXuGA',
    'container.build_id' => '04e08ae4',
    'container.build_time' => 1685659592,
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerMTQXuGA');
