<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerUKSM8LD\App_KernelTestDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerUKSM8LD/App_KernelTestDebugContainer.php') {
    touch(__DIR__.'/ContainerUKSM8LD.legacy');

    return;
}

if (!\class_exists(App_KernelTestDebugContainer::class, false)) {
    \class_alias(\ContainerUKSM8LD\App_KernelTestDebugContainer::class, App_KernelTestDebugContainer::class, false);
}

return new \ContainerUKSM8LD\App_KernelTestDebugContainer([
    'container.build_hash' => 'UKSM8LD',
    'container.build_id' => '183904df',
    'container.build_time' => 1688675850,
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerUKSM8LD');
