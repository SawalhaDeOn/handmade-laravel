<?php

namespace App\Enums;

class DropDownFields
{
    const MARITAL_STATUS  = 'marital_status';
    const ALHAYAT_BRANCHES = 'alhayat_branches';
    const BLOOD_TYPE = [
        ['value' => 'A+'],
        ['value' => 'A-'],
        ['value' => 'B+'],
        ['value' => 'B-'],
        ['value' => 'O+'],
        ['value' => 'O-'],
        ['value' => 'AB+'],
        ['value' => 'AB-'],
    ];
    const category = 'category_type';
    const MEMBERSHIP_TYPE = 'membership_type';
    const EXTERNAL_APPT_STATUS = 'external_app_status';
    const MEMBERSHIP_SUBTYPE = 'membership_subtype';
    // const RELATION_TYPE = 'relation_type';
    const IDENTITY_TYPE = 'identity_type';
    const PATIENT_RELATIVES = 'patient_relatives';

    const Payment_Types = 'payment_types';
    const Employee_Types = 'employee_types';

    const SICK_FUND = 'sick_fund';
    const status = 'status';
    const type = 'type';
    const ATTACHMENT_TYPE = 'attachment_type';

    const PROCEDURE_TYPE = 'procedure_type';
    const PROCEDURE_FEE_TYPE = 'procedure_fee_type';
    const INVOICE_TYPE = 'invoice_type';

    const CALL_ACTION = 'call_action';
    const CALL_PATIENT_ACTION = 'call_patient_action';

    const SHORT_MESSAGE = 'short_message';
    const SHORT_MESSAGE_TEMPLATE = 'short_message_template';
    const QUESTIONNAIRE_TYPE = 'questionnaire_type';

    const HOSITPAL_TYPE = 'hositpal_type';
    const CLINIC_SERVICE_TYPE = 'clinic_service_type';
    const CLINIC_TEAM_CONTACT_TYPE = 'clinic_team_contact_type';
    const CLINIC_TEAM_TITLE_TYPE = 'clinic_team_title_type';
    const CLINIC_TEAM_WORKING_SHIFT = 'clinic_team_working_shift';
    const DOCTOR_TYPE = 'doctor_type';

    const Pro_Types = 'pro_type';
    const Card_Types = 'card_type';
    const DOCTOR_SERVICE_TYPE = 'doctor_service_type';
    const SYSTEM_NOTIFICATION_TYPE = 'system_notification_type';
    const SMS_NOTIFICATION_TYPE = 'sms_notification_type';
    const CALL_OPTION_TYPE = 'call_option_type';
    const URGENCY_EXTERNAL_APPT = 'urgency_external_appt';
    const EXTERNAL_APPT_SERVICE_TYPE = 'external_appt_service_type';
    const EXTERNAL_APPT_RECOMMENDATIONS = 'external_appt_recommendations';
    const UERGANCY_COVERAGE_REQUEST = 'uergancy_coverage_request';
    const MEDICATION_COVERAGE_PERIOD = 'medication_coverage_period';
    const TREATMENT_SERVICE_TYPE = 'treatment_service_type';
    const COMPLAIN_TYPE = 'complain_type';
}
