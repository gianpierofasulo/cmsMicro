<?php
/**
 * ezcDocumentPdfDriverHaruTests
 * 
 * Licensed to the Apache Software Foundation (ASF) under one
 * or more contributor license agreements.  See the NOTICE file
 * distributed with this work for additional information
 * regarding copyright ownership.  The ASF licenses this file
 * to you under the Apache License, Version 2.0 (the
 * "License"); you may not use this file except in compliance
 * with the License.  You may obtain a copy of the License at
 * 
 *   http://www.apache.org/licenses/LICENSE-2.0
 * 
 * Unless required by applicable law or agreed to in writing,
 * software distributed under the License is distributed on an
 * "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY
 * KIND, either express or implied.  See the License for the
 * specific language governing permissions and limitations
 * under the License.
 *
 * @package Document
 * @version //autogen//
 * @subpackage Tests
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 */

require_once 'driver_tests.php';

/**
 * Test suite for class.
 * 
 * @package Document
 * @subpackage Tests
 */
class ezcDocumentPdfDriverHaruTests extends ezcDocumentPdfDriverTests
{
    /**
     * Expected font widths for calculateWordWidth tests
     * 
     * @var array
     */
    protected $expectedWidths = array(
        'testEstimateDefaultWordWidthWithoutPageCreation' => 22.9,
        'testEstimateDefaultWordWidth'                    => 22.9,
        'testEstimateWordWidthDifferentSize'              => 31.9,
        'testEstimateWordWidthDifferentSizeAndUnit'       => 11.3,
        'testEstimateBoldWordWidth'                       => 24.6,
        'testEstimateMonospaceWordWidth'                  => 36,
        'testFontStyleFallback'                           => 38.8,
        'testUtf8FontWidth'                               => 29.6,
        'testCustomFontWidthEstimation'                   => 59.1,
    );

    public static function suite()
    {
        return new \PHPUnit\Framework\TestSuite( __CLASS__ );
    }

    /**
     * Get driver to test
     * 
     * @return ezcDocumentPdfDriver
     */
    protected function getDriver()
    {
        if ( !ezcBaseFeatures::hasExtensionSupport( 'haru' ) )
        {
            $this->markTestSkipped( 'This test requires pecl/haru installed.' );
        }

        return new ezcDocumentPdfHaruDriver();
    }
}

?>
