<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerPRE6xqc\App_KernelTestDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerPRE6xqc/App_KernelTestDebugContainer.php') {
    touch(__DIR__.'/ContainerPRE6xqc.legacy');

    return;
}

if (!\class_exists(App_KernelTestDebugContainer::class, false)) {
    \class_alias(\ContainerPRE6xqc\App_KernelTestDebugContainer::class, App_KernelTestDebugContainer::class, false);
}

return new \ContainerPRE6xqc\App_KernelTestDebugContainer([
    'container.build_hash' => 'PRE6xqc',
    'container.build_id' => '92a31c3e',
    'container.build_time' => 1689111191,
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerPRE6xqc');
