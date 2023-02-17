<?php
/**
 * @author    Manuel Cánepa <manuel@gento.com.ar>
 * @copyright GENTo 2023 Todos los derechos reservados
 */

declare (strict_types = 1);

namespace Gento\StockReservationStatus\Model\ResourceModel\Reservation\Grid;

use Magento\Framework\View\Element\UiComponent\DataProvider\SearchResult;
use Zend_Db_Expr;

class Collection extends SearchResult
{
    protected function _initSelect()
    {
        $this->getSelect()
            ->from(
                ['main_table' => $this->getMainTable()],
                [
                    '*',
                    'event_type' => new Zend_Db_Expr('JSON_UNQUOTE(JSON_EXTRACT(metadata, \'$.event_type\'))'),
                    'object_type' => new Zend_Db_Expr('JSON_UNQUOTE(JSON_EXTRACT(metadata, \'$.object_type\'))'),
                    'object_id' => new Zend_Db_Expr('JSON_UNQUOTE(JSON_EXTRACT(metadata, \'$.object_id\'))'),
                    'object_increment_id' => new Zend_Db_Expr(
                        'COALESCE(
                                NULLIF(JSON_UNQUOTE(JSON_EXTRACT(metadata, \'$.object_increment_id\')), \'\'),
                                CONCAT(\'ID: \', JSON_UNQUOTE(JSON_EXTRACT(metadata, \'$.object_id\')))
                        )'),
                ]
            )->joinLeft(
                ['stock' => $this->getTable('inventory_stock')],
                'main_table.stock_id=stock.stock_id',
                ['stock_name' => 'name']
            );
        return $this;
    }
}
