<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerXZHXk9b\App_KernelTestDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerXZHXk9b/App_KernelTestDebugContainer.php') {
    touch(__DIR__.'/ContainerXZHXk9b.legacy');

    return;
}

if (!\class_exists(App_KernelTestDebugContainer::class, false)) {
    \class_alias(\ContainerXZHXk9b\App_KernelTestDebugContainer::class, App_KernelTestDebugContainer::class, false);
}

return new \ContainerXZHXk9b\App_KernelTestDebugContainer([
    'container.build_hash' => 'XZHXk9b',
    'container.build_id' => '7499d747',
    'container.build_time' => 1687472127,
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerXZHXk9b');
