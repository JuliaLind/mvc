<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerCAelyvy\App_KernelTestDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerCAelyvy/App_KernelTestDebugContainer.php') {
    touch(__DIR__.'/ContainerCAelyvy.legacy');

    return;
}

if (!\class_exists(App_KernelTestDebugContainer::class, false)) {
    \class_alias(\ContainerCAelyvy\App_KernelTestDebugContainer::class, App_KernelTestDebugContainer::class, false);
}

return new \ContainerCAelyvy\App_KernelTestDebugContainer([
    'container.build_hash' => 'CAelyvy',
    'container.build_id' => '090a3159',
    'container.build_time' => 1688169835,
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerCAelyvy');
