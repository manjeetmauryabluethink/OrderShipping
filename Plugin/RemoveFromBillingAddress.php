<?php

namespace Bluethinkinc\Order\Plugin;

use Magento\Framework\App\Request\Http;

use Magento\Sales\Api\OrderAddressRepositoryInterface;

class RemoveFromBillingAddress
{
    private const ACTION_NAME = 'sales_order_address';

    /**
     * @var Http
     */
    private $request;

    /**
     * @var OrderAddressRepositoryInterface
     */
    private $orderAddressRepositiory;


    public function __construct(
        Http $request,
        OrderAddressRepositoryInterface $orderAddressRepositiory
        
    ) {
        $this->request  = $request;
        $this->orderAddressRepositiory = $orderAddressRepositiory;
    }

    public function afterGetAttributes(
        \Magento\Customer\Model\Metadata\Form $subject,
        $result
    ) {
        if ($this->request->getFullActionName() ==  self::ACTION_NAME) {
            $addressId = $this->request->getUserParams();
            $addressData = $this->getAddressDataById($addressId['address_id']);
            if ($addressId['address_id']) {
    
                if(!empty($result['nickname'])) {
                    unset($result['nickname']);
                }
        
                if ($addressData->getAddressType() == 'billing') {
                    if(!empty($result['extra_desc'])) {
                        unset($result['extra_desc']);
                    }
                }
            }
            return $result;
        }
        return $result;
    }

    public function getAddressDataById($addressId)
    {
        try {
            $addressData = $this->orderAddressRepositiory->get($addressId);
        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage());
        };
        return $addressData;
    }
}