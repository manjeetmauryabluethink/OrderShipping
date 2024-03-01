<?php
namespace Bluethinkinc\Order\Observer;

use Magento\Framework\Event\Observer as EventObserver;
use Magento\Framework\Event\ObserverInterface;
use Magento\Sales\Model\Order\AddressFactory;
use Magento\Sales\Model\OrderRepository;

class SaveOrderObserver implements ObserverInterface
{
    protected $addressRepository;

    public $addressFactory;

    public $orderRepository;

    public function __construct(
        \Magento\Sales\Api\OrderAddressRepositoryInterface $addressRepository,
        AddressFactory $addressFactory,
        OrderRepository $orderRepository
    ) {
        $this->addressRepository = $addressRepository;
        $this->addressFactory = $addressFactory;
        $this->orderRepository = $orderRepository;
    }


    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $model = $this->addressFactory->create();
        $order = $this->orderRepository->get($observer->getEvent()->getData('order_id'));
        $billingAddressEntityId =  $order->getBillingAddress()->getData('entity_id');
        $billingAddressData = $model->load($order->getBillingAddress()->getData('entity_id'));
        $model->setData('extra_desc',$order->getShippingAddress()->getData('extra_desc'))->save();
        return $this;
    }
}