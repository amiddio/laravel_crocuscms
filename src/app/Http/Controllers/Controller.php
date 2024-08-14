<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class Controller extends BaseController
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
}
