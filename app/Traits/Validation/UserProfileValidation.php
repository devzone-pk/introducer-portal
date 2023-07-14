<?php

namespace App\Traits\Validation;

use App\Models\Customer\Customer;

trait UserProfileValidation
{
    private function validateUserProfile($customer)
    {
        if (empty($customer)) {
            return false;
        }

        if (empty($customer->first_name) && empty($customer->last_name)) {
            return false;
        }

        if (empty($customer->phone)) {
            return false;
        }

        if (empty($customer->dob)) {
            return false;
        }

        if (empty($customer->house_no)) {
            return false;
        }

        if (empty($customer->street_name)) {
            return false;
        }

        if (empty($customer->postal_code)) {
            return false;
        }

        if (empty($customer->city_name)) {
            return false;
        }

        return true;

    }


    private function validateUserMobileProfile($customer)
    {
        if (empty($customer)) {
            return false;
        }

        if (empty($customer->first_name) && empty($customer->last_name)) {
            return false;
        }

        if (empty($customer->phone)) {
            return false;
        }

        if (empty($customer->dob)) {
            return false;
        }

        return true;

    }


    private function validateUserAddress($customer)
    {
        if (empty($customer)) {
            return false;
        }



        if (empty($customer->house_no)) {
            return false;
        }

        if (empty($customer->street_name)) {
            return false;
        }

        if (empty($customer->postal_code)) {
            return false;
        }

        if (empty($customer->city_name)) {
            return false;
        }

        return true;

    }
}
