<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerNb9JtEI\App_KernelTestDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerNb9JtEI/App_KernelTestDebugContainer.php') {
    touch(__DIR__.'/ContainerNb9JtEI.legacy');

    return;
}

if (!\class_exists(App_KernelTestDebugContainer::class, false)) {
    \class_alias(\ContainerNb9JtEI\App_KernelTestDebugContainer::class, App_KernelTestDebugContainer::class, false);
}

return new \ContainerNb9JtEI\App_KernelTestDebugContainer([
    'container.build_hash' => 'Nb9JtEI',
    'container.build_id' => '5ddf4b72',
    'container.build_time' => 1687782445,
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerNb9JtEI');
