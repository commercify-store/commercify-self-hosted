<?php

/*
    Commercify Self Hosted - An e-commerce framework
    Copyright (C) 2025 Erol Simsir

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program. If not, see <https://www.gnu.org/licenses/>.
*/

namespace App\Modules\Themes;

use App\Modules\Themes\Theme;
use Symfony\Component\Yaml\Yaml;

class ThemeManager
{
    private $themeConfig;

    public function __construct()
    {
        $this->themeConfig = $this->getThemesConfig();
    }

    public function getActiveTheme(): Theme
    {
        return new Theme(
            $this->themeConfig['active_theme']['name'],
            $this->themeConfig['active_theme']['version'],
            $this->themeConfig['active_theme']['path']
        );
    }

    public function getInstalledThemes(): array
    {
        return $this->themeConfig['installed_themes'];
    }

    private function getThemesConfig(): array
    {
        return Yaml::parseFile(__DIR__ . '/../../../../templates/themes/themes.yaml');
    }
}
