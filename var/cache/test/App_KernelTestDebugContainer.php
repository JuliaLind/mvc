<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerAxbWcz4\App_KernelTestDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerAxbWcz4/App_KernelTestDebugContainer.php') {
    touch(__DIR__.'/ContainerAxbWcz4.legacy');

    return;
}

if (!\class_exists(App_KernelTestDebugContainer::class, false)) {
    \class_alias(\ContainerAxbWcz4\App_KernelTestDebugContainer::class, App_KernelTestDebugContainer::class, false);
}

return new \ContainerAxbWcz4\App_KernelTestDebugContainer([
    'container.build_hash' => 'AxbWcz4',
    'container.build_id' => 'bb0a4a65',
    'container.build_time' => 1685727833,
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerAxbWcz4');
