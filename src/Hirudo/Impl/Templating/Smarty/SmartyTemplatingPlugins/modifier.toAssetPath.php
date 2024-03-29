<?php

/**
 * «Copyright 2012 Jeysson José Guevara Mendivil(JeyDotC)» 
 * 
 * This file is part of Hirudo.
 * 
 * Hirudo is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * 
 * Hirudo is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with Hirudo.  If not, see <http://www.gnu.org/licenses/>.
 */
use Hirudo\Lang\Loader;
use Hirudo\Core\Context\ModulesContext;

/**
 * <p>Converts the given string into a valid absolute path like smarty_modifier_toPath
 * plugin, but in this time the path has only three parts, the application, the 
 * module and the view name, so any view from any module can be included or inherited.
 *  
 * @param string $string The complete name of the view with format AppName::ModuleName::viewName
 * 
 * @return string The resulting path.
 * 
 * @see Loader::using() For details about the string format required by this 
 * method.
 * 
 * @throws InvalidPathException If $string is not a string, is null or is empty.
 * @throws LogicException If $extension is not a string.
 */
function smarty_modifier_toAssetPath($string) {

    if (strpos($string, "::") !== false) {
        $parts = explode("::", $string);
        $src = ModulesContext::instance()->getConfig()->get("businessRoot", "src");
        $base = trim(str_replace("::", "/", $src), "/");
        $result = "$base/$parts[0]/assets/$parts[1]";
    } else {
        $result = "assets/$result";
    }

    $resultingPath = Loader::toSinglePath($result, ".tpl");

    return $resultingPath;
}

?>