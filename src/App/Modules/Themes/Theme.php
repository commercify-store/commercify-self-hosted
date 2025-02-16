<?php declare(strict_types=1);

namespace App\Modules\Themes;

class Theme
{
    private $name;

    private $version;

    private $path;

    /**
     * @param string $name
     * @param string $version
     * @param string $path
     */
    public function __construct(string $name, string $version, string $path) {
        $this->name = $name;
        $this->version = $version;
        $this->path = $path;
    }

    /**
     * @return string
     */
    public function getName(): string {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getVersion(): string {
        return $this->version;
    }

    /**
     * @return string
     */
    public function getPath(): string {
        return $this->path;
    }
}
