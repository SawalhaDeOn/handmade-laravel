<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $Menu = [
            [
                "name" => "لوحة التحكم",
                "name_en" => "Dashboard",
                "name_he" => "Dashboard",
                "route" => "home",
                "icon_svg" => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect x="2" y="2" width="9" height="9" rx="2" fill="currentColor"></rect>
                                    <rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2" fill="currentColor"></rect>
                                    <rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2" fill="currentColor"></rect>
                                    <rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2" fill="currentColor"></rect>
                                </svg>',
                "order" => 1,
                "permission_name" => "dashboard_access",
            ],

            [
                "name" => "إدارة المستخدمين",
                "name_en" => "User Management",
                "name_he" => "User Management",
                "route" => NULL,
                "icon_svg" => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6.28548 15.0861C7.34369 13.1814 9.35142 12 11.5304 12H12.4696C14.6486 12 16.6563 13.1814 17.7145 15.0861L19.3493 18.0287C20.0899 19.3618 19.1259 21 17.601 21H6.39903C4.87406 21 3.91012 19.3618 4.65071 18.0287L6.28548 15.0861Z" fill="currentColor"></path>
                                <rect opacity="0.3" x="8" y="3" width="8" height="8" rx="4" fill="currentColor"></rect>
                            </svg>',
                "order" => 2,
                "permission_name" => NULL,
                "subRoutes" => [
                    [
                        "name" => "المستخدمين",
                        "name_en" => "Users",
                        "name_he" => "משתמשים",
                        "route" => "user-management.users.index",
                        "icon_svg" => NULL,
                        "order" => 3,
                        "permission_name" => "user_management_access",
                    ],
                    [
                        "name" => "الصلاحيات",
                        "name_en" => "Roles",
                        "name_he" => "Roles",
                        "route" => "user-management.roles.index",
                        "icon_svg" => NULL,
                        "order" => 4,
                        "permission_name" => "user_management_access",
                    ],
                ]
            ],
            [
                "name" => "الاعدادات",
                "name_en" => "Settings",
                "name_he" => "Settings",
                "route" => NULL,
                "icon_svg" => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path opacity="0.3" d="M5 8.04999L11.8 11.95V19.85L5 15.85V8.04999Z" fill="currentColor"></path>
                                <path d="M20.1 6.65L12.3 2.15C12 1.95 11.6 1.95 11.3 2.15L3.5 6.65C3.2 6.85 3 7.15 3 7.45V16.45C3 16.75 3.2 17.15 3.5 17.25L11.3 21.75C11.5 21.85 11.6 21.85 11.8 21.85C12 21.85 12.1 21.85 12.3 21.75L20.1 17.25C20.4 17.05 20.6 16.75 20.6 16.45V7.45C20.6 7.15 20.4 6.75 20.1 6.65ZM5 15.85V7.95L11.8 4.05L18.6 7.95L11.8 11.95V19.85L5 15.85Z" fill="currentColor"></path>
                                </svg>',
                "order" => 5,
                "permission_name" => NULL,
                "subRoutes" => [
                    [
                        "name" => "الدول والمدن",
                        "name_en" => "Countries and Cities",
                        "name_he" => "Countries and Cities",
                        "route" => "settings.country-city.index",
                        "icon_svg" => NULL,
                        "order" => 6,
                        "permission_name" => "settings_country_city_access",
                    ],
                    [
                        "name" => "القائمة الرئيسية",
                        "name_en" => "Menu",
                        "name_he" => "Menu",
                        "route" => "settings.menus.index",
                        "icon_svg" => NULL,
                        "order" => 7,
                        "permission_name" => "settings_menu_access",
                    ],
                    [
                        "name" => "استبيانات",
                        "name_en" => "Questionnaires",
                        "name_he" => "Questionnaires",
                        "route" => "settings.questionnaires.index",
                        "icon_svg" => NULL,
                        "order" => 8,
                        "permission_name" => "settings_questionnaire_access",
                    ],
                    [
                        "name" => "الثوابت",
                        "name_en" => "Constants",
                        "name_he" => "Constants",
                        "route" => "settings.constants.index",
                        "icon_svg" => NULL,
                        "order" => 9,
                        "permission_name" => "settings_constants_access",
                    ],

                ]
            ],


            [
                "name" => "الخدمات",
                "name_en" => "Service",
                "name_he" => "Service",
                "route" => NULL,
                "icon_svg" => '<!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/General/Smile.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"  viewBox="0 0 24 24" version="1.1">
    <title>Stockholm-icons / General / Smile</title>
    <desc>Created with Sketch.</desc>
    <defs/>
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect x="0" y="0" width="24" height="24"/>
        <rect fill="currentColor"  x="2" y="2" width="20" height="20" rx="10"/>
        <path d="M6.16794971,14.5547002 C5.86159725,14.0951715 5.98577112,13.4743022 6.4452998,13.1679497 C6.90482849,12.8615972 7.52569784,12.9857711 7.83205029,13.4452998 C8.9890854,15.1808525 10.3543313,16 12,16 C13.6456687,16 15.0109146,15.1808525 16.1679497,13.4452998 C16.4743022,12.9857711 17.0951715,12.8615972 17.5547002,13.1679497 C18.0142289,13.4743022 18.1384028,14.0951715 17.8320503,14.5547002 C16.3224187,16.8191475 14.3543313,18 12,18 C9.64566871,18 7.67758127,16.8191475 6.16794971,14.5547002 Z" fill="#000"/>
    </g>
</svg>',
                "order" => 13,
                "permission_name" => "service_access",
                "subRoutes" => [
                    [
                        "name" => "عرض الخدمات",
                        "name_en" => "Services",
                        "name_he" => "Services",
                        "route" => "services.index",
                        "icon_svg" => NULL,
                        "order" => 14,
                        "permission_name" => "service_access",
                    ],


                ]
            ],

            [
                "name" => "قائمةالموقع  ",
                "name_en" => "Menu-website",
                "name_he" => "Menu",
                "route" => "menuWebsite.index",
                "order" => 8,
                "permission_name" => "settings_menu_access",
                "icon_svg" => '<!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Layout/Layout-horizontal.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">

    <defs/>
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect x="0" y="0" width="24" height="24"/>
        <rect fill="#fff" opacity="0.3" x="4" y="5" width="16" height="6" rx="1.5"/>
        <rect fill="#fff" x="4" y="13" width="16" height="6" rx="1.5"/>
    </g>
</svg>',
                "subRoutes" => [
                    [
                        "name" => "عرض قائمة الموقع",
                        "name_en" => "Menu-website",
                        "name_he" => "Menu-website",
                        "route" => "menuWebsite.index",
                        "icon_svg" => NULL,
                        "order" => 14,
                        "permission_name" => "settings_menu_access",
                    ],

                ],
            ],
            [
                "name" => "إدارة Feature",
                "name_en" => "Feature Management",
                "name_he" => "Feature Management",
                "route" => NULL,
                "icon_svg" => '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect id="bound" x="0" y="0" width="24" height="24"/>
        <path d="M13.5,6 C13.33743,8.28571429 12.7799545,9.78571429 11.8275735,10.5 C11.8275735,10.5 12.5,4 10.5734853,2 C10.5734853,2 10.5734853,5.92857143 8.78777106,9.14285714 C7.95071887,10.6495511 7.00205677,12.1418252 7.00205677,14.1428571 C7.00205677,17 10.4697177,18 12.0049375,18 C13.8025422,18 17,17 17,13.5 C17,12.0608202 15.8333333,9.56082016 13.5,6 Z" id="Path-17" fill="#fff"/>
        <path d="M9.72075922,20 L14.2792408,20 C14.7096712,20 15.09181,20.2754301 15.2279241,20.6837722 L16,23 L8,23 L8.77207592,20.6837722 C8.90818997,20.2754301 9.29032881,20 9.72075922,20 Z" id="Rectangle-49" fill="#fff" opacity="0.3"/>
    </g>
</svg>',
                "order" => 2,
                "permission_name" => NULL,
                "subRoutes" => [
                    [
                        "name" => "Feature",
                        "name_en" => "Features",
                        "name_he" => "Features",
                        "route" => "features.index",
                        "icon_svg" => NULL,
                        "order" => 3,
                        "permission_name" => "feature_access",
                    ],

                ]
            ],
            [
                "name" => "إدارة Slider",
                "name_en" => "Slider Management",
                "name_he" => "Slider Management",
                "route" => NULL,
                "icon_svg" => '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect id="bound" x="0" y="0" width="24" height="24"/>
        <circle id="Combined-Shape" fill="#fff" cx="9" cy="15" r="6"/>
        <path d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z" id="Combined-Shape" fill="#fff" opacity="0.3"/>
    </g>
</svg>',
                "order" => 2,
                "permission_name" => NULL,
                "subRoutes" => [
                    [
                        "name" => "Slider",
                        "name_en" => "Sliders",
                        "name_he" => "Sliders",
                        "route" => "sliders.index",
                        "icon_svg" => NULL,
                        "order" => 3,
                        "permission_name" => "slider_access",
                    ],

                ]
            ],

            [
                "name" => "إدارة Review",
                "name_en" => "Review Management",
                "name_he" => "Review Management",
                "route" => NULL,
                "icon_svg" => '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect id="bound" x="0" y="0" width="24" height="24"/>
        <path d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z" id="Path-2" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
        <path d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z" id="Path" fill="#fff" fill-rule="nonzero"/>
        <rect id="Combined-Shape" fill="#fff" opacity="0.3" x="9" y="10.5" width="4" height="1" rx="0.5"/>
    </g>
</svg>',
                "order" => 2,
                "permission_name" => NULL,
                "subRoutes" => [
                    [
                        "name" => "Review",
                        "name_en" => "Reviews",
                        "name_he" => "Reviews",
                        "route" => "reviews.index",
                        "icon_svg" => NULL,
                        "order" => 3,
                        "permission_name" => "review_access",
                    ],

                ]
            ],            [
                "name" => "الزبائن",
                "name_en" => "Client",
                "name_he" => "Client",
                "route" => NULL,
                "icon_svg" => '<!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/General/Smile.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"  viewBox="0 0 24 24" version="1.1">
    <title>Stockholm-icons / General / Smile</title>
    <desc>Created with Sketch.</desc>
    <defs/>
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect x="0" y="0" width="24" height="24"/>
        <rect fill="currentColor"  x="2" y="2" width="20" height="20" rx="10"/>
        <path d="M6.16794971,14.5547002 C5.86159725,14.0951715 5.98577112,13.4743022 6.4452998,13.1679497 C6.90482849,12.8615972 7.52569784,12.9857711 7.83205029,13.4452998 C8.9890854,15.1808525 10.3543313,16 12,16 C13.6456687,16 15.0109146,15.1808525 16.1679497,13.4452998 C16.4743022,12.9857711 17.0951715,12.8615972 17.5547002,13.1679497 C18.0142289,13.4743022 18.1384028,14.0951715 17.8320503,14.5547002 C16.3224187,16.8191475 14.3543313,18 12,18 C9.64566871,18 7.67758127,16.8191475 6.16794971,14.5547002 Z" fill="#000"/>
    </g>
</svg>',
                "order" => 13,
                "permission_name" => "client_access",
                "subRoutes" => [
                    [
                        "name" => "عرض الزبائن",
                        "name_en" => "Clients",
                        "name_he" => "Clients",
                        "route" => "clients.index",
                        "icon_svg" => NULL,
                        "order" => 14,
                        "permission_name" => "client_access",
                    ],
                    [
                        "name" => "إضافة الزبائن",
                        "name_en" => "Add Clients",
                        "name_he" => "Add Clients",
                        "route" => "clients.create",
                        "icon_svg" => NULL,
                        "order" => 15,
                        "permission_name" => "client_access",
                    ]

                ]
            ],

            [
                "name" => " طلبات ",
                "name_en" => "Leads",
                "name_he" => "Leads",
                "route" => "leads.index|leads.create",
                "icon_svg" => '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
    <title>Stockholm-icons / Communication / Clipboard-check</title>
    <desc>Created with Sketch.</desc>
    <defs/>
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect x="0" y="0" width="24" height="24"/>
        <path d="M8,3 L8,3.5 C8,4.32842712 8.67157288,5 9.5,5 L14.5,5 C15.3284271,5 16,4.32842712 16,3.5 L16,3 L18,3 C19.1045695,3 20,3.8954305 20,5 L20,21 C20,22.1045695 19.1045695,23 18,23 L6,23 C4.8954305,23 4,22.1045695 4,21 L4,5 C4,3.8954305 4.8954305,3 6,3 L8,3 Z" fill="currentColor" />
        <path d="M10.875,15.75 C10.6354167,15.75 10.3958333,15.6541667 10.2041667,15.4625 L8.2875,13.5458333 C7.90416667,13.1625 7.90416667,12.5875 8.2875,12.2041667 C8.67083333,11.8208333 9.29375,11.8208333 9.62916667,12.2041667 L10.875,13.45 L14.0375,10.2875 C14.4208333,9.90416667 14.9958333,9.90416667 15.3791667,10.2875 C15.7625,10.6708333 15.7625,11.2458333 15.3791667,11.6291667 L11.5458333,15.4625 C11.3541667,15.6541667 11.1145833,15.75 10.875,15.75 Z" fill="#000000"/>
        <path d="M11,2 C11,1.44771525 11.4477153,1 12,1 C12.5522847,1 13,1.44771525 13,2 L14.5,2 C14.7761424,2 15,2.22385763 15,2.5 L15,3.5 C15,3.77614237 14.7761424,4 14.5,4 L9.5,4 C9.22385763,4 9,3.77614237 9,3.5 L9,2.5 C9,2.22385763 9.22385763,2 9.5,2 L11,2 Z" fill="#000000"/>
    </g>
</svg>',
                "order" => 29,
                "permission_name" => "leads_module_access",
                "subRoutes" => [


                    [
                        "name" => "الطلبات",
                        "name_en" => "Leads",
                        "name_he" => "Leads",
                        "route" => "leads.index|leads.create",
                        "icon_svg" => '',
                        "order" => 31,
                        "permission_name" => "lead_module_access",
                    ],


                ],

            ],

            [
                "name" => "الاشعارات",
                "name_en" => "Conversations",
                "name_he" => "Conversations",
                "route" => NULL,
                "icon_svg" => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path opacity="0.3" d="M14 3V20H2V3C2 2.4 2.4 2 3 2H13C13.6 2 14 2.4 14 3ZM11 13V11C11 9.7 10.2 8.59995 9 8.19995V7C9 6.4 8.6 6 8 6C7.4 6 7 6.4 7 7V8.19995C5.8 8.59995 5 9.7 5 11V13C5 13.6 4.6 14 4 14V15C4 15.6 4.4 16 5 16H11C11.6 16 12 15.6 12 15V14C11.4 14 11 13.6 11 13Z" fill="currentColor"/>
                <path d="M2 20H14V21C14 21.6 13.6 22 13 22H3C2.4 22 2 21.6 2 21V20ZM9 3V2H7V3C7 3.6 7.4 4 8 4C8.6 4 9 3.6 9 3ZM6.5 16C6.5 16.8 7.2 17.5 8 17.5C8.8 17.5 9.5 16.8 9.5 16H6.5ZM21.7 12C21.7 11.4 21.3 11 20.7 11H17.6C17 11 16.6 11.4 16.6 12C16.6 12.6 17 13 17.6 13H20.7C21.2 13 21.7 12.6 21.7 12ZM17 8C16.6 8 16.2 7.80002 16.1 7.40002C15.9 6.90002 16.1 6.29998 16.6 6.09998L19.1 5C19.6 4.8 20.2 5 20.4 5.5C20.6 6 20.4 6.60005 19.9 6.80005L17.4 7.90002C17.3 8.00002 17.1 8 17 8ZM19.5 19.1C19.4 19.1 19.2 19.1 19.1 19L16.6 17.9C16.1 17.7 15.9 17.1 16.1 16.6C16.3 16.1 16.9 15.9 17.4 16.1L19.9 17.2C20.4 17.4 20.6 18 20.4 18.5C20.2 18.9 19.9 19.1 19.5 19.1Z" fill="currentColor"/>
                </svg>',
                "order" => 23,
                "permission_name" => NULL,
                "subRoutes" => [
                    [
                        "name" => "WhatsApp",
                        "name_en" => "WhatsApp",
                        "name_he" => "WhatsApp",
                        "route" => "conversations.whatsapp_history.index",
                        "icon_svg" => NULL,
                        "order" => 24,
                        "permission_name" => "whatsapp_history_access",
                    ],
                    [
                        "name" => "Tawk",
                        "name_en" => "Tawk",
                        "name_he" => "Tawk",
                        "route" => "conversations.tawk.index",
                        "icon_svg" => NULL,
                        "order" => 24,
                        "permission_name" => "tawk_access",
                    ],
                    [
                        "name" => "SMS",
                        "name_en" => "SMS",
                        "name_he" => "SMS",
                        "route" => "conversations.sms.index",
                        "icon_svg" => NULL,
                        "order" => 25,
                        "permission_name" => "sys_sms_notify_access",
                    ],
                    [
                        "name" => "الاشعارات",
                        "name_en" => "Notifications",
                        "name_he" => "Notifications",
                        "route" => "conversations.sys_notifications.index",
                        "icon_svg" => NULL,
                        "order" => 26,
                        "permission_name" => "sys_notifications_access",
                    ],
                ]
            ],

            [
                "name" => "CDR",
                "name_en" => "CDR",
                "name_he" => "CDR",
                "route" => "cdr.index",
                "icon_svg" => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path opacity="0.3" d="M5 15C3.3 15 2 13.7 2 12C2 10.3 3.3 9 5 9H5.10001C5.00001 8.7 5 8.3 5 8C5 5.2 7.2 3 10 3C11.9 3 13.5 4 14.3 5.5C14.8 5.2 15.4 5 16 5C17.7 5 19 6.3 19 8C19 8.4 18.9 8.7 18.8 9C18.9 9 18.9 9 19 9C20.7 9 22 10.3 22 12C22 13.7 20.7 15 19 15H5ZM5 12.6H13L9.7 9.29999C9.3 8.89999 8.7 8.89999 8.3 9.29999L5 12.6Z" fill="currentColor"/>
                                <path d="M17 17.4V12C17 11.4 16.6 11 16 11C15.4 11 15 11.4 15 12V17.4H17Z" fill="currentColor"/>
                                <path opacity="0.3" d="M12 17.4H20L16.7 20.7C16.3 21.1 15.7 21.1 15.3 20.7L12 17.4Z" fill="currentColor"/>
                                <path d="M8 12.6V18C8 18.6 8.4 19 9 19C9.6 19 10 18.6 10 18V12.6H8Z" fill="currentColor"/>
                                </svg>',
                "order" => 28,
                "permission_name" => "cdr_access",
            ],






        ];


        DB::table('menus')->delete();

        foreach ($Menu as $menuItem) {
            // dd($menuItem);
            $parent = Menu::updateOrCreate([
                "name" => $menuItem['name'],
                "name_en" => $menuItem['name_en'],
                "name_he" => $menuItem['name_he'],
                "route" => $menuItem['route'],
                "icon_svg" => $menuItem['icon_svg'],
                "order" => $menuItem['order'],
                "permission_name" => $menuItem['permission_name'],
            ]);
            if (isset($menuItem["subRoutes"])) {
                foreach ($menuItem["subRoutes"] as $subMenu) {
                    Menu::updateOrCreate([
                        "name" => $subMenu['name'],
                        "name_en" => $subMenu['name_en'],
                        "name_he" => $subMenu['name_he'],
                        "route" => $subMenu['route'],
                        "icon_svg" => $subMenu['icon_svg'],
                        "order" => $subMenu['order'],
                        "permission_name" => $subMenu['permission_name'],
                        "parent_id" => $parent->id,
                    ]);
                }
            }
        }

        $this->command->info('Menu created successfully!');
    }
}
