<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerLxJcQTc\App_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerLxJcQTc/App_KernelDevDebugContainer.php') {
    touch(__DIR__.'/ContainerLxJcQTc.legacy');

    return;
}

if (!\class_exists(App_KernelDevDebugContainer::class, false)) {
    \class_alias(\ContainerLxJcQTc\App_KernelDevDebugContainer::class, App_KernelDevDebugContainer::class, false);
}

return new \ContainerLxJcQTc\App_KernelDevDebugContainer([
    'container.build_hash' => 'LxJcQTc',
    'container.build_id' => '29097f26',
    'container.build_time' => 1685896886,
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerLxJcQTc');
