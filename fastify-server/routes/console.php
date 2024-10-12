<?php

use App\Jobs\CrawlDLMT;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Schedule::call(function () {
    $orgCodes = [
        [
            'code' => 'PC01',
            'name' => 'Công ty điện lực Quảng Bình',
            'subOrgCodes' => [
                [
                    "id" => "d0c55c7c-eec4-49d2-a48d-c7a3eba0fe61",
                    "organizationName" => "ĐL Đồпg Hới",
                    "code" => "PC01AA"
                ],
                [
                    "id" => "14ff5b33-7321-4115-9ecf-d6080ff1e876",
                    "organizationName" => "ĐL Quảng Trạch",
                    "code" => "PC01BB"
                ],
                [
                    "id" => "6158c065-d5cb-45a2-8b6b-dab94d083cf4",
                    "organizationName" => "ĐL Quảng Ninh",
                    "code" => "PC01CC"
                ],
                [
                    "id" => "09f4a16d-8191-47bb-b16a-28830ff1eeec",
                    "organizationName" => "ĐL Bố Trạch",
                    "code" => "PC01DD"
                ],
                [
                    "id" => "3ad16548-fb0a-456e-9ea3-e73cb7a2b960",
                    "organizationName" => "ĐL Tuyên Hóa",
                    "code" => "PC01EE"
                ],
                [
                    "id" => "3382488b-d62d-424b-870a-b71a90ef41ef",
                    "organizationName" => "ĐL Lệ Thủy",
                    "code" => "PC01FF"
                ],
                [
                    "id" => "ea77b546-6e9b-4fd4-aa84-40ab8bc59daf",
                    "organizationName" => "ĐL Minh Hóa",
                    "code" => "PC01MM"
                ],
                [
                    "id" => "e2c61e21-de8c-41d8-82bd-861f5de74f62",
                    "organizationName" => "Phòng Kinh doanh",
                    "code" => "PC01OO"
                ]
            ]
        ],
        [
            'code' => 'PC02',
            'name' => 'Công ty điện lực Quảng Trị',
            'subOrgCodes' => [
                [
                    "id" => "f7c7b2b2-90e6-4f15-b55a-edc653e366df",
                    "organizationName" => "ĐL Đông Hà",
                    "code" => "PC02AA"
                ],
                [
                    "id" => "a93bd6de-d1f1-4000-a051-17ae3a1dfca1",
                    "organizationName" => "Điện lực Thành Cổ",
                    "code" => "PC02BB"
                ],
                [
                    "id" => "dd1020e6-47f7-43f6-b519-0171c46a7b88",
                    "organizationName" => "ĐL Gio Linh",
                    "code" => "PC02CC"
                ],
                [
                    "id" => "c15d7175-9662-4a48-9241-19a22d72ac5b",
                    "organizationName" => "ĐL Vinh Linh",
                    "code" => "PC02DD"
                ],
                [
                    "id" => "3a72d3d4-8a6d-43a3-9d85-243a8a849513",
                    "organizationName" => "ĐL Khe Sanh",
                    "code" => "PC02FF"
                ],
                [
                    "id" => "5cc00c2d-96b0-46f2-b942-1623b754f554",
                    "organizationName" => "Điện lực Cam Lộ",
                    "code" => "PC02GG"
                ],
                [
                    "id" => "04038080-defa-48fb-ac6a-450a9ccaba04",
                    "organizationName" => "Điện lực Triệu Phong",
                    "code" => "PC02HH"
                ],
                [
                    "id" => "b410e743-46db-4036-aa8b-a3e499857dd5",
                    "organizationName" => "ĐL Hải Lăng",
                    "code" => "PC02KK"
                ],
                [
                    "id" => "1dc5cc12-6bec-4f5b-a3b6-0482681dbd85",
                    "organizationName" => "ĐL ĐaKrông",
                    "code" => "PC02LL"
                ],
                [
                    "id" => "ad3a02c1-589d-48a5-a05d-c79962d2f4eb",
                    "organizationName" => "Chi nhánh Bán điện Lào",
                    "code" => "PC02EE"
                ],
                [
                    "id" => "e0fe4a74-9617-40f8-834d-fd889601a1ef",
                    "organizationName" => "Trạm điện Cồn Cỏ",
                    "code" => "PC02MM"
                ],
                [
                    "id" => "1404f3c8-0278-4608-aa1d-af7d1d944d04",
                    "organizationName" => "Đội QLVH Lưới điện Cao thế",
                    "code" => "PC02ZZ"
                ]
            ]
        ],
        [
            'code' => 'PC03',
            'name' => 'Công ty điện lực TT Huế',
            'subOrgCodes' => [
                [
                    "id" => "9bd6e4cb-65c8-4bc2-9e5d-3272ee7fdf8c",
                    "organizationName" => "ĐL Nam Sông Hương",
                    "code" => "PC03AA"
                ],
                [
                    "id" => "9ce7913a-3562-4665-9619-2db37c17ff10",
                    "organizationName" => "ĐL Bắc Sông Hương",
                    "code" => "PC03BB"
                ],
                [
                    "id" => "f1d46c60-1a21-4919-99de-c5c536e4286f",
                    "organizationName" => "ĐL Phong Điền",
                    "code" => "PC03CC"
                ],
                [
                    "id" => "58ced681-7174-48bc-a1cb-e61c9d2354c0",
                    "organizationName" => "ĐL Phú Vang",
                    "code" => "PC03DD"
                ],
                [
                    "id" => "bb7e1340-9d11-4d05-8143-82226cb2b84d",
                    "organizationName" => "ĐL A Lưới",
                    "code" => "PC03EE"
                ],
                [
                    "id" => "312e3acf-649f-404a-9efe-3d56e83f59a1",
                    "organizationName" => "ĐL Nam Đông",
                    "code" => "PC03FF"
                ],
                [
                    "id" => "36bd38fa-863a-405b-b44c-84759425ba49",
                    "organizationName" => "ĐL Phú Lộc",
                    "code" => "PC03GG"
                ],
                [
                    "id" => "4da533c8-cf4c-4853-96f4-84daf3d3ffe7",
                    "organizationName" => "ĐL Quảng Điền",
                    "code" => "PC03HH"
                ],
                [
                    "id" => "353e6895-36fb-49f2-b0aa-9a610252f504",
                    "organizationName" => "ĐL Hương Thủy",
                    "code" => "PC03PP"
                ],
                [
                    "id" => "35644881-374a-4fc0-9104-84b45ea157be",
                    "organizationName" => "ĐL Hương Trà",
                    "code" => "PC03TT"
                ]
            ]
        ],
        [
            'code' => 'PC05',
            'name' => 'Công ty điện lực Quảng Nam',
            'subOrgCodes' => [
                [
                    "id" => "978612e4-6931-45ac-9a8d-5474d5560491",
                    "organizationName" => "ĐL Tam Kỳ",
                    "code" => "PC05AA"
                ],
                [
                    "id" => "ebe5104b-9360-4cf9-8ec8-c53819f24299",
                    "organizationName" => "ĐL Núi Thành",
                    "code" => "PC05BB"
                ],
                [
                    "id" => "0a7170a2-ac1b-4b05-a8b9-7b1de9324cce",
                    "organizationName" => "ĐL Hội An",
                    "code" => "PC05CC"
                ],
                [
                    "id" => "26d03001-3e92-4217-8d42-18e8ac6fd438",
                    "organizationName" => "ĐL Duy Xuyên",
                    "code" => "PC05DD"
                ],
                [
                    "id" => "f770b444-5137-4695-a12f-645950b6ff9b",
                    "organizationName" => "ĐL Tiên Phước",
                    "code" => "PC05EE"
                ],
                [
                    "id" => "5e06092c-c820-4e95-853f-e6deaba9edd7",
                    "organizationName" => "ĐL Thăng Bình",
                    "code" => "PC05FF"
                ],
                [
                    "id" => "19a524ed-7967-40af-ae48-d984205d35fa",
                    "organizationName" => "ĐL Đại Lộc",
                    "code" => "PC05GG"
                ],
                [
                    "id" => "cb4248ef-ea88-40ae-83a7-c60b7e7a80b3",
                    "organizationName" => "ĐL Hiệp Đức",
                    "code" => "PC05HH"
                ],
                [
                    "id" => "43ea2c64-3de4-4749-ba2f-644a9528c462",
                    "organizationName" => "ĐL Điện Bàn",
                    "code" => "PC05II"
                ],
                [
                    "id" => "58850879-5b14-432e-986f-ca46cbc2998e",
                    "organizationName" => "ĐL Đông Giang",
                    "code" => "PC05KK"
                ],
                [
                    "id" => "5b0533fd-c8cd-4d8c-906d-5fb95c15d10f",
                    "organizationName" => "ĐL Quế Sơn",
                    "code" => "PC05MM"
                ],
                [
                    "id" => "69f3035e-a628-4699-b49f-85077750d7a1",
                    "organizationName" => "ĐL Trà My",
                    "code" => "PC05NN"
                ],
                [
                    "id" => "b918492a-7bee-428b-804e-1c9bd6a27c28",
                    "organizationName" => "ĐL Nam Giang",
                    "code" => "PC05PP"
                ],
                [
                    "id" => "6cec293e-2653-4508-b074-6a1cd4a5e6f4",
                    "organizationName" => "Điện lực  Bán điện Lào",
                    "code" => "PC05LL"
                ],
                [
                    "id" => "a5f4705f-183e-42ec-934a-e6757a7044b8",
                    "organizationName" => "Đội QLVH Lưới điện cao thế",
                    "code" => "PC05ZZ"
                ]
            ]
        ],
        [
            'code' => 'PC06',
            'name' => 'Công ty điện lực Quảng Ngãi',
            'subOrgCodes' => [
                [
                    "id" => "9fc6feee-d992-4833-9337-6af959773919",
                    "organizationName" => "ĐL TP Quảng Ngãi",
                    "code" => "PC06AA"
                ],
                [
                    "id" => "15f320da-d049-4331-8532-3e4044702159",
                    "organizationName" => "ĐL Bình Sơn",
                    "code" => "PC06BB"
                ],
                [
                    "id" => "68ef20be-8b34-4984-8d86-2f4e453ca1e1",
                    "organizationName" => "ĐL Ba Tơ",
                    "code" => "PC06CC"
                ],
                [
                    "id" => "02738055-44b8-45c0-ae7b-aab8d3052baa",
                    "organizationName" => "ĐL Đức Phổ",
                    "code" => "PC06DD"
                ],
                [
                    "id" => "9a212da5-f5c2-4897-be3e-4ffedb021599",
                    "organizationName" => "ĐL Tư Nghĩa",
                    "code" => "PC06EE"
                ],
                [
                    "id" => "95c2aa88-a4f9-48e1-bb4c-4288ec495baa",
                    "organizationName" => "ĐL Sơn Hà",
                    "code" => "PC06HH"
                ],
                [
                    "id" => "542dd5b3-ac57-48ef-80c7-2b0099c7a392",
                    "organizationName" => "ĐL Lý Sơn",
                    "code" => "PC06LL"
                ],
                [
                    "id" => "8ede334a-d2d6-4cd2-abdc-051889d00bed",
                    "organizationName" => "ĐL Mộ Đức",
                    "code" => "PC06MM"
                ],
                [
                    "id" => "b3a12d58-76be-4763-bd86-40d51ce2187b",
                    "organizationName" => "ĐL Nghĩa Hành",
                    "code" => "PC06NN"
                ],
                [
                    "id" => "3d431a13-9e5f-460d-81d9-4c92285abbf2",
                    "organizationName" => "ĐL Sơn Tịnh",
                    "code" => "PC06SS"
                ],
                [
                    "id" => "d6a0ba85-6ac3-46f8-a958-a21cf1cf47b5",
                    "organizationName" => "ĐL Trà Bồng",
                    "code" => "PC06TT"
                ],
                [
                    "id" => "6659f3b1-e9a8-4f67-b8ee-5ab77d2cd007",
                    "organizationName" => "Đội QLVH Lưới điện Cao thế",
                    "code" => "PC06ZZ"
                ]
            ]
        ],
        [
            'code' => 'PC07',
            'name' => 'Công ty điện lực Bình Định',
            'subOrgCodes' => [
                [
                    "id" => "57fdf176-e9bb-47d5-891b-0bb23886eca4",
                    "organizationName" => "Điện Lực Quy Nhơn",
                    "code" => "PC07AA"
                ],
                [
                    "id" => "8221bc5b-3e69-4267-90f6-838ba2d0a504",
                    "organizationName" => "Điện lực Tuy Phước",
                    "code" => "PC07HH"
                ],
                [
                    "id" => "6ebf54a9-e929-4de6-a69d-310205c20525",
                    "organizationName" => "Điện Lực Phú Tài",
                    "code" => "PC07FF"
                ],
                [
                    "id" => "265f3d40-dd8a-4e88-9e8d-392149c8227b",
                    "organizationName" => "Điện lực An Nhơn",
                    "code" => "PC07BB"
                ],
                [
                    "id" => "cac00297-cf73-425d-a809-56f28cd48a9b",
                    "organizationName" => "Điện Lực Phú Phong",
                    "code" => "PC07DD"
                ],
                [
                    "id" => "cb6749f0-8e0a-45e9-add9-e1fcfb5f7b78",
                    "organizationName" => "Điện Lực Phù Cát",
                    "code" => "PC07GG"
                ],
                [
                    "id" => "1912e1b6-f7e1-4e58-981e-01818a68e343",
                    "organizationName" => "Điện lực Phù Mỹ",
                    "code" => "PC07EE"
                ],
                [
                    "id" => "8ecd112f-ede6-4a59-b35f-a476130af258",
                    "organizationName" => "Điện Lực Bồng Sơn",
                    "code" => "PC07CC"
                ],
                [
                    "id" => "5403402f-a862-4a8d-8b85-1f9ff9e52bef",
                    "organizationName" => "Điện Lực Hoài Ân",
                    "code" => "PC07II"
                ],
                [
                    "id" => "136bf832-ceb0-49c5-920e-c3c6f366eced",
                    "organizationName" => "Đội QLVH Lưới điện Cao thế",
                    "code" => "PC07ZZ"
                ]
            ]
        ],
        [
            'code' => 'PC08',
            'name' => 'Công ty điện lực Phú Yên',
            'subOrgCodes' => [
                [
                    "id" => "83df2b2b-c27b-4a59-8279-7e0bcd4d78f9",
                    "organizationName" => "ĐL Tuy Hoà",
                    "code" => "PC08AA"
                ],
                [
                    "id" => "9f4069f4-7af3-4eb0-aa13-2d3b49fd0b0c",
                    "organizationName" => "ĐL Sông Cầu",
                    "code" => "PC08BB"
                ],
                [
                    "id" => "1cb0a4e1-d739-4c74-be85-9b95a3131702",
                    "organizationName" => "ĐL Đông Hoà",
                    "code" => "PC08CC"
                ],
                [
                    "id" => "b64e99b8-6a39-4e9e-8da8-ee1a955cc7f3",
                    "organizationName" => "ĐL Sơn Hoà",
                    "code" => "PC08DD"
                ],
                [
                    "id" => "380d66b3-ff69-4995-a6a4-afe5585781ba",
                    "organizationName" => "ĐL Tuy An",
                    "code" => "PC08EE"
                ],
                [
                    "id" => "2a565aea-9187-4bf6-848c-aa36ddd2f59e",
                    "organizationName" => "ĐL Sông Hinh",
                    "code" => "PC08FF"
                ],
                [
                    "id" => "31aa55aa-c3e4-4ed1-81a7-47b24054b65b",
                    "organizationName" => "ĐL Đồng Xuân",
                    "code" => "PC08GG"
                ],
                [
                    "id" => "b50a4635-2728-439f-b1ed-8b83ffc67248",
                    "organizationName" => "ĐL Phú Hoà",
                    "code" => "PC08HH"
                ],
                [
                    "id" => "0c2a935d-f981-4ac2-acda-4cb49b68c11b",
                    "organizationName" => "ĐL Tây Hoà",
                    "code" => "PC08II"
                ]
            ]
        ],
        [
            'code' => 'PC10',
            'name' => 'Công ty điện lực Gia Lai',
            'subOrgCodes' => [
                [
                    "id" => "527c2aac-c0b3-4a4e-b954-ddaa90fef49e",
                    "organizationName" => "Điện lực Pleiku",
                    "code" => "PC10AA"
                ],
                [
                    "id" => "c8f38242-e92b-46d3-a937-015ab8891144",
                    "organizationName" => "Điện lực An Khê",
                    "code" => "PC10BB"
                ],
                [
                    "id" => "24e021ca-4fed-49c2-b724-a944e5db7625",
                    "organizationName" => "Điện lực Ayunpa",
                    "code" => "PC10CC"
                ],
                [
                    "id" => "89b040d4-a0bf-4db8-8cad-d85627a02ba8",
                    "organizationName" => "Điện lực Chư Păh",
                    "code" => "PC10II"
                ],
                [
                    "id" => "58064bab-0833-4bcc-b008-1dbf0722edc6",
                    "organizationName" => "Điện lực Chư Sê",
                    "code" => "PC10EE"
                ],
                [
                    "id" => "c064f3c7-d1eb-4ae6-98cf-886eab0da885",
                    "organizationName" => "Điện lực Đak Đoa",
                    "code" => "PC10HH"
                ],
                [
                    "id" => "edbd1484-4482-4ed0-829e-6b7fe072f2a6",
                    "organizationName" => "Điện lực Đức cơ",
                    "code" => "PC10GG"
                ],
                [
                    "id" => "02708aa0-f0ab-4690-b553-c29521879dbf",
                    "organizationName" => "Điện lực IaGrai",
                    "code" => "PC10KK"
                ],
                [
                    "id" => "72adb8e5-1031-4113-bfb8-db4195e80193",
                    "organizationName" => "Điện lực KBang",
                    "code" => "PC10FF"
                ],
                [
                    "id" => "272f2a7c-8b41-4536-8924-610d550ce784",
                    "organizationName" => "Điện Lực Kông Chro",
                    "code" => "PC10LL"
                ],
                [
                    "id" => "6bc1c875-16d9-4955-abc9-d1cc3a280864",
                    "organizationName" => "Điện lực KrôngPa",
                    "code" => "PC10DD"
                ],
                [
                    "id" => "7adea4b6-d81c-419e-af56-3c14bf6c6f83",
                    "organizationName" => "Điện lực Mang Yang",
                    "code" => "PC10MM"
                ],
                [
                    "id" => "0068ba3d-d5b6-453a-a5fe-5dbf589bc71d",
                    "organizationName" => "Điện lực Chư Prông",
                    "code" => "PC10NN"
                ],
                [
                    "id" => "c7c89f2b-791f-4e97-ae1a-d66912fd3adc",
                    "organizationName" => "Điện lực Chư Pưh",
                    "code" => "PC10PP"
                ],
                [
                    "id" => "8c95863e-f95f-4af5-9b61-d4d803e39856",
                    "organizationName" => "Điện lực Phú Thiện",
                    "code" => "PC10OO"
                ],
                [
                    "id" => "d6f7c5c6-e335-4d08-8bc8-becc5fff6a20",
                    "organizationName" => "Đội QLVH Lưới điện Cao thế",
                    "code" => "PC10ZZ"
                ]
            ]
        ],
        [
            'code' => 'PC11',
            'name' => 'Công ty điện lực Kom Tum',
            'subOrgCodes' => [
                [
                    "id" => "180d9879-f4cb-41d4-b441-f97c98ec9026",
                    "organizationName" => "ĐL TP Kon Tum",
                    "code" => "PC11AA"
                ],
                [
                    "id" => "71054549-716d-495f-9ffd-38197e672720",
                    "organizationName" => "ĐL Kon Rầy",
                    "code" => "PC11BB"
                ],
                [
                    "id" => "abb034bf-420d-431f-9ab6-faa1b09ebae5",
                    "organizationName" => "ĐL Đăk Tô",
                    "code" => "PC11CC"
                ],
                [
                    "id" => "7f42d421-4777-459d-afdf-86f28876e83f",
                    "organizationName" => "ĐL Đăk Hà",
                    "code" => "PC11DD"
                ],
                [
                    "id" => "76513ba5-8b0d-4c95-b338-a7406af29823",
                    "organizationName" => "ĐL Sa Thầy",
                    "code" => "PC11EE"
                ],
                [
                    "id" => "716d1e5d-496a-4bf6-aa39-ba60f10eb368",
                    "organizationName" => "Điện lực Ngọc Hồi",
                    "code" => "PC11FF"
                ],
                [
                    "id" => "b4d7df5c-3907-430f-ad92-8505eff65061",
                    "organizationName" => "ĐL Đăk Glei",
                    "code" => "PC11GG"
                ],
                [
                    "id" => "d77f4d7b-7fb6-43f2-8a75-5f95a8ab7b4b",
                    "organizationName" => "ĐL Kon Plong",
                    "code" => "PC11II"
                ],
                [
                    "id" => "e4737e5c-7979-4169-9b7b-57beb512791b",
                    "organizationName" => "ĐL Tu Mơ Rông",
                    "code" => "PC11KK"
                ]
            ]
        ],
        [
            'code' => 'PC12',
            'name' => 'Công ty điện lực Đắk Lắk',
            'subOrgCodes' => [
                [
                    "id" => "aa859936-8021-4f44-aeb1-81001e265bf5",
                    "organizationName" => "ĐL Bắc Buôn Ma Thuột",
                    "code" => "PC12AA"
                ],
                [
                    "id" => "afe39c2c-e0b9-4e1a-83c2-268bd5120cb4",
                    "organizationName" => "ĐL Krông Păc",
                    "code" => "PC12BB"
                ],
                [
                    "id" => "dc7a510e-23b0-44e0-a8ae-b33298274630",
                    "organizationName" => "ĐL Nam Buôn Ma Thuột",
                    "code" => "PC12CC"
                ],
                [
                    "id" => "4060d9f6-d26d-4659-94fc-4ae1fb761ad5",
                    "organizationName" => "ĐL Buôn Hồ",
                    "code" => "PC12DD"
                ],
                [
                    "id" => "20544709-c78e-47e1-989d-7bc1a186c116",
                    "organizationName" => "ĐL Buôn Đôn",
                    "code" => "PC12EE"
                ],
                [
                    "id" => "80033a3e-fd59-46c9-b41c-59ccd5676e67",
                    "organizationName" => "ĐL Krông Buk",
                    "code" => "PC12FF"
                ],
                [
                    "id" => "7da4cdb0-b743-4ed8-b904-7eb1261c2726",
                    "organizationName" => "ĐL Cư MGar",
                    "code" => "PC12GG"
                ],
                [
                    "id" => "47272453-82fb-40da-b176-4aac559b7b45",
                    "organizationName" => "ĐL Cư Kuin",
                    "code" => "PC12HH"
                ],
                [
                    "id" => "15547584-3b43-4b5b-a5aa-e517c9799167",
                    "organizationName" => "ĐL EaH'Leo",
                    "code" => "PC12II"
                ],
                [
                    "id" => "93f2c89a-2de7-4488-88ca-73ce68d5df49",
                    "organizationName" => "ĐL Krông Năng",
                    "code" => "PC12JJ"
                ],
                [
                    "id" => "414cb9b3-9683-45ec-b691-f061997e2d6b",
                    "organizationName" => "ĐL EaKar",
                    "code" => "PC12KK"
                ],
                [
                    "id" => "edc08fc7-3146-4fc3-a61c-c18ea68784a3",
                    "organizationName" => "ĐL Krông Ana",
                    "code" => "PC12LL"
                ],
                [
                    "id" => "b7457a62-8c15-4dcc-9c82-09438e69cd25",
                    "organizationName" => "ĐL Ea Súp",
                    "code" => "PC12MM"
                ],
                [
                    "id" => "7b7fdad6-9f9e-4c2d-8f55-c278fcb17d09",
                    "organizationName" => "ĐL KRông Bông",
                    "code" => "PC12NN"
                ],
                [
                    "id" => "0ffa2bd1-b80a-4782-b40f-009fd43995b9",
                    "organizationName" => "ĐL Lăk",
                    "code" => "PC12PP"
                ],
                [
                    "id" => "a36b0c80-7404-461f-8306-ec122749d369",
                    "organizationName" => "ĐL M'drăk",
                    "code" => "PC12QQ"
                ],
                [
                    "id" => "6296c974-bed1-47ad-bb99-7ad8a963afc3",
                    "organizationName" => "Đội QLVH Lưới điện Cao thế",
                    "code" => "PC12ZZ"
                ]
            ]
        ],
        [
            'code' => 'PC13',
            'name' => 'Công ty điện lực Đắk Nông',
            'subOrgCodes' => [
                [
                    "id" => "35ac6e56-8d4b-41d0-be3f-904508e0e444",
                    "organizationName" => "ĐL ĐăkRlấp",
                    "code" => "PC13BB"
                ],
                [
                    "id" => "ce798b32-6746-4310-aac5-51b53a1df716",
                    "organizationName" => "ĐL Cư Jút",
                    "code" => "PC13CC"
                ],
                [
                    "id" => "f661b976-9af9-4da9-aaa4-57770366a090",
                    "organizationName" => "ĐL Đăk Mil",
                    "code" => "PC13DD"
                ],
                [
                    "id" => "c4919990-8518-4f8c-a052-47a10150c322",
                    "organizationName" => "ĐL Krông Nô",
                    "code" => "PC13EE"
                ],
                [
                    "id" => "fd171b62-a832-4a2d-8bcb-47c7ef75903d",
                    "organizationName" => "ĐL Gia Nghĩa",
                    "code" => "PC13FF"
                ],
                [
                    "id" => "ca4badd9-c4b8-4f19-ab54-1ce014095d1c",
                    "organizationName" => "ĐL Đăk GLong",
                    "code" => "PC13GG"
                ],
                [
                    "id" => "5b44f6ed-75ce-4276-83c2-2981bc88b5dd",
                    "organizationName" => "ĐL Đăk Song",
                    "code" => "PC13HH"
                ],
                [
                    "id" => "7ecb0997-6504-40ce-ae05-36e0856ed0b5",
                    "organizationName" => "ĐL Tuy Đức",
                    "code" => "PC13II"
                ],
                [
                    "id" => "97238a48-0538-4554-aff0-fe4123fc8a6a",
                    "organizationName" => "Đội QLVH Lưới điện cao thế",
                    "code" => "PC13ZZ"
                ]
            ]
        ],
        [
            'code' => 'PP',
            'name' => 'Công ty TNHH MTV điện lực Đà Nẵng',
            'subOrgCodes' => [
                [
                    "id" => "e97adab0-e4cf-458c-b410-a9dee018f4e3",
                    "organizationName" => "Điện lực Hải Châu",
                    "code" => "PP0100"
                ],
                [
                    "id" => "b75a27b2-88bf-470d-ac0d-432c6506641f",
                    "organizationName" => "Điện lực Liên Chiểu",
                    "code" => "PP0300"
                ],
                [
                    "id" => "4905b2ea-1a1d-4c57-83e6-b955bfb822db",
                    "organizationName" => "Điện lực Sơn Trà",
                    "code" => "PP0500"
                ],
                [
                    "id" => "89dc090c-0b9d-4c31-90db-b09e6656c7ea",
                    "organizationName" => "Điện lực Cẩm Lệ",
                    "code" => "PP0700"
                ],
                [
                    "id" => "911b46d3-41dc-4fa1-b6f5-a11e4b8daa8c",
                    "organizationName" => "Điện lực Thanh Khê",
                    "code" => "PP0900"
                ],
                [
                    "id" => "6a23be6d-76a4-4cb5-8a8b-091b65fde4a4",
                    "organizationName" => "Điện lực Hòa Vang",
                    "code" => "PP0800"
                ],
                [
                    "id" => "e852c9c5-21e1-4a1e-bfab-6c2d320375e4",
                    "organizationName" => "Quản lý lưới điện Cao thế",
                    "code" => "PP00ZZ"
                ]
            ]
        ],
        [
            'code' => 'PQ',
            'name' => 'Công ty CP Điện Lực Khánh Hòa',
            'subOrgCodes' => [
                [
                    "id" => "b90525e6-7471-4feb-8b4a-40b997b2c0a5",
                    "organizationName" => "Phòng Kinh doanh Công ty",
                    "code" => "PQ0100"
                ],
                [
                    "id" => "2e4ae325-22a0-4885-b8c7-3bdef9e87e3c",
                    "organizationName" => "ĐL Nha Trang",
                    "code" => "PQ0200"
                ],
                [
                    "id" => "66883d26-c7ae-41fd-9fda-2528684f0c8b",
                    "organizationName" => "ĐL Cam Ranh",
                    "code" => "PQ0300"
                ],
                [
                    "id" => "34ab9e4c-cc1c-49b5-8222-d2826428a98f",
                    "organizationName" => "ĐL Ninh Hòa",
                    "code" => "PQ0400"
                ],
                [
                    "id" => "b480eaa7-5a2f-465e-b715-519fde90f669",
                    "organizationName" => "ĐL Diên Khánh",
                    "code" => "PQ0500"
                ],
                [
                    "id" => "4f2b7713-3a2a-4682-a870-b89b38ce2f3b",
                    "organizationName" => "ĐL Vạn Ninh",
                    "code" => "PQ0600"
                ],
                [
                    "id" => "7b9e7c77-9ba9-42c6-acd6-29dadabe30c6",
                    "organizationName" => "ĐL Cam Ranh - KHÁNH SƠN",
                    "code" => "PQ0700"
                ],
                [
                    "id" => "155f0f19-c9e8-45f8-a3eb-f32e608790d0",
                    "organizationName" => "ĐL Diên Khánh - KHÁNH VĨNH",
                    "code" => "PQ0800"
                ],
                [
                    "id" => "c5f60190-b456-4b8f-b998-6d59b86944fd",
                    "organizationName" => "ĐL Vĩnh Hải",
                    "code" => "PQ0900"
                ],
                [
                    "id" => "2f34a458-70da-4184-9a3e-b18e3dd522ce",
                    "organizationName" => "ĐL Vĩnh Nguyên",
                    "code" => "PQ1000"
                ],
                [
                    "id" => "c2d33cae-b713-4482-b137-ab98551eedf2",
                    "organizationName" => "ĐL Cam Lâm",
                    "code" => "PQ1100"
                ]
            ]
        ],
    ];

    // Đọc chỉ số từ tệp
    $indexFile = storage_path('app/current_index.txt');
    $currentIndex = file_exists($indexFile) ? (int) file_get_contents($indexFile) : 0;
    $subOrgCodes = $orgCodes[$currentIndex]['subOrgCodes'];
    $subOrgCodes = array_filter($subOrgCodes, function ($subOrg) {
        if (strpos($subOrg['code'], 'ZZ') !== false) {
            return false;
        }
        return true;
    });
    $orgCode = $orgCodes[$currentIndex]['code'];
    $currentIndex++;

    if ($currentIndex >= count($orgCodes)) {
        $currentIndex = 0;
    }

    file_put_contents($indexFile, $currentIndex);

    foreach ($subOrgCodes as $subOrg) {
        try {
            $response = Http::get('https://cskh-api.cpc.vn/api/remote/outages/area', [
                'orgCode' => $orgCode,
                'subOrgCode' => $subOrg['code'], // Sử dụng subOrgCode
                'fromDate' => '2024-10-09 00:00:00',
                'toDate' => '2024-10-17 23:59:59',
                'page' => 1,
                'limit' => 10,
            ]);

            // Log the response for debugging
            Log::info('API Response for ' . $subOrg['organizationName'] . ':', $response->json());

        } catch (\Exception $e) {
            // Log the error message
            Log::error('Error fetching data for ' . $subOrg['organizationName'] . ': ' . $e->getMessage());
        }
    }
    // try {
    //     $response = Http::get('https://cskh-api.cpc.vn/api/remote/outages/area', [
    //         'orgCode' => $orgCode,
    //         'subOrgCode' => '',
    //         'fromDate' => '2024-10-09 00:00:00',
    //         'toDate' => '2024-10-17 23:59:59',
    //         'page' => 1,
    //         'limit' => 10,
    //     ]);

    //     // Log the response for debugging
    //     Log::info('API Response:', $response->json());

    //     return $response->json();
    // } catch (\Exception $e) {
    //     // Log the error message
    //     Log::error('Error fetching data: ' . $e->getMessage());
    // }
})->everyTwoMinutes();
