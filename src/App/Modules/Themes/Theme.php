<?php declare(strict_types=1);

namespace App\Modules\Themes;

class Theme
{
    private $name;

    private $version;

    private $path;

    public function __construct(string $name, string $version, string $path) {
        $this->name = $name;
        $this->version = $version;
        $this->path = $path;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getVersion(): string {
        return $this->version;
    }

    public function getPath(): string {
        return $this->path;
    }
}
