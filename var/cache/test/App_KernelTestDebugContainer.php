<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerSpwB1vp\App_KernelTestDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerSpwB1vp/App_KernelTestDebugContainer.php') {
    touch(__DIR__.'/ContainerSpwB1vp.legacy');

    return;
}

if (!\class_exists(App_KernelTestDebugContainer::class, false)) {
    \class_alias(\ContainerSpwB1vp\App_KernelTestDebugContainer::class, App_KernelTestDebugContainer::class, false);
}

return new \ContainerSpwB1vp\App_KernelTestDebugContainer([
    'container.build_hash' => 'SpwB1vp',
    'container.build_id' => 'e9074d14',
    'container.build_time' => 1687556809,
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerSpwB1vp');
