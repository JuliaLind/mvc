<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\Container4RoP6bZ\App_KernelTestDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/Container4RoP6bZ/App_KernelTestDebugContainer.php') {
    touch(__DIR__.'/Container4RoP6bZ.legacy');

    return;
}

if (!\class_exists(App_KernelTestDebugContainer::class, false)) {
    \class_alias(\Container4RoP6bZ\App_KernelTestDebugContainer::class, App_KernelTestDebugContainer::class, false);
}

return new \Container4RoP6bZ\App_KernelTestDebugContainer([
    'container.build_hash' => '4RoP6bZ',
    'container.build_id' => 'eadfbea8',
    'container.build_time' => 1687385777,
], __DIR__.\DIRECTORY_SEPARATOR.'Container4RoP6bZ');
