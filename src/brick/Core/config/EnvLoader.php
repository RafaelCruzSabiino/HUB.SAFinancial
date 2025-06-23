<?php

namespace Hub\Financial\brick\Core\config;

use InvalidArgumentException;

class EnvLoader
{
    public function __construct(
        private string $filePath,
        private array $envVariables = [])
    {
        if (!file_exists($filePath)) 
        {
            throw new InvalidArgumentException("Arquivo .env não encontrado no caminho especificado: $filePath");
        }

        $this->load();
    }

    private function load(): void
    {
        $lines = file($this->filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        foreach ($lines as $line) 
        {
            $line = trim($line);

            if ($line === '' || str_starts_with($line, '#'))
            {
                continue;
            }

            [$key, $value] = array_pad(explode('=', $line, 2), 2, null);

            if ($key !== null && $value !== null)
            {
                $key = trim($key);
                $value = trim($value);

                if (
                    (str_starts_with($value, '"') && str_ends_with($value, '"')) ||
                    (str_starts_with($value, "'") && str_ends_with($value, "'"))
                ) 
                {
                    $value = substr($value, 1, -1);
                }

                putenv("{$key}={$value}");
                $_ENV[$key] = $value;
                $_SERVER[$key] = $value;
                $this->envVariables[$key] = $value;
            }
        }
    }

    public function get(string $key, mixed $default = null): mixed
    {
        return $this->envVariables[$key] ?? $default;
    }

    public function all(): array
    {
        return $this->envVariables;
    }
}