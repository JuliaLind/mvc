<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerMXHHn9e\App_KernelTestDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerMXHHn9e/App_KernelTestDebugContainer.php') {
    touch(__DIR__.'/ContainerMXHHn9e.legacy');

    return;
}

if (!\class_exists(App_KernelTestDebugContainer::class, false)) {
    \class_alias(\ContainerMXHHn9e\App_KernelTestDebugContainer::class, App_KernelTestDebugContainer::class, false);
}

return new \ContainerMXHHn9e\App_KernelTestDebugContainer([
    'container.build_hash' => 'MXHHn9e',
    'container.build_id' => '17d80e51',
    'container.build_time' => 1688742448,
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerMXHHn9e');
