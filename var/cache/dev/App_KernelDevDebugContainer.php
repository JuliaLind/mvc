<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerS9Zu0CK\App_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerS9Zu0CK/App_KernelDevDebugContainer.php') {
    touch(__DIR__.'/ContainerS9Zu0CK.legacy');

    return;
}

if (!\class_exists(App_KernelDevDebugContainer::class, false)) {
    \class_alias(\ContainerS9Zu0CK\App_KernelDevDebugContainer::class, App_KernelDevDebugContainer::class, false);
}

return new \ContainerS9Zu0CK\App_KernelDevDebugContainer([
    'container.build_hash' => 'S9Zu0CK',
    'container.build_id' => 'c7405f0d',
    'container.build_time' => 1685494641,
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerS9Zu0CK');
