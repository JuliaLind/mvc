<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerUtRm3Cc\App_KernelTestDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerUtRm3Cc/App_KernelTestDebugContainer.php') {
    touch(__DIR__.'/ContainerUtRm3Cc.legacy');

    return;
}

if (!\class_exists(App_KernelTestDebugContainer::class, false)) {
    \class_alias(\ContainerUtRm3Cc\App_KernelTestDebugContainer::class, App_KernelTestDebugContainer::class, false);
}

return new \ContainerUtRm3Cc\App_KernelTestDebugContainer([
    'container.build_hash' => 'UtRm3Cc',
    'container.build_id' => '876149c0',
    'container.build_time' => 1688342532,
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerUtRm3Cc');
