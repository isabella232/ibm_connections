<?php
if (!defined('sugarEntry') || !sugarEntry) {
    die('Not A Valid Entry Point');
}
/*********************************************************************************
 * The contents of this file are subject to the SugarCRM Master Subscription
 * Agreement ("License") which can be viewed at
 * http://www.sugarcrm.com/crm/master-subscription-agreement
 * By installing or using this file, You have unconditionally agreed to the
 * terms and conditions of the License, and You may not use this file except in
 * compliance with the License.  Under the terms of the license, You shall not,
 * among other things: 1) sublicense, resell, rent, lease, redistribute, assign
 * or otherwise transfer Your rights to the Software, and 2) use the Software
 * for timesharing or service bureau purposes such as hosting the Software for
 * commercial gain and/or for the benefit of a third party.  Use of the Software
 * may be subject to applicable fees and any use of the Software without first
 * paying applicable fees is strictly prohibited.  You do not have the right to
 * remove SugarCRM copyrights from the source code or user interface.
 *
 * All copies of the Covered Code must include on each user interface screen:
 *  (i) the "Powered by SugarCRM" logo and
 *  (ii) the SugarCRM copyright notice
 * in the same form as they appear in the distribution.  See full license for
 * requirements.
 *
 * Your Warranty, Limitations of liability and Indemnity are expressly stated
 * in the License.  Please refer to the License for the specific language
 * governing these rights and limitations under the License.  Portions created
 * by SugarCRM are Copyright (C) 2004-2014 SugarCRM, Inc.; All Rights Reserved.
 ********************************************************************************/


$fields =
    array(
        'id' => array(
            'name' => 'id',
            'type' => 'id',
            'source' => 'non-db',
        ),        
        'community_id' => array(
            'name' => 'community_id',
            'type' => 'varchar',
            'source' => 'non-db',
        ),
        'files' => array(
            'name' => 'files',
            'type' => 'array',
            'source' => 'non-db',
        ),
        'activities' => array(
            'name' => 'activities',
            'type' => 'array',
            'source' => 'non-db',
        ),
        'name' => array(
            'name' => 'name',
            'type' => 'varchar',
            'source' => 'non-db',
            'unified_search' => true,
        ),
        'url' => array(
            'name' => 'url',
            'type' => 'varchar',
            'source' => 'non-db',
            'unified_search' => true,
        ),
        'access' => array(
            'name' => 'access',
            'type' => 'enum',
            'source' => 'non-db',
            'unified_search' => true,
        ),
        'logo' => array(
            'name' => 'logo',
            'type' => 'varchar',
            'source' => 'non-db',
        ),
        'tags' => array(
            'name' => 'tags',
            'type' => 'varchar',
            'source' => 'non-db',
        ),
        'link' => array(
            'name' => 'link',
            'type' => 'varchar',
            'source' => 'non-db',
        ),
        'member_count' => array(
            'name' => 'member_count',
            'type' => 'int',
            'source' => 'non-db',
        ),
        'type' => array(
            'name' => 'type',
            'type' => 'varchar',
            'source' => 'non-db',
        ),
        'checked' => array(
            'name' => 'checked',
            'type' => 'boolean',
            'source' => 'non-db',
        ),
        'author_id' => array(
            'name' => 'author_id',
            'type' => 'id',
            'source' => 'non-db',
        ),
        'author_name' => array(
            'name' => 'author_name',
            'type' => 'varchar',
            'source' => 'non-db',
        ),
        'author_status' => array(
            'name' => 'author_status',
            'type' => 'varchar',
            'source' => 'non-db',
        ),
        'author_email' => array(
            'name' => 'author_email',
            'type' => 'varchar',
            'source' => 'non-db',
        ),
        'updated' => array(
            'name' => 'updated',
            'type' => 'varchar',
            'source' => 'non-db',
        ),
        'members' =>
            array (
                'name' => 'members',
                'type' => 'link',
                'relationship' => 'ibm_community_members',
                'module' => 'ibm_connectionsMembers',
                'bean_name' => 'ibm_connectionsMembers',
                'source' => 'non-db',
                'vname' => 'ibm_connectionsMembers',
            ),

    );

$dictionary['ibm_connectionsCommunity'] =
    array(
        'fields' => $fields,
        'mergedFields' => array('id', 'name'),
        'activity_enabled' => false,
        'unified_search' => false,
        'favorites' => false,
        'relationships' =>
            array (
                'ibm_community_members' => array (
                    'lhs_module' => 'ibm_connectionsCommunity',
                    'lhs_key' => 'id',
                    'rhs_module' => 'ibm_connectionsMembers',
                    'rhs_key' => 'community_id',
                    'relationship_type' => 'one-to-many',
                ),
            )


    );

VardefManager::createVardef('ibm_connectionsCommunity', 'ibm_connectionsCommunity');
