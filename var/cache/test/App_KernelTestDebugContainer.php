<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerItHfqfJ\App_KernelTestDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerItHfqfJ/App_KernelTestDebugContainer.php') {
    touch(__DIR__.'/ContainerItHfqfJ.legacy');

    return;
}

if (!\class_exists(App_KernelTestDebugContainer::class, false)) {
    \class_alias(\ContainerItHfqfJ\App_KernelTestDebugContainer::class, App_KernelTestDebugContainer::class, false);
}

return new \ContainerItHfqfJ\App_KernelTestDebugContainer([
    'container.build_hash' => 'ItHfqfJ',
    'container.build_id' => '91c8df54',
    'container.build_time' => 1689234315,
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerItHfqfJ');
