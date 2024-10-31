<?php

namespace App;

use Exception;
use Illuminate\Support\Facades\Route;

class AppPermissionsHelper
{

    /*
        :::::::: IMPORTANT NOTE ::::::::

        all permission should have postfix as one of the following
        _access
        _add
        _edit
        _delete
    */
    public static function getPermissions()
    {
        $permissions = [
            "User Management Module" => [
                "Manage" => 'user_management_access'
            ],
            "Settings Module" => [
                "Country and City" => "settings_country_city_access",
                "Menu settings" => "settings_menu_access",
                "Constants" => "settings_constants_access",
                'Questionnaires' => 'settings_questionnaire_access'
            ],

            "Call Schedule Module" => [
                "access" => "callschedule_access",
                "add" => 'callschedule_add',
                "edit" => 'callschedule_edit',
                "delete" => 'callschedule_delete',
                "view" => 'callschedule_view',
            ],

            "SMS Log" => [
                "access" => "sys_sms_notify_access",
            ],
            "WhatsApp History" => [
                "access" => "whatsapp_history_access",
            ],
            "Tawk" => [
                "access" => "tawk_access",
                "edit" => "tawk_edit",
            ],
            "System Notifications" => [
                "access" => "sys_notifications_access",
            ],
            "Complains" => [
                'access' => 'complain_access',
                'add' => 'complain_add',
                'edit' => 'complain_edit',
                'delete' => 'complain_delete',
            ],
            "Services" => [

                "access" => "service_access",
                "add" => 'service_add',
                "edit" => 'service_edit',
                "delete" => 'service_delete',
            ],

            "Reviews" => [

                "access" => "review_access",
                "add" => 'review_add',
                "edit" => 'review_edit',
                "delete" => 'review_delete',
            ],
            "Sliders" => [

                "access" => "slider_access",
                "add" => 'slider_add',
                "edit" => 'slider_edit',
                "delete" => 'slider_delete',
            ],
            "Features" => [

                "access" => "feature_access",
                "add" => 'feature_add',
                "edit" => 'feature_edit',
                "delete" => 'feature_delete',
            ],


            "Clients" => [

                "access" => "client_access",
                "add" => 'client_add',
                "edit" => 'client_edit',
                "delete" => 'client_delete',
            ],
            "Client Calls" => [
                "access" => "client_call_access",
                "add" => 'client_call_add',
                "edit" => 'client_call_edit',
                "delete" => 'client_call_delete',
            ],
            "Client SMS" => [
                "access" => "client_sms_access",
                "add" => "client_sms_add",
            ],
            "Calls Task Module" => [
                "access" => "callTasks_module_access",
                "add" => 'callTasks_module_add',
                "edit" => 'callTasks_module_edit',
                "delete" => 'callTasks_module_delete',
            ],
            "callTask_sms" => [
                "access" => "callTask_sms_access",
                "add" => "callTask_sms_add",
            ],
            "Leads" => [

                "access" => "lead_access",
                "add" => 'lead_add',
                "edit" => 'lead_edit',
                "delete" => 'lead_delete',
            ],
            "Calls Module" => [
                "access" => "calls_module_access",
                "add" => 'calls_module_add',
                "edit" => 'calls_module_edit',
                "delete" => 'calls_module_delete',
            ],
            "CDR" => [
                "access" => "cdr_access",
            ],


        ];
        $permissionFlatten = collect($permissions)->unique()->flatten(1);
        self::CheckMiddlewares($permissionFlatten);
        return $permissions;
    }

    private static function CheckMiddlewares($usedPermissions)
    {


        $routes = Route::getRoutes()->getRoutesByName();
        $remove = [
            'sanctum.csrf-cookie',  'ignition.healthCheck',
            'ignition.executeSolution',
            'ignition.updateConfig',
            'login',
            'authenticate',
            'logout',
            'home',
            'setLanguage'
        ];

        $routes = array_diff_key($routes, array_flip($remove));
        // $routeNames = array_keys($routes);

        $routesAndPermissions = [];

        foreach ($routes as $route) {
            $routeMiddleware = collect($route->action['middleware']);
            $filtered = $routeMiddleware->filter(function ($value, $key) {
                if (strpos($value, "permission:") === 0) {
                    return $value;
                }
            })->map(function ($item, $key) {
                $permission = substr($item, 11);
                $permissions = explode("|", $permission);
                return $permissions;
            })->flatten(1);
            // dd($filtered);
            foreach ($filtered as $permissionMiddleware) {
                # code...
                array_push($routesAndPermissions, $permissionMiddleware);
            }
        }
        $routesAndPermissions = collect($routesAndPermissions)->unique();
        if ($routesAndPermissions->diff($usedPermissions)->count() > 0) {

            $diff = $routesAndPermissions->diff($usedPermissions)->toArray();
            throw new Exception("Please Check AppPermissionsHelper.php file \n middleware used in web routes aren't included!" . implode(",", $diff));
        }
    }
}
