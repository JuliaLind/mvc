<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerJoDRMFO\App_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerJoDRMFO/App_KernelDevDebugContainer.php') {
    touch(__DIR__.'/ContainerJoDRMFO.legacy');

    return;
}

if (!\class_exists(App_KernelDevDebugContainer::class, false)) {
    \class_alias(\ContainerJoDRMFO\App_KernelDevDebugContainer::class, App_KernelDevDebugContainer::class, false);
}

return new \ContainerJoDRMFO\App_KernelDevDebugContainer([
    'container.build_hash' => 'JoDRMFO',
    'container.build_id' => '03d04801',
    'container.build_time' => 1686704582,
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerJoDRMFO');
