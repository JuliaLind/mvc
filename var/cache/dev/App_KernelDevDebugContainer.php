<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerGnLZYAj\App_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerGnLZYAj/App_KernelDevDebugContainer.php') {
    touch(__DIR__.'/ContainerGnLZYAj.legacy');

    return;
}

if (!\class_exists(App_KernelDevDebugContainer::class, false)) {
    \class_alias(\ContainerGnLZYAj\App_KernelDevDebugContainer::class, App_KernelDevDebugContainer::class, false);
}

return new \ContainerGnLZYAj\App_KernelDevDebugContainer([
    'container.build_hash' => 'GnLZYAj',
    'container.build_id' => '5ab1e750',
    'container.build_time' => 1689025601,
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerGnLZYAj');
