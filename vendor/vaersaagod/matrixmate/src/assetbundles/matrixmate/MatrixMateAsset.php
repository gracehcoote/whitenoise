<?php
/**
 * MatrixMate plugin for Craft CMS 4.x
 *
 * Welding Matrix into shape, mate!
 *
 * @link      https://vaersaagod.no
 * @copyright Copyright (c) 2019 Værsågod
 */

namespace vaersaagod\matrixmate\assetbundles\matrixmate;

use craft\helpers\Json;
use craft\web\AssetBundle;
use craft\web\assets\matrix\MatrixAsset;
use craft\web\View;
use vaersaagod\matrixmate\MatrixMate;

/**
 * @author    Værsågod
 * @package   MatrixMate
 * @since     1.0.0
 */
class MatrixMateAsset extends AssetBundle
{
    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function init()
    {

        $this->sourcePath = "@vaersaagod/matrixmate/assetbundles/matrixmate/dist";

        $this->depends = [
            MatrixAsset::class
        ];

        $this->js = [
            'js/MatrixMate.js',
        ];

        $this->css = [
            'css/MatrixMate.css',
        ];

        parent::init();
    }
}
