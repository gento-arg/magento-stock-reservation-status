<?php
/**
 * @author    Manuel Cánepa <manuel@gento.com.ar>
 * @copyright GENTo 2023 Todos los derechos reservados
 */

declare (strict_types = 1);

namespace Gento\StockReservationStatus\Ui\DataProvider;

use Magento\Framework\View\Element\UiComponent\DataProvider\DataProvider;

class ReservationDataProvider extends DataProvider
{
    public function getData()
    {
        $data = parent::getData();
        $data['items'] = array_map(function ($item) {
            $item['object_type'] = __($item['object_type']);
            $item['event_type'] = __($item['event_type']);
            return $item;
        }, $data['items']);

        return $data;
    }
}
