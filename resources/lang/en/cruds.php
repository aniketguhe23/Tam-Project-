<?php

return [
    'userManagement'  => [
        'title'          => 'User management',
        'title_singular' => 'User management',
    ],
    'permission'      => [
        'title'          => 'Permissions',
        'title_singular' => 'Permission',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'title'             => 'Title',
            'title_helper'      => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'role'            => [
        'title'          => 'Roles',
        'title_singular' => 'Role',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'title'              => 'Title',
            'title_helper'       => ' ',
            'permissions'        => 'Permissions',
            'permissions_helper' => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
        ],
    ],
    'user'            => [
        'title'          => 'Users',
        'title_singular' => 'User',
        'fields'         => [
            'id'                       => 'ID',
            'id_helper'                => ' ',
            'name'                     => 'Name',
            'name_helper'              => ' ',
            'email'                    => 'Email',
            'email_helper'             => ' ',
            'email_verified_at'        => 'Email verified at',
            'email_verified_at_helper' => ' ',
            'password'                 => 'Password',
            'password_helper'          => ' ',
            'roles'                    => 'Roles',
            'roles_helper'             => ' ',
            'remember_token'           => 'Remember Token',
            'remember_token_helper'    => ' ',
            'created_at'               => 'Created at',
            'created_at_helper'        => ' ',
            'updated_at'               => 'Updated at',
            'updated_at_helper'        => ' ',
            'deleted_at'               => 'Deleted at',
            'deleted_at_helper'        => ' ',
        ],
    ],  
    'bookappointment'        => [
        'title'              => 'Book Appointments',
        'title_singular'     => 'Book Appointment',
        'fields'             => [
            'id'                         => 'ID',
            'id_helper'                  => ' ',
            'url'                          => 'Url',
            'url_helper'                 => ' ',
            'created_at'                 => 'Created at',
            'created_at_helper'          => ' ',
            'updated_at'                 => 'Updated at',
            'updated_at_helper'          => ' ',
            'deleted_at'                 => 'Deleted at',
            'deleted_at_helper'          => ' ',
        ],
    ],
    'privacypolicy'        => [
        'title'              => 'Privacy Policys',
        'title_singular'     => 'Privacy Policy',
        'fields'             => [
            'id'                         => 'ID',
            'id_helper'                  => ' ',
            'title'                      => 'Title',
            'title_helper'               => ' ',
            'token_key'                  => 'Key',
            'token_key_helper'           => ' ',
            'url'                        => 'Url',
            'url_helper'                 => ' ',
            'created_at'                 => 'Created at',
            'created_at_helper'          => ' ',
            'updated_at'                 => 'Updated at',
            'updated_at_helper'          => ' ',
            'deleted_at'                 => 'Deleted at',
            'deleted_at_helper'          => ' ',
        ],
    ],
    'category'        => [
        'title'          => 'Categories',
        'title_singular' => 'Categories',
        'fields'         => [
            'id'                         => 'Id',
            'id_helper'                  => ' ',
            'category_name'              => 'Categories Name',
            'category_name_helper'       => ' ',
            'created_at'                 => 'Created at',
            'created_at_helper'          => ' ',
            'updated_at'                 => 'Updated at',
            'updated_at_helper'          => ' ',
            'deleted_at'                 => 'Deleted at',
            'deleted_at_helper'          => ' ',
        ],
    ],
    'resourcecategory'        => [
        'title'          => 'Resource Categories',
        'title_singular' => 'Resource Categories',
        'fields'         => [
            'id'                         => 'Id',
            'id_helper'                  => ' ',
            'resource_category'         => 'Resource Categories',
            'resource_category_helper' => ' ',
            'created_at'                 => 'Created at',
            'created_at_helper'          => ' ',
            'updated_at'                 => 'Updated at',
            'updated_at_helper'          => ' ',
            'deleted_at'                 => 'Deleted at',
            'deleted_at_helper'          => ' ',
        ],
    ],
    'librarycategory'        => [
        'title'          => 'Library Categories',
        'title_singular' => 'Library Categories',
        'fields'         => [
            'id'                         => 'Id',
            'id_helper'                  => ' ',
            'library_category'           => 'Library Categories',
            'library_category_helper'    => ' ',
            'created_at'                 => 'Created at',
            'created_at_helper'          => ' ',
            'updated_at'                 => 'Updated at',
            'updated_at_helper'          => ' ',
            'deleted_at'                 => 'Deleted at',
            'deleted_at_helper'          => ' ',
        ],
    ],
    'library'        => [
        'title'          => 'Library',
        'title_singular' => 'Library',
        'fields'         => [
            'id'                         => 'Id',
            'id_helper'                  => ' ',
            'link'                       => 'Link ',
            'link_helper'                => ' ',
            'library_category'           => 'Category ',
            'library_category_helper'    => ' ',
            'source'                     => 'Source',
            'source_helper'              => ' ',
            'description'                => 'Description',
            'description_helper'         => ' ',
            'created_at'                 => 'Created at',
            'created_at_helper'          => ' ',
            'updated_at'                 => 'Updated at',
            'updated_at_helper'          => ' ',
            'deleted_at'                 => 'Deleted at',
            'deleted_at_helper'          => ' ',
        ],
    ],
    'counselor'        => [
        'title'          => 'Counsellors',
        'title_singular' => 'Counsellor',
        'fields'         => [
            'id'                         => 'ID',
            'id_helper'                  => ' ',
            'counselor_name'             => 'Counsellor Name',
            'counselor_name_helper'      => ' ',
            'user_name'                  => 'User Name',
            'user_name_helper'           => ' ',
            'date'                       => 'Date',
            'date_helper'                => ' ',
            'age'                        => 'Age',
            'age_helper'                 => ' ',
            'gender'                     => 'Gender',
            'gender_helper'              => ' ',
            'topic'                      => 'Topic',
            'topic_helper'               => ' ',
            'user_location'              => 'User Location',
            'user_location_helper'       => ' ',
            'queue_no'                   => 'Queue No',
            'queue_no_helper'            => ' ',
            'chat_type'                  => 'Chat Type',
            'chat_type_helper'           => ' ',
            'counselor_assignment'       => 'Counsellor Assignment',
            'counselor_assignment_helper'=> ' ',
            'active_chat'                => 'Active Chat',
            'active_chat_helper'         => ' ',
            'category'                   => 'Category',
            'category_helper'            => ' ',
            'feedback'                   => 'Feedback',
            'feedback_helper'            => ' ',
            'email'                      => 'Email id',
            'email_helper'              => ' ',
            'phone_no'                   => 'Phone No',
            'phone_no_helper'            => ' ',
            'password'                   => 'Password',
            'password_helper'            => ' ',
            'created_at'                 => 'Created at',
            'created_at_helper'          => ' ',
            'updated_at'                 => 'Updated at',
            'updated_at_helper'          => ' ',
            'deleted_at'                 => 'Deleted at',
            'deleted_at_helper'          => ' ',
        ],
    ],
    'counselorassignment'        => [
        'title'          => 'CounsellorAssignments',
        'title_singular' => 'CounsellorAssignment',
        'fields'         => [
            'id'                         => 'ID',
            'id_helper'                  => ' ',
            'counselor_name'             => 'Counsellor Name',
            'counselor_name_helper'       => ' ',
            'category'                   => 'Categorise',
            'category_helper'            => ' ',
            'user'                       => 'User',
            'user_helper'                => ' ',
            'created_at'                 => 'Created at',
            'created_at_helper'          => ' ',
            'updated_at'                 => 'Updated at',
            'updated_at_helper'          => ' ',
            'deleted_at'                 => 'Deleted at',
            'deleted_at_helper'          => ' ',
        ],
    ],
    'current_cases'        => [
        'title'          => 'Counsellor Current Cases',
        'title_singular' => 'Counsellor Current Cases',
        'fields'         => [
            'id'                         => 'ID',
            'id_helper'                  => ' ',
            'current_cases_name'         => 'Name',
            'current_cases_name_helper'  => ' ',
            'current_cases_age'         => 'Age',
            'current_cases_age_helper'  => ' ',
            'current_cases_gender'       => 'Gender',
            'current_cases_gender_helper'  => ' ',
            'current_cases_topic'         => 'Topic',
            'current_cases_topic_helper'  => ' ',
            'current_cases_date'         => 'Date',
            'current_cases_date_helper'  => ' ',
            'current_cases_chat_type'    => 'Chat Type',
            'current_cases_chat_type_helper'  => ' ',
            'current_cases_assigment'    => 'Assigment Counsellor',
            'current_cases_assigment_helper'  => ' ',
            'current_cases_categories'    => 'Categories',
            'current_cases_categories_helper'  => ' ',
            'created_at'                 => 'Created at',
            'created_at_helper'          => ' ',
            'updated_at'                 => 'Updated at',
            'updated_at_helper'          => ' ',
            'deleted_at'                 => 'Deleted at',
            'deleted_at_helper'          => ' ',
        ],
    ],
     'past_cases'        => [
        'title'          => 'Counsellor Past Cases',
        'title_singular' => 'Counsellor Past Cases',
        'fields'         => [
            'id'                         => 'ID',
            'id_helper'                  => ' ',
            'past_cases_name'         => 'Name',
            'past_cases_name_helper'  => ' ',
            'past_cases_age'         => 'Age',
            'past_cases_age_helper'  => ' ',
            'past_cases_gender'       => 'Gender',
            'past_cases_gender_helper'  => ' ',
            'past_cases_topic'         => 'Topic',
            'past_cases_topic_helper'  => ' ',
            'past_cases_date'         => 'Date',
            'past_cases_date_helper'  => ' ',
            'past_cases_chat_type'    => 'Chat Type',
            'past_cases_chat_type_helper'  => ' ',
            'past_cases_feedback'        => 'Feedback',
            'past_cases_feedback_helper'  => ' ',
            'past_cases_assigment'    => 'Assigment Counsellor',
            'past_cases_assigment_helper'  => ' ',
            'past_cases_categories'    => 'Categories',
            'past_cases_categories_helper'  => ' ',
            'created_at'                 => 'Created at',
            'created_at'                 => 'Created at',
            'created_at_helper'          => ' ',
            'updated_at'                 => 'Updated at',
            'updated_at_helper'          => ' ',
            'deleted_at'                 => 'Deleted at',
            'deleted_at_helper'          => ' ',
        ],
    ],
    'tamhub'        => [
        'title'          => 'Tam Hubs',
        'title_singular' => 'Tam Hub',
        'fields'         => [
            'id'                         => 'ID',
            'id_helper'                  => ' ',
            'organisation_name'          => 'Organisation Name',
            'organisation_name_helper'   => ' ',
            'city'                       => 'Citys',
            'city_helper'                => ' ',
            'areas'                      => 'Areas',
            'areas_helper'               => ' ',
            'services'                   => 'Services',
            'services_helper'            => ' ',
            'special_note'               => 'Special Note',
            'special_note_helper'        => ' ',
            'contact_no'                 => 'Contact No',
            'contact_no_helper'          => ' ',
            'email_id'                   => 'Email Id',
            'email_id_helper'            => ' ',
            'website_link'               => 'Website Link',
            'website_link_helper'        => ' ',
            'address'                    => 'Address',
            'address_helper'             => ' ',
            'created_at'                 => 'Created at',
            'created_at_helper'          => ' ',
            'updated_at'                 => 'Updated at',
            'updated_at_helper'          => ' ',
            'deleted_at'                 => 'Deleted at',
            'deleted_at_helper'          => ' ',
        ],
    ],
    'taskManagement'  => [
        'title'          => 'Task management',
        'title_singular' => 'Task management',
    ],
    'taskStatus'      => [
        'title'          => 'Statuses',
        'title_singular' => 'Status',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'category_id'       => 'Category_id',
            'category_id_helper'=> ' ',
            'email_id'          => 'email_id',
            'email_id_helper'   => ' ',
            'phone_no'          => 'Phone_no',
            'phone_no_helper'   => ' ',
            'password'          => 'Password',
            'password_helper'   => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated At',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted At',
            'deleted_at_helper' => ' ',
        ],
    ],
    'taskTag'         => [
        'title'          => 'Tags',
        'title_singular' => 'Tag',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated At',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted At',
            'deleted_at_helper' => ' ',
        ],
    ],
    'task'            => [
        'title'          => 'Tasks',
        'title_singular' => 'Task',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'name'               => 'Name',
            'name_helper'        => ' ',
            'description'        => 'Description',
            'description_helper' => ' ',
            'status'             => 'Status',
            'status_helper'      => ' ',
            'tag'                => 'Tags',
            'tag_helper'         => ' ',
            'attachment'         => 'Attachment',
            'attachment_helper'  => ' ',
            'due_date'           => 'Due date',
            'due_date_helper'    => ' ',
            'assigned_to'        => 'Assigned to',
            'assigned_to_helper' => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated At',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted At',
            'deleted_at_helper'  => ' ',
        ],
    ],
    'tasksCalendar'   => [
        'title'          => 'Calendar',
        'title_singular' => 'Calendar',
    ],
];
