<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerMIPtlAp\App_KernelTestDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerMIPtlAp/App_KernelTestDebugContainer.php') {
    touch(__DIR__.'/ContainerMIPtlAp.legacy');

    return;
}

if (!\class_exists(App_KernelTestDebugContainer::class, false)) {
    \class_alias(\ContainerMIPtlAp\App_KernelTestDebugContainer::class, App_KernelTestDebugContainer::class, false);
}

return new \ContainerMIPtlAp\App_KernelTestDebugContainer([
    'container.build_hash' => 'MIPtlAp',
    'container.build_id' => '0a2fc7cc',
    'container.build_time' => 1690898846,
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerMIPtlAp');
