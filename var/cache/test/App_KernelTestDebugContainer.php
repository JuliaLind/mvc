<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerMw4t6jw\App_KernelTestDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerMw4t6jw/App_KernelTestDebugContainer.php') {
    touch(__DIR__.'/ContainerMw4t6jw.legacy');

    return;
}

if (!\class_exists(App_KernelTestDebugContainer::class, false)) {
    \class_alias(\ContainerMw4t6jw\App_KernelTestDebugContainer::class, App_KernelTestDebugContainer::class, false);
}

return new \ContainerMw4t6jw\App_KernelTestDebugContainer([
    'container.build_hash' => 'Mw4t6jw',
    'container.build_id' => '423d5771',
    'container.build_time' => 1687222806,
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerMw4t6jw');
