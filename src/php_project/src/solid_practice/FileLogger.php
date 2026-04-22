<?php

namespace Calc\SolidPractice;

/**
 * FileLogger persists logs to the filesystem.
 */
class FileLogger implements ILogger
{
    public function log(string $message): void
    {
        file_put_contents('/tmp/calc.log', "[$message]\n", FILE_APPEND);
    }
}
