<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class SettingRequest extends Request
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
            'international_transport_rate_kg' => 'numeric',
            'international_transport_rate_volume' => 'numeric',
            'site_logo_file' => 'image|max:2000',
            'email_driver' => 'required',
            'email_host' => 'required_if:email_driver,smtp',
            'email_port' => 'required_if:email_driver,smtp',
            'email_username' => 'required_if:email_driver,smtp',
            'email_password' => 'required_if:email_driver,smtp',
        ];
    }

    protected function getValidatorInstance()
    {
        $data = $this->all();
        $data['sales_person'] = (int)($this->sales_person);
        $data['international_transport_rate_kg'] = $this->convertNumber($this->international_transport_rate_kg);
        $data['international_transport_rate_volume'] = $this->convertNumber($this->international_transport_rate_volume);
        $this->getInputSource()->replace($data);
        return parent::getValidatorInstance();
    }

    public function convertNumber($number) {
        $number = (float)str_replace(",","",$number);
        return $number > 0 ? $number : 0;
    }
}
