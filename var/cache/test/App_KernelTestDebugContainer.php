<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerSE9Y3VT\App_KernelTestDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerSE9Y3VT/App_KernelTestDebugContainer.php') {
    touch(__DIR__.'/ContainerSE9Y3VT.legacy');

    return;
}

if (!\class_exists(App_KernelTestDebugContainer::class, false)) {
    \class_alias(\ContainerSE9Y3VT\App_KernelTestDebugContainer::class, App_KernelTestDebugContainer::class, false);
}

return new \ContainerSE9Y3VT\App_KernelTestDebugContainer([
    'container.build_hash' => 'SE9Y3VT',
    'container.build_id' => '1adcaf47',
    'container.build_time' => 1685748681,
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerSE9Y3VT');
