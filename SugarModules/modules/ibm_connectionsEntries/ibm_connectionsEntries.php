<?php
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

class ibm_connectionsEntries extends SugarBean
{
    public $module_dir = "ibm_connectionsEntries";
    public $object_name = "ibm_connectionsEntries";


    public function save()
    {

        $goal = ''; // Temporary! Need to add form field

        //Create and setup Connections API object
        require_once('custom/include/externalAPI/Connections/ExtAPIConnections.php');
        $connectionsApi = new ExtAPIConnections();
        $eapmBean = EAPM::getLoginInfo('Connections');
        if (!empty($eapmBean)) {
            $connectionsApi->loadEAPM($eapmBean);
        }

        if (!empty($this->due_date)) {
            $this->due_date = $GLOBALS['timedate']->asDbDate(
                $GLOBALS['timedate']->fromUserDate($this->due_date)
            );
        }
        $tag_str = str_replace(' ', ',', $this->activity_tags);
        if (!empty($tag_str)) {
            $tag = explode(',', $tag_str);
        } else {
            $tag = array();
        }

        $result = $connectionsApi->createActivityEntry($this->task_id, $this->name, $this->description, $tag);

        $activityData = IBMAtomEntry::loadFromString($result);
        $item = new ConnectionsActivity($activityData);
        $activityId = $item->getId();

        $this->id = $activityId;
        return $activityId;
    }

    public function retrieve($id)
    {

        require_once('custom/include/externalAPI/Connections/ExtAPIConnections.php');
        $connectionsApi = new ExtAPIConnections();
        $eapmBean = EAPM::getLoginInfo('Connections');
        if (!empty($eapmBean)) {
            $connectionsApi->loadEAPM($eapmBean);
        }

        $activity = $connectionsApi->getActivityNode($id);

        $this->id = $id;
        $this->name = $activity->getTitle();
        $this->goal = $activity->getSummary();
        $this->tags = $activity->getTags();
        $this->due_date = $activity->getDueDate();
        $this->description = $activity->getContent();

        return $this;
    }

}
