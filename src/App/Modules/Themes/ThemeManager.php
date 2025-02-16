<?php declare(strict_types=1);

namespace App\Modules\Themes;

use App\Modules\Themes\Theme;

class ThemeManager
{
    private $themeConfig;

    /**
     * @param array $themeConfig
     */
    public function __construct(array $themeConfig) {
        $this->themeConfig = $themeConfig;
    }

    /**
     * @return Theme
     */
    public function getActiveTheme(): Theme {
        return new Theme(
            $this->themeConfig['active_theme']['name'],
            $this->themeConfig['active_theme']['version'],
            $this->themeConfig['active_theme']['path']
        );
    }

    /**
     * @return array
     */
    public function getInstalledThemes(): array {
        return $this->themeConfig['installed_themes'];
    }
}
