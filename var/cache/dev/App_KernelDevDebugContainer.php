<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerLdsiIjz\App_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerLdsiIjz/App_KernelDevDebugContainer.php') {
    touch(__DIR__.'/ContainerLdsiIjz.legacy');

    return;
}

if (!\class_exists(App_KernelDevDebugContainer::class, false)) {
    \class_alias(\ContainerLdsiIjz\App_KernelDevDebugContainer::class, App_KernelDevDebugContainer::class, false);
}

return new \ContainerLdsiIjz\App_KernelDevDebugContainer([
    'container.build_hash' => 'LdsiIjz',
    'container.build_id' => '1b1d4565',
    'container.build_time' => 1687191611,
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerLdsiIjz');
