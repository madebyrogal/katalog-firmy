<?php

class UpsWorldShip
{

    private $order = false;
    private $values = array();

    public function __construct(Order $order)
    {
        $this->order = $order;
        $this->setValues();
    }

    public function setValues()
    {
        $this->values['address_id'] = $this->order->getShipmentAddressId();
        $this->values['name'] = $this->order->getShipmentAddress()->getName();
        $this->values['address'] = $this->order->getShipmentAddress()->getStreet();
        $this->values['country'] = ($this->order->getShipmentAddress()->getCountry()) ? $this->order->getShipmentAddress()->getStreet() : 'Polska';
        $this->values['post_code'] = $this->getUpsPostCode($this->order->getShipmentAddress()->getPostCode());
        $this->values['city'] = $this->order->getShipmentAddress()->getCity();
        $this->values['phone'] = $this->order->getShipmentAddress()->getPhone();
        $this->values['email'] = $this->order->getOrderProfile()->getEmailAddress();
        $this->values['order_id'] = $this->order->getPrimaryKey();
        $this->values['weight'] = $this->getUpsWeight($this->order->getAllWeight());
    }

    private function getUpsPostCode($post_code)
    {
        if(strlen($post_code) == 6)
        {
            $post_code_A = explode('-', $post_code);
            if(strlen($post_code_A[0]) == 2 && strlen($post_code_A[1]) == 3)
            {
                return str_replace('-', '', $post_code);
            }
        }
        return '00000';
    }

    private function getUpsWeight($weight)
    {
        $max = 10;
        if($weight > $max)
        {
            return $max;
        }
        else
        {
            return $weight;
        }
    }

    private function getXmlBase()
    {
        $xml = ('<OpenShipments xmlns="x-schema:OpenShipments.xdr">
          <OpenShipment ShipmentOption="" ProcessStatus="">');

        $xml .= ('<ShipTo>
              <CustomerID>{address_id}</CustomerID>
              <CompanyOrName>{name}</CompanyOrName>
              <Attention>{name}</Attention>
              <Address1>{address}</Address1>
              <CountryTerritory>{country}</CountryTerritory>
              <PostalCode>{post_code}</PostalCode>
              <CityOrTown>{city}</CityOrTown>
              <StateProvinceCounty />
              <Telephone>{phone}</Telephone>
              <FaxNumber />
              <EmailAddress>{email}</EmailAddress>
              <TaxIDNumber />
              <ReceiverUpsAccountNumber />
              <LocationID />
            </ShipTo>');

        $xml .= ('<ShipmentInformation>
              <VoidIndicator />
              <ServiceType>Standard</ServiceType>
              <PackageType>Package</PackageType>
              <NumberOfPackages>1</NumberOfPackages>
              <ShipmentActualWeight>{weight}</ShipmentActualWeight>
              <Reference1>ID: {order_id}</Reference1>
              <DocumentOnly />
              <GoodsNotInFreeCirculation />
              <SpecialInstructionForShipment />
              <ShipperNumber />
              <BillingOption>PP</BillingOption>');
        
        if($this->isDelivery())
        {
            $xml .= ('<COD>
                        <Amount>'.$this->getValue().'</Amount>
                        <Currency>PLN</Currency>
                      </COD>');
        }


        $xml .= ('</ShipmentInformation>');

        $xml .= ('</OpenShipment>
        </OpenShipments>');

        return $xml;
    }

    public function getXml()
    {
        $xml = $this->getXmlBase();

        foreach($this->values as $key => $value)
        {
            $xml = str_replace('{'.$key.'}', $value, $xml);
        }

        return $xml;
    }

    public function getFile()
    {
        $name = $this->values['order_id'].'.xml';
        return $name;
    }

    public function downloadFile()
    {
       $file = $this->getFile();
       header('Content-type: application/octet-stream', true);
       header('Content-Disposition: attachment; filename="'.$file.'"');
       header('Pragma: no-cache', true);
       echo $this->getXml();
       die();
    }

    public function isDelivery()
    {
        return $this->order->getOrderShipment()->getIsDelivery();
    }

    public function getValue()
    {
        $price = new StgPrice($this->order->getValueBrutto());
        $price = stgPrice::asRealWithoutSymbol($price->asIs());
        return $price;
    }

}