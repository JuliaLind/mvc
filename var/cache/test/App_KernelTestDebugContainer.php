<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\Container7JxEGNH\App_KernelTestDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/Container7JxEGNH/App_KernelTestDebugContainer.php') {
    touch(__DIR__.'/Container7JxEGNH.legacy');

    return;
}

if (!\class_exists(App_KernelTestDebugContainer::class, false)) {
    \class_alias(\Container7JxEGNH\App_KernelTestDebugContainer::class, App_KernelTestDebugContainer::class, false);
}

return new \Container7JxEGNH\App_KernelTestDebugContainer([
    'container.build_hash' => '7JxEGNH',
    'container.build_id' => '74088966',
    'container.build_time' => 1687571637,
], __DIR__.\DIRECTORY_SEPARATOR.'Container7JxEGNH');
