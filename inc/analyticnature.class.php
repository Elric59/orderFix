<?php

/**
 * -------------------------------------------------------------------------
 * Order plugin for GLPI
 * -------------------------------------------------------------------------
 *
 * LICENSE
 *
 * This file is part of Order.
 *
 * Order is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * Order is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Order. If not, see <http://www.gnu.org/licenses/>.
 * -------------------------------------------------------------------------
 * @copyright Copyright (C) 2009-2022 by Order plugin team.
 * @license   GPLv3 https://www.gnu.org/licenses/gpl-3.0.html
 * @link      https://github.com/pluginsGLPI/order
 * -------------------------------------------------------------------------
 */

if (!defined('GLPI_ROOT')) {
   die("Sorry. You can't access directly to this file");
}

class PluginOrderAnalyticNature extends CommonDropdown {

   public static $rightname   = 'plugin_order_orders_item';

   public static function getTypeName($nb = 0) {

      return __("Analytic nature", "order");
   }

   public static function canCreate() {

      return true;
   }

   public static function canPurge() {

      return true;
   }

   public static function canDelete() {

      return true;
   }

   public static function canUpdate() {

      return true;
   }

   public static function canView() {

      return true;
   }

   public static function install(Migration $migration) {

      global $DB;

      $table = getTableForItemType(__CLASS__);
      if (!$DB->tableExists($table)) {
         $migration->displayMessage("Installing $table");
         $query ="CREATE TABLE IF NOT EXISTS `glpi_plugin_order_analyticnatures` (
                    `id` int(11) NOT NULL AUTO_INCREMENT,
                    `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
                    `comment` text COLLATE utf8_unicode_ci,
                    PRIMARY KEY (`id`),
                    KEY `name` (`name`)
                  ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ;";
         $DB->query($query) or die ($DB->error());
      }
   }

   public static function uninstall() {

      global $DB;

      $DB->query("DROP TABLE IF EXISTS `" . getTableForItemType(__CLASS__) . "`") or die ($DB->error());
   }
}
