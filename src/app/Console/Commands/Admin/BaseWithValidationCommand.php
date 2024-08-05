<?php

namespace App\Console\Commands\Admin;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;

abstract class BaseWithValidationCommand extends Command
{
    /**
     * @param string $question
     * @param string $field
     * @param bool $abort
     * @param bool $secret
     * @return string|null
     */
    protected function askValid(string $question, string $field, bool $abort = false, bool $secret = false): ?string
    {
        if (!$secret) {
            $value = $this->ask($question);
        } else {
            $value = $this->secret($question);
        }

        if ($message = $this->validateInput($field, $value)) {
            $this->error($message);
            if ($abort) {
                $this->newLine();
                exit;
            }
            return $this->askValid($question, $field, $abort, $secret);
        }

        return $value;
    }

    /**
     * @param $fieldName
     * @param $value
     * @return string|null
     */
    protected function validateInput($fieldName, $value): ?string
    {
        $validator = Validator::make(
            [$fieldName => $value],
            $this->rules(),
            $this->errorMessages()
        );

        return $validator->fails()
            ? $validator->errors()->first($fieldName)
            : null;
    }

    /**
     * @return array
     */
    abstract protected function rules(): array;

    /**
     * @return array
     */
    abstract protected function errorMessages(): array;

}
