<?php

// user credentials
$GLOBALS['USER_PASSWORD'] = '@llth3th!ng$';

// TicketNow
$GLOBALS['TICKETNOW_DIR'] = 'tickets_db';
$GLOBALS['TICKETNOW_MAX_SIDEBAR'] = 30;

// ’

$GLOBALS['HELP'] = [
    'Linux' => [
            'help_linux_ssh' => 'Connecting With ssh',
            'help_linux_sysadmin' => 'Linux Sysadmin Quick Reference',
            'help_linux_vi' => 'Vi Quick Reference',
        ],

    'Ansible' => [
            'help_ansible_ansible' => 'Ansible References',
            'help_ansible_galaxy' => 'Ansible Galaxy',
        ],

    'TicketNow' => [
            'help_ticketnow_api_intro' => 'API Intro',
            'help_ticketnow_api_authentication' => 'API Authentication',
            'help_ticketnow_api_post_ticketnow' => 'API Create New Ticket',
            'help_ticketnow_api_put_ticketnow' => 'API Modify Existing Ticket',
            'help_ticketnow_api_get_ticketnow' => 'API Get Ticket',
        ],

    ];


$GLOBALS['LESSONS'] = [
    'Getting Started' => [
            'lessons_getting_started_agenda' => 'Agenda',
            'lessons_getting_started_connecting_to_control' => 'Connecting to the Control Server',
            'lessons_getting_started_ansiblecfg' => 'Introducing ansible.cfg',
            'lessons_getting_started_inventry' => 'Inventories',
        ],

    'Ansible Essentials' => [
            'lessons_ansible_essentials_agenda' => 'Agenda',
            'lessons_ansible_essentials_adhoc' => 'Ad-hoc Commands',
            'lessons_ansible_essentials_first_playbook' => 'Your First Playbook',
            'lessons_ansible_essentials_loops_variables' => 'Adding Variables, Loops, and a Handler',
            'lessons_ansible_essentials_roles' => 'Modularity, Via Roles',
        ],

    'Graduating to Ansible Tower' => [
            'lessons_ansible_tower_agenda' => 'Agenda',
            'lessons_ansible_tower_credentials' => 'Creating a Credential',
            'lessons_ansible_tower_project' => 'Creating a Project',
            'lessons_ansible_tower_template' => 'Your First Template',
            'lessons_ansible_tower_surveys' => 'Adding Surveys to Templates',
            'lessons_ansible_tower_workflow' => 'Implementing a Multi-domain Workflow',
        ],

    'Ansible Beyond Linux' => [
            'lessons_beyond_linux_agenda' => 'Agenda',
            'lessons_beyond_linux_windows' => 'Windows Automation',
            'lessons_beyond_linux_api_ticketing' => 'API Integration',
        ],

];

?>
