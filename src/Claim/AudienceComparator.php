<?php

namespace Lcobucci\JWT\Claim;

use Lcobucci\JWT\Claim;
use Lcobucci\JWT\ValidationData;

class AudienceComparator extends Basic implements Claim, Validatable
{
    /**
     * {@inheritdoc}
     */
    public function validate(ValidationData $data)
    {
        if (is_string($this->getValue())) {
            return $this->getValue() === $data->get($this->getName());
        } elseif (is_array($this->getValue())) {
            foreach($data->get($this->getName()) as $aud) {
                if (array_search($aud, $this->getValue()) !== false) {
                    return true;
                }
            }
        }

        return false;
    }
}
