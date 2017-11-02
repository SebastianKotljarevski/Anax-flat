<?php

namespace Anax\AddOn\PHPBB;

/**
 * Create a interface for PHPBB.
 *
 */
class CInterface
{

    /**
     * Sample function to integrate with a phpbb installation and lend some
     * information on the authorized user.
     *
     * @param string $path is the install path of PHPBB.
     * @return array with details of user.
     */
    public function getSessionDetails($path)
    {
        global $phpbb_root_path, $phpEx, $user, $db, $config, $cache, $template, $auth;

        // Enable to work even if forum is not available
        if (!is_file("$path/webb.config")) {
            return [
                'is_anonymous'  => "No one",
                'user_acronym'  => "NoOne",
                'user_email'    => "noone@dbwebb.se",
                'session_id'    => null,
            ];
        }

        define('IN_PHPBB', true);
        $phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : $path;
        $phpEx = "php"; //substr(strrchr(__FILE__, '.'), 1);
        include("$path/common.php");

        // Start session management
        $user->session_begin();
        $auth->acl($user->data);
        $user->setup();

        return [
            'is_anonymous'  => ($user->data['user_id'] == ANONYMOUS),
            'user_acronym'  => $user->data['username_clean'],
            'user_email'    => $user->data['user_email'],
            'session_id'    => $user->data['session_id'],
        ];
    }



 /**
   * Get latest topics.
   *
   * @param int $max items to return.
   * @return array
   */
   /*
  public function LatestTopics($max=3) {
    global $auth, $db;

    // Create arrays
    $topics = array();
    
    // Get forums that current user has read rights to.
    $forums = array_unique(array_keys($auth->acl_getf('f_read', true)));
    
    // Get active topics.
    $sql="SELECT *
    FROM " . TOPICS_TABLE . "
    WHERE topic_approved = '1' AND " . $db->sql_in_set('forum_id', $forums) . "
    ORDER BY topic_last_post_time DESC";
    $result = $db->sql_query_limit($sql, $max);
    while ($r = $db->sql_fetchrow($result)) {
        $topics[] = $r;
    }
    $db->sql_freeresult($result);
    
    $items = array();
    foreach($topics as $t) {
      // Get folder img, topic status/type related information
      //$topic_tracking_info = get_complete_topic_tracking($t['forum_id'], $t['topic_id']);
      //$unread_topic = (isset($topic_tracking_info[$t['topic_id']]) && $t['topic_last_post_time'] > $topic_tracking_info[$t['topic_id']])
        ? true
        : false;
      //topic_status($t, $t['topic_replies'], $unread_topic, $folder_img, $folder_alt, $topic_type);
      // href = $phpbb_root_path
        . 'viewtopic.php?f='
        . $t['forum_id']
        . '&amp;t='
        . $t['topic_id']
        . '&amp;p='
        . $t['topic_last_post_id']
        . '#p'
        . $t['topic_last_post_id'];
      $item['forum_id'] = $t['forum_id'];
      $item['topic_id'] = $t['topic_id'];
      $item['topic_last_post_id'] = $t['topic_last_post_id'];
      $item['topic_title'] = $t['topic_title'];
      $items[] = $item;
    }

    return($items);
  }
*/
}
