<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\Container9x5uKpe\App_KernelTestDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/Container9x5uKpe/App_KernelTestDebugContainer.php') {
    touch(__DIR__.'/Container9x5uKpe.legacy');

    return;
}

if (!\class_exists(App_KernelTestDebugContainer::class, false)) {
    \class_alias(\Container9x5uKpe\App_KernelTestDebugContainer::class, App_KernelTestDebugContainer::class, false);
}

return new \Container9x5uKpe\App_KernelTestDebugContainer([
    'container.build_hash' => '9x5uKpe',
    'container.build_id' => '9a90df47',
    'container.build_time' => 1689296601,
], __DIR__.\DIRECTORY_SEPARATOR.'Container9x5uKpe');
