<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\Container4wg75PT\App_KernelTestDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/Container4wg75PT/App_KernelTestDebugContainer.php') {
    touch(__DIR__.'/Container4wg75PT.legacy');

    return;
}

if (!\class_exists(App_KernelTestDebugContainer::class, false)) {
    \class_alias(\Container4wg75PT\App_KernelTestDebugContainer::class, App_KernelTestDebugContainer::class, false);
}

return new \Container4wg75PT\App_KernelTestDebugContainer([
    'container.build_hash' => '4wg75PT',
    'container.build_id' => 'c1c97baf',
    'container.build_time' => 1687790362,
], __DIR__.\DIRECTORY_SEPARATOR.'Container4wg75PT');
