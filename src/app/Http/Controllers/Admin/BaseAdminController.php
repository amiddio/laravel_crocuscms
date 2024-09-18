<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Psr\SimpleCache\InvalidArgumentException;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class BaseAdminController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * @param string $type
     * @param string $message
     * @return void
     */
    protected static function setAlert(string $type, string $message): void
    {
        request()->session()->flash('type', $type);
        request()->session()->flash('message', $message);
    }

    /**
     * @param string $command
     * @return string
     */
    protected static function getShellCommandOutput(string $command): string
    {
        $process = Process::fromShellCommandline($command);
        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        return $process->getOutput();
    }

    /**
     * @param string|array $keys
     * @return bool|null
     * @throws InvalidArgumentException
     */
    protected static function cacheDelete(string|array $keys): ?bool
    {
        if (Arr::isList($keys)) {
            return Cache::deleteMultiple($keys);
        }

        if (is_string($keys)) {
            return Cache::delete($keys);
        }

        return null;
    }

    /**
     * @param string $prefix
     * @return array
     */
    protected static function getTranslationCacheKeys(string $prefix): array
    {
        $keys = [];

        foreach (config('translatable.locales') as $lang) {
            $keys[] = $prefix . '.' . $lang;
        }

        return $keys;
    }
}
