<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerNfmpGat\App_KernelTestDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerNfmpGat/App_KernelTestDebugContainer.php') {
    touch(__DIR__.'/ContainerNfmpGat.legacy');

    return;
}

if (!\class_exists(App_KernelTestDebugContainer::class, false)) {
    \class_alias(\ContainerNfmpGat\App_KernelTestDebugContainer::class, App_KernelTestDebugContainer::class, false);
}

return new \ContainerNfmpGat\App_KernelTestDebugContainer([
    'container.build_hash' => 'NfmpGat',
    'container.build_id' => '34cd5a51',
    'container.build_time' => 1686430324,
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerNfmpGat');
