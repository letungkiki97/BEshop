<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Efriandika\LaravelSettings\Facades\Settings;

class PurchaseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'supplier_id' => 'required',
            'purchase_date' => 'required|date_format:"'.Settings::get('date_format').'"',
            'receiving_date' => 'required|date_format:"'.Settings::get('date_format').'"',
            'product_id' => 'required',
            'currency_id' => 'required',
            'item_price' => 'numeric|min:0',
            'price_per_order_unit' => 'numeric|min:0',
            'ordering_fee' => 'numeric|min:0',
            'internal_transportation_fee' => 'numeric|min:0',
            'internal_product_price' => 'numeric|min:0',
            'total' => 'numeric|min:0',
            'international_transport_rate_volume' => 'numeric|min:0',
            'international_transport_rate_kg' => 'numeric|min:0',
            'box_weight' => 'numeric|min:0',
            'total_transport_rate' => 'numeric|min:0',
            'box1_height' => 'numeric|min:0',
            'box1_depth' => 'numeric|min:0',
            'box1_length' => 'numeric|min:0',
            'box1_volume' => 'numeric|min:0',
            'box2_height' => 'numeric|min:0',
            'box2_depth' => 'numeric|min:0',
            'box2_length' => 'numeric|min:0',
            'box2_volume' => 'numeric|min:0',
            'total_volume' => 'numeric|min:0',
            'transportation_fee' => 'numeric|min:0',
            'discount_amount' => 'numeric|min:0',
            'grand_total' => 'numeric|min:0',
            'nominate_price' => 'numeric|min:0',
        ];
    }

    protected function getValidatorInstance()
    {
        $data = $this->all();
        $data['item_price'] = $this->convertNumber($this->item_price);
        $data['price_per_order_unit'] = $this->convertNumber($this->price_per_order_unit);
        $data['ordering_fee'] = $this->convertNumber($this->ordering_fee);
        $data['internal_transportation_fee'] = $this->convertNumber($this->internal_transportation_fee);
        $data['internal_product_price'] = $this->convertNumber($this->internal_product_price);
        $data['exchange_rate'] = $this->convertNumber($this->exchange_rate);
        $data['total'] = $this->convertNumber($this->total);
        $data['international_transport_rate_volume'] = $this->convertNumber($this->international_transport_rate_volume);
        $data['international_transport_rate_kg'] = $this->convertNumber($this->international_transport_rate_kg);
        $data['box_weight'] = $this->convertNumber($this->box_weight);
        $data['total_transport_rate'] = $this->convertNumber($this->total_transport_rate);
        $data['box1_height'] = $this->convertNumber($this->box1_height);
        $data['box1_depth'] = $this->convertNumber($this->box1_depth);
        $data['box1_length'] = $this->convertNumber($this->box1_length);
        $data['box1_volume'] = $this->convertNumber($this->box1_volume);
        $data['box2_height'] = $this->convertNumber($this->box2_height);
        $data['box2_depth'] = $this->convertNumber($this->box2_depth);
        $data['box2_length'] = $this->convertNumber($this->box2_length);
        $data['box2_volume'] = $this->convertNumber($this->box2_volume);
        $data['total_volume'] = $this->convertNumber($this->total_volume);
        $data['transportation_fee'] = $this->convertNumber($this->transportation_fee);
        $data['discount_amount'] = $this->convertNumber($this->discount_amount);
        $data['grand_total'] = $this->convertNumber($this->grand_total);
        $data['nominate_price'] = $this->convertNumber($this->nominate_price);
        $this->getInputSource()->replace($data);
        return parent::getValidatorInstance();
    }

    public function convertNumber($number) {
        $number = (float)str_replace(",","",$number);
        return $number > 0 ? $number : 0;
    }
}
