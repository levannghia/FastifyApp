<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CronTaskController extends Controller
{
    public function LCDMT()
    {
        // https://www.cskh.evnspc.vn/TraCuu/GetThongTinLichNgungGiamMaKhachHang?madvi=PB1801&tuNgay=19-10-2024&denNgay=26-10-2024&ChucNang=MaDonVi
        $response = Http::get('https://www.cskh.evnspc.vn/TraCuu/GetThongTinLichNgungGiamMaKhachHang', [
            'madvi' => 'PB1801',
            'tuNgay' => '19-10-2024',
            'denNgay' => '26-10-2024',
            'ChucNang' => 'MaDonVi'
        ]);

        // foreach ($subOrgCodes as $subOrg) {
        //     try {
        //         $response = Http::get('https://cskh-api.cpc.vn/api/remote/outages/area', [
        //             'orgCode' => $orgCode,
        //             'subOrgCode' => $subOrg['code'], // Sử dụng subOrgCode
        //             'fromDate' => '2024-10-09 00:00:00',
        //             'toDate' => '2024-10-17 23:59:59',
        //             'page' => 1,
        //             'limit' => 10,
        //         ]);

        //         // Log the response for debugging
        //         Log::info('API Response for ' . $subOrg['organizationName'] . ':', $response->json());
        //     } catch (\Exception $e) {
        //         // Log the error message
        //         Log::error('Error fetching data for ' . $subOrg['organizationName'] . ': ' . $e->getMessage());
        //     }
        // }

        return response()->json($this->convertHtmlToJson($response->body()), 200);
    }

    private function convertHtmlToJson($html)
    {
        $dom = new \DOMDocument();
        $content = '<!DOCTYPE html>
<html lang="vi">
    <head>
        <meta charset="utf-8">
        </head>
        <body>
        ';
        $content .= $html;
        $content .= '</body>
</html>';

        // Tắt lỗi báo cáo liên quan đến HTML không hợp lệ
        libxml_use_internal_errors(true);

        // Load HTML
        $dom->loadHTML($content, LIBXML_NOERROR | LIBXML_NOWARNING);

        // Lấy tất cả các thẻ <tr> trong <tbody>
        $rows = $dom->getElementsByTagName('tr');

        $data = [];

        foreach ($rows as $row) {
            $cols = $row->getElementsByTagName('td');

            if ($cols->length === 4) {
                $data[] = [
                    'start_time' => trim($cols->item(0)->nodeValue),
                    'end_time' => trim($cols->item(1)->nodeValue),
                    'location' => trim($cols->item(2)->nodeValue),
                    'reason' => trim($cols->item(3)->nodeValue),
                ];
            }
        }

        // Trả về dữ liệu dưới dạng JSON

        json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        return $data;
    }
}
