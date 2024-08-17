<?php

namespace App\Imports;

use App\Models\Lead;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\SkipsOnError;

class LeadBulkImport implements ToModel, WithHeadingRow, SkipsEmptyRows
{

    /*
    //this is also working with ToCollection
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) 
        {
            Lead::create([
                'company_name'      => $row['company_name'],
                'first_name'        => $row['first_name'],
                'last_name'         => $row['last_name'],
                // 'requirement'       => $row['requirement'],
                'email'             => $row['email'],
                'contact'           => $row['contact'],
                'contact_whatsapp'  => $row['contact_whatsapp'],
                'message'           => $row['message'],
                'address'           => $row['address'],
                'utm_term'          => "Upload by Excel",
                'utm_source'        => "Admin Panel",
                'utm_medium'        => "admin dashboard",
            ]);
        }
    }*/
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        /*print_r([
            'company_name'      => $row['company_name'],
            'first_name'        => $row['first_name'],
            'last_name'         => $row['last_name'],
            // 'requirement'       => $row['requirement'],
            'email'             => $row['email'],
            'contact'           => $row['contact'],
            'contact_whatsapp'  => $row['contact_whatsapp'],
            'message'           => $row['message'],
            'address'           => $row['address'],
            'utm_term'          => "Upload by Excel",
            'utm_source'        => "Admin Panel",
            'utm_medium'        => "admin dashboard",
        ]);
        print_r($row);
        */
        /*if (!isset($row['first_name'])  || !isset($row['email']) ) {
            return null;
        }*/
        //company_name	category	name	contact_number	email_id	contact_whatsapp	message	address	data_source
        return new Lead([
            'company_name'      => $row['company_name'],
            'category'          => $row['category'],
            'first_name'        => $row['name'],
            'email'             => $row['email_id'],
            'contact'           => $row['contact'],//_number
            'contact_whatsapp'  => $row['contact_whatsapp'],
            'message'           => $row['message'],
            'address'           => $row['address'],
            'utm_term'          => "Upload by Excel",
            'utm_source'        => $row['data_source'],
            'utm_medium'        => "admin dashboard",
        ]);
    }
    //option function, In case your heading row is not on the first row
    /*public function headingRow(): int
    {
        return 1;
    }*/
}
