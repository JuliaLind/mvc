<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\Container1Ors3im\App_KernelTestDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/Container1Ors3im/App_KernelTestDebugContainer.php') {
    touch(__DIR__.'/Container1Ors3im.legacy');

    return;
}

if (!\class_exists(App_KernelTestDebugContainer::class, false)) {
    \class_alias(\Container1Ors3im\App_KernelTestDebugContainer::class, App_KernelTestDebugContainer::class, false);
}

return new \Container1Ors3im\App_KernelTestDebugContainer([
    'container.build_hash' => '1Ors3im',
    'container.build_id' => '80a28691',
    'container.build_time' => 1686132136,
], __DIR__.\DIRECTORY_SEPARATOR.'Container1Ors3im');
