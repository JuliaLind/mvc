<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerNyHsSS2\App_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerNyHsSS2/App_KernelDevDebugContainer.php') {
    touch(__DIR__.'/ContainerNyHsSS2.legacy');

    return;
}

if (!\class_exists(App_KernelDevDebugContainer::class, false)) {
    \class_alias(\ContainerNyHsSS2\App_KernelDevDebugContainer::class, App_KernelDevDebugContainer::class, false);
}

return new \ContainerNyHsSS2\App_KernelDevDebugContainer([
    'container.build_hash' => 'NyHsSS2',
    'container.build_id' => '2310e2a7',
    'container.build_time' => 1689226063,
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerNyHsSS2');
