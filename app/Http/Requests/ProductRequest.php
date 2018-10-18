<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Efriandika\LaravelSettings\Facades\Settings;

class ProductRequest extends Request
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
            'product_name' => "required",
            'product_sku' => "required",
            'sale_price' => "numeric",
            'promotion_price' => "numeric|max:".$this->sale_price,
            'professional_price' => "numeric|max:".$this->sale_price,
            'unit_value' => "numeric|min:0",
            'total_value' => "numeric|min:0",
            'product_weight' => "numeric|min:0",
            'product_length' => "numeric|min:0",
            'product_width' => "numeric|min:0",
            'product_depth' => "numeric|min:0",
            'category_id' => "required",
            'promotion_from' => 'date_format:"'.Settings::get('date_format').'"',
            'promotion_to' => 'date_format:"'.Settings::get('date_format').'"|after:promotion_from',
            'file_3d_file.*' => 'max:'.Settings::get('max_upload_file_size'),
        ];
    }

    public function messages()
    {
        return [
            'file_3d_file.*.max' => 'The 3D files may not be greater than '.Settings::get('max_upload_file_size').' KB',
            'promotion_price.max' => 'The promotion price may not be greater than product price',
            'professional_price.max' => 'The professional price may not be greater than product price',
        ];
    }

    protected function getValidatorInstance()
    {
        $data = $this->all();
        $data['sale_price'] = $this->convertNumber($this->sale_price);
        $data['promotion_price'] = $this->convertNumber($this->promotion_price);
        $data['professional_price'] = $this->convertNumber($this->professional_price);
        $data['unit_value'] = $this->convertNumber($this->unit_value);
        $data['total_value'] = $this->convertNumber($this->total_value);
        $data['product_weight'] = $this->convertNumber($this->product_weight);
        $data['product_length'] = $this->convertNumber($this->product_length);
        $data['product_width'] = $this->convertNumber($this->product_width);
        $data['product_depth'] = $this->convertNumber($this->product_depth);
        $this->getInputSource()->replace($data);
        return parent::getValidatorInstance();
    }

    public function convertNumber($number) {
        $number = (float)str_replace(",","",$number);
        return $number > 0 ? $number : 0;
    }
}
