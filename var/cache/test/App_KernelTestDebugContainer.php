<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerOmA0t2u\App_KernelTestDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerOmA0t2u/App_KernelTestDebugContainer.php') {
    touch(__DIR__.'/ContainerOmA0t2u.legacy');

    return;
}

if (!\class_exists(App_KernelTestDebugContainer::class, false)) {
    \class_alias(\ContainerOmA0t2u\App_KernelTestDebugContainer::class, App_KernelTestDebugContainer::class, false);
}

return new \ContainerOmA0t2u\App_KernelTestDebugContainer([
    'container.build_hash' => 'OmA0t2u',
    'container.build_id' => '3af1635f',
    'container.build_time' => 1688320178,
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerOmA0t2u');
