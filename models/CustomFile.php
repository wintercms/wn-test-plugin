<?php namespace Winter\Test\Models;

use File as FileHelper;
use Request;
use System\Models\File as FileBase;

/**
 * This file model saves files to storage/temp/test-plugin-custom-files
 * It also does not use partition directories.
 */
class CustomFile extends FileBase
{
    protected function getPartitionDirectory(): string
    {
        return '/';
    }

    protected function getLocalRootPath(): string
    {
        return storage_path();
    }

    public function getStorageDirectory(): string
    {
        return 'temp/test-plugin-custom-files';
    }

    public function getPublicPath(): string
    {
        $uploadsPath = '/storage/temp/test-plugin-custom-files';

        return Request::getBasePath() . $uploadsPath;
    }

    protected function isLocalStorage(): bool
    {
        return true;
    }
}
