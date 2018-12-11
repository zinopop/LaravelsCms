<?php

namespace App\Exports;

use App\Model\Admin\ManualInformation;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ManualInformationExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return ManualInformation::all([
            'manual_num',
            'style',
            'num',
            'goods_code',
            'goods_name',
            'format',
            'amount',
            'unit',
            'price',
            'total',
            'country'
        ]);
    }

    public function headings(): array
    {
        return [
            '手册号',
            '方式',
            '序号',
            '商品代码',
            '商品名称',
            '规格型号',
            '数量',
            '单位',
            '单价',
            '总值',
            '原产国(地区)'
        ];
    }
}
