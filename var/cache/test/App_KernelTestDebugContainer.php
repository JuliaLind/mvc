<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerDzFLyy9\App_KernelTestDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerDzFLyy9/App_KernelTestDebugContainer.php') {
    touch(__DIR__.'/ContainerDzFLyy9.legacy');

    return;
}

if (!\class_exists(App_KernelTestDebugContainer::class, false)) {
    \class_alias(\ContainerDzFLyy9\App_KernelTestDebugContainer::class, App_KernelTestDebugContainer::class, false);
}

return new \ContainerDzFLyy9\App_KernelTestDebugContainer([
    'container.build_hash' => 'DzFLyy9',
    'container.build_id' => 'a94ceef3',
    'container.build_time' => 1686063760,
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerDzFLyy9');
