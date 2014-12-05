<?php
/**
 * Product Media Gallery Entry Resolver
 *
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magentocommerce.com for more information.
 *
 * @copyright   Copyright (c) 2014 X.commerce, Inc. (http://www.magentocommerce.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
namespace Magento\Catalog\Model\Product\Gallery;

use \Magento\Catalog\Model\Product;

class EntryResolver
{
    /**
     * Retrieve file path that corresponds to the given gallery entry ID
     *
     * @param Product $product
     * @param int $entryId
     * @return string|null
     */
    public function getEntryFilePathById(Product $product, $entryId)
    {
        $mediaGalleryData = $product->getData('media_gallery');
        if (!isset($mediaGalleryData['images']) || !is_array($mediaGalleryData['images'])) {
            return null;
        }

        foreach ($mediaGalleryData['images'] as $image) {
            if (isset($image['value_id']) && $image['value_id'] == $entryId) {
                return isset($image['file']) ? $image['file'] : null;
            }
        }
        return null;
    }

    /**
     * Retrieve gallery entry ID that corresponds to the given file path
     *
     * @param Product $product
     * @param string $filePath
     * @return int|null
     */
    public function getEntryIdByFilePath(Product $product, $filePath)
    {
        $mediaGalleryData = $product->getData('media_gallery');
        if (!isset($mediaGalleryData['images']) || !is_array($mediaGalleryData['images'])) {
            return null;
        }

        foreach ($mediaGalleryData['images'] as $image) {
            if (isset($image['file']) && $image['file'] == $filePath) {
                return isset($image['value_id']) ? $image['value_id'] : null;
            }
        }
        return null;
    }
}