<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerPTkpsj6\App_KernelTestDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerPTkpsj6/App_KernelTestDebugContainer.php') {
    touch(__DIR__.'/ContainerPTkpsj6.legacy');

    return;
}

if (!\class_exists(App_KernelTestDebugContainer::class, false)) {
    \class_alias(\ContainerPTkpsj6\App_KernelTestDebugContainer::class, App_KernelTestDebugContainer::class, false);
}

return new \ContainerPTkpsj6\App_KernelTestDebugContainer([
    'container.build_hash' => 'PTkpsj6',
    'container.build_id' => '02306575',
    'container.build_time' => 1685526312,
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerPTkpsj6');
