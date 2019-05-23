<?php

use Faker\Factory as Faker;
use App\Models\Customers;
use App\Repositories\CustomersRepository;

trait MakeCustomersTrait
{
    /**
     * Create fake instance of Customers and save it in database
     *
     * @param array $customersFields
     * @return Customers
     */
    public function makeCustomers($customersFields = [])
    {
        /** @var CustomersRepository $customersRepo */
        $customersRepo = App::make(CustomersRepository::class);
        $theme = $this->fakeCustomersData($customersFields);
        return $customersRepo->create($theme);
    }

    /**
     * Get fake instance of Customers
     *
     * @param array $customersFields
     * @return Customers
     */
    public function fakeCustomers($customersFields = [])
    {
        return new Customers($this->fakeCustomersData($customersFields));
    }

    /**
     * Get fake data of Customers
     *
     * @param array $postFields
     * @return array
     */
    public function fakeCustomersData($customersFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'name' => $fake->word,
            'age' => $fake->randomDigitNotNull,
            'phone' => $fake->word,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $customersFields);
    }
}
