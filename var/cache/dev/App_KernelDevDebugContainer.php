<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerOGjf4UU\App_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerOGjf4UU/App_KernelDevDebugContainer.php') {
    touch(__DIR__.'/ContainerOGjf4UU.legacy');

    return;
}

if (!\class_exists(App_KernelDevDebugContainer::class, false)) {
    \class_alias(\ContainerOGjf4UU\App_KernelDevDebugContainer::class, App_KernelDevDebugContainer::class, false);
}

return new \ContainerOGjf4UU\App_KernelDevDebugContainer([
    'container.build_hash' => 'OGjf4UU',
    'container.build_id' => '3ceefd31',
    'container.build_time' => 1687383102,
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerOGjf4UU');
