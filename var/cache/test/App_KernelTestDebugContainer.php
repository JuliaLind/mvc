<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerYB7aiAH\App_KernelTestDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerYB7aiAH/App_KernelTestDebugContainer.php') {
    touch(__DIR__.'/ContainerYB7aiAH.legacy');

    return;
}

if (!\class_exists(App_KernelTestDebugContainer::class, false)) {
    \class_alias(\ContainerYB7aiAH\App_KernelTestDebugContainer::class, App_KernelTestDebugContainer::class, false);
}

return new \ContainerYB7aiAH\App_KernelTestDebugContainer([
    'container.build_hash' => 'YB7aiAH',
    'container.build_id' => 'db0c458e',
    'container.build_time' => 1687428124,
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerYB7aiAH');
