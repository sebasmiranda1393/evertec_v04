<?php

namespace App\Imports;

use App\Product;
use App\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CsvDataImport implements ToCollection, WithHeadingRow
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        $dataToInsert= [];
        $productos = Product::with('categoria')->get();

        foreach ($collection as $collec => $row) {
            if(!$productos->contains($row['id'])){
                $dataToInsert[] =  [
                    'name' => $row['name'],
                    'description' => $row['description'],
                    'purchase_price' => $row['purchase_price'],
                    'sale_price' => $row['sale_price'],
                    'available' => $row['available'],
                    'productimg' => "",
                    'status' => $row['status'],
                    'category_id' => $row['category_id'],
                    'created_at' => now(),
                    'updated_at' => now()
                ];
            }else{
                DB::Table('products')->where('id', $row['id'])->update(
                    array(
                        'name' => $row['name'],
                        'description' => $row['description'],
                        'purchase_price' => $row['purchase_price'],
                        'sale_price' => $row['sale_price'],
                        'available' => $row['available'],
                        'status' => $row['status'],
                        'category_id' => $row['category_id'],
                        'created_at' => now(),
                        'updated_at' => now()
                    )
                );
            }
        }
        if(count($dataToInsert)>0){
            DB::table('products')->insert($dataToInsert);
        }
    }
}
