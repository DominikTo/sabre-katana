<?php

/**
 * @license
 *
 * sabre/katana.
 * Copyright (C) 2015 fruux GmbH (https://fruux.com/)
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 */

namespace Sabre\Katana\Test\Unit\Server;

use Sabre\Katana\Test\Unit\Suite;
use Sabre\Katana\Server\Updater as CUT;

/**
 * Test suite of the updater.
 *
 * @copyright Copyright (C) 2015 fruux GmbH (https://fruux.com/).
 * @author Ivan Enderlin
 * @license GNU Affero General Public License, Version 3.
 *
 * @tags update
 */
class Updater extends Suite
{
    public function case_get_list_of_updates_url_default_server()
    {
        $this
            ->when($result = CUT::getUpdateUrl())
            ->then
                ->string($result)
                    ->isEqualTo(
                        sprintf(
                            '%supdates.json?version=%s',
                            CUT::DEFAULT_UPDATE_SERVER,
                            SABRE_KATANA_VERSION
                        )
                    );
    }

    public function case_get_list_of_updates_url_other_server()
    {
        $this
            ->given($server = 'https://domain.tld/')
            ->when($result = CUT::getUpdateUrl($server))
            ->then
                ->string($result)
                    ->isEqualTo(
                        sprintf(
                            '%supdates.json?version=%s',
                            $server,
                            SABRE_KATANA_VERSION
                        )
                    );
    }

    public function case_filter_versions()
    {
        $this
            ->given(
                $list = [
                    // Unordered must work
                    '0.0.3' => [
                        'phar' => '0.0.3.phar',
                        'zip'  => '0.0.3.zip'
                    ],
                    '0.1.0' => [
                        'phar' => '0.1.0.phar',
                        'zip'  => '0.1.0.zip'
                    ],
                    '0.0.1' => [
                        'phar' => '0.0.1.phar',
                        'zip'  => '0.0.1.zip'
                    ],
                    '0.1.1' => [
                        'phar' => '0.1.1.phar',
                        'zip'  => '0.1.1.zip'
                    ]
                ],
                $version = '0.0.3',
                $format  = CUT::FORMAT_PHAR
            )
            ->when($result = CUT::filterVersions($list, $version, $format))
            ->then
                ->array($result)
                    ->isEqualTo([
                        '0.1.0' => '0.1.0.phar',
                        '0.1.1' => '0.1.1.phar'
                    ])

            ->given($format = CUT::FORMAT_ZIP)
            ->when($result = CUT::filterVersions($list, $version, $format))
            ->then
                ->array($result)
                    ->isEqualTo([
                        '0.1.0' => '0.1.0.zip',
                        '0.1.1' => '0.1.1.zip'
                    ]);
    }

    public function case_filter_versions_invalid_list_URL_are_missing()
    {
        $this
            ->given(
                $list = [
                    '0.0.1' => 'foo'
                ],
                $version = '0.0.1',
                $format  = CUT::FORMAT_PHAR
            )
            ->exception(function() use($list, $version, $format) {
                CUT::filterVersions($list, $version, $format);
            })
                ->isInstanceOf('Sabre\Katana\Exception\Update');
    }

    public function case_filter_versions_invalid_list_PHAR_is_missing()
    {
        $this
            ->given(
                $list = [
                    '0.0.1' => [
                        'zip' => '0.0.1.zip'
                    ]
                ],
                $version = '0.0.1',
                $format  = CUT::FORMAT_PHAR
            )
            ->exception(function() use($list, $version, $format) {
                CUT::filterVersions($list, $version, $format);
            })
                ->isInstanceOf('Sabre\Katana\Exception\Update');
    }

    public function case_filter_versions_invalid_list_ZIP_is_missing()
    {
        $this
            ->given(
                $list = [
                    '0.0.1' => [
                        'phar' => '0.0.1.phar'
                    ]
                ],
                $version = '0.0.1',
                $format  = CUT::FORMAT_ZIP
            )
            ->exception(function() use($list, $version, $format) {
                CUT::filterVersions($list, $version, $format);
            })
                ->isInstanceOf('Sabre\Katana\Exception\Update');
    }
}
