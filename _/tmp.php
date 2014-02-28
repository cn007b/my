
links

  http://www.xe.com/

backup
  sudo apt-get install bacula-fd

  /etc/bacula/bacula-fd.conf
  #
  # Default  Bacula File Daemon Configuration file
  #
  #  For Bacula release 5.2.5 (26 January 2012) -- ubuntu 12.04
  #
  # There is not much to change here except perhaps the
  # File daemon Name to
  #

  #
  # List Directors who are permitted to contact this File daemon
  #
  Director {
    Name = bacula-dir
    Password = "iEkco_H2LSl8cIX8"
  }

  #
  # Restricted Director, used by tray-monitor to get the
  #   status of the file daemon
  #
  #Director {
  #  Name = kovpak-mon
  #  Password = "kJhtbOjirYBy6nqfxQ2OlKdn9NqcL3EfW"
  #  Monitor = yes
  #}

  #
  # "Global" File daemon configuration specifications
  #
  FileDaemon {                          # this is me
    Name = kovpak
    FDport = 9102                  # where we listen for the director
    WorkingDirectory = /var/lib/bacula
    Pid Directory = /var/run/bacula
    Maximum Concurrent Jobs = 20
    FDAddress = 192.168.12.184
  }

  # Send all messages except skipped files back to Director
  Messages {
    Name = Standard
    director = bacula-dir = all, !skipped, !restored
  }

url
  : %3A
  / %2F

scp

  scp -rp access@host:~/dir/ ~/dir/

diff

  colordiff -u file1 file2

mail
  mail -s "s" mail@com.com < .htaccess
  uuencode card.jpg card.jpg | mail mail@com.com

curl
  # show ip
  curl -Iq http://2ip.ru | grep IP | awk '{print $2}'

crun
  PATH=/bin:/usr/bin:/usr/local/bin
  CRUN_REMOTE_HOST=Host
  CRUN_EMAIL=mail@com.com
  CRUN_WORK_DIR=/var/www/vhosts/host/htdocs

cdata

  <![CDATA[]]>

debug
  error_reporting(E_ALL); // error_reporting(E_ALL & ~E_NOTICE);
  ini_set("display_errors", 1);
  ini_set('display_startup_errors','On');

  xdebug_start_trace('c:/data/fac.xt');
  xdebug_stop_trace();

  // debug tables:
  array_walk($d, create_function('&$i, $k, $c', 'if (empty($c)) {$c=array_keys($i);} $i="<tr><td>".implode("</td><td>",$i)."</td></tr>";'), &$c);
  echo "<table border=1 cellspacing=0 cellpadding=3 bordercolor='#BFBFBF'><tr bgcolor='#ADD8E6' align=center><td>".implode("</td><td>",$c)."</td></tr>".implode("",$d)."</table>";
  require_once SITE_PATH.'Table.php';
  $tbl = new Console_Table();
  $tbl->setHeaders(array_keys($d[0]));
  foreach($d as $v){$tbl->addRow($v);}
  echo '<pre>'.$tbl->getTable().'</pre>';

phpDoc

  phpdoc run -d . -t doc

phpUnit

  /usr/share/php/PHPUnit/Extensions/SeleniumTestCase.php

mySqlDump
  mysqldump -h hostname -u user -d --skip-triggers --single-transaction --complete-insert --extended-insert --quote-names dbname tablename |gzip > sql.gz
  mysqldump -hHost Base table | gzip | uuencode table.gz | mail mail@com.com -s table
  mysqldump -h Host Base table --where="id=11" | mail mail@com.com
  php-mysqldump -h HOST -u USER -a table -f sql -e "SELECT * FROM table LIMIT 10"
  mysql -h Host -D Base -te "SELECT NOW()" | mail mail@com.com
  mysql -hHost -uUser -pPass base ~ table
  mysql -h Host -D Base -e "select * from table where id in (1,2);" | gzip | pv | uuencode result.csv.gz | mail mail@com.com -s "query result"
  zcat table.gz | host -uUser -pPass base

smarty

  {get_assoc array=$matrix key=$id assoc="other"}

SNIPPETS
  fwrite(STDOUT, __METHOD__ . "\n");
  prompt \u@\h [\d]>
  find -type f -mtime -20 | while read file; do modif=`git log -1 --format="%cd" $file`; echo "$modif - $file"; done
  # Shows file types that present in foolder
  find . -type f | perl -ne 'print $1 if m/\.([^.\/]+)$/' | sort -u
  time find -name '*.php' -mtime -1 | xargs -l php -l | grep -v "No syntax errors detected in"
  find ./ | grep '.php' | xargs -l php -l | pv | grep -v "No syntax errors detected in"
  # skype Vdovin
  cat /tmp/alcuda_tech.log | grep -Eo --color=never '^\[\S+\s+[^\*][^:]+' | sed -r 's/^\S+\s+//g' | sort | uniq -c | sort -nr | head -30
  find -type f -name '*.php' -exec egrep -l 'class\s+ProfileManager' {} \;
  find -name '*.htm' -exec touch {} \;
  find -type f -name '*.php' -exec egrep -Hn --color=always 'is_failed' {} \; | grep profile





AFF

rivals
  http://affiliates.cupid.com/
  http://pussycash.com/
  http://adultfriendfinder.com/p/partners/main.cgi
  http://datingfactory.com/
  http://www.datinggold.com/
  http://affiliate.sexsearch.com/

xmlt debug
  $client->setDebug(1);
  ini_set('memory_limit', '512M');

ban aff from .htaccess
  #RewriteCond %{QUERY_STRING} c42bf7b6
  #RewriteRule ^(.*) - [F]

stub
  $countBefore = array_shift(db()->getCol('SELECT count(id) FROM t'));
  $countBefore--;
  $countAfter = array_shift(db()->getCol('SELECT count(id) FROM t'));
  if ($countBefore+count($queries) > $countAfter) {
      mail('mail@com.com', "DBG|!!! $countBefore, $countAfter", var_export($countAfter-$countBefore,1));
  }





MULTI

track code format

  AFF [WAP] [REG|CONF|PAY] [(coreg)]

Pixel
  {$profile_details.country}
  {$site_id}
  {$profile_id}
  {$order_id}
  {$amount.GBP}
  {if $referer_details.data1=='JamesBond'}mi6{/if}
  {if registration_country_code()=='GBR'}4.65{/if}
  {if $smarty.session.MEMBER.type_id == 2}upforit_comF{else}upforit_comM{/if}
  {if in_array($brand.wl.wl_site_id, array(3818, 3788, 4047, 4262, 5656))}
  <img src="" width="0" height="0" border="0" style="display:none;" />
  <img src="http://host/pixel.php?pid={$profile_id}" border="0" height="0" width="0">
  <img src="http://host/scripts/track_pixel_order.php?order_date={$order_date}&profile_id={$profile_id}&order_id={$order_id}&order_amount={$order_amount}&order_currency={$order_currency}&order_type={$order_type}" border="0" height="0" width="0">
  <img src="http://host/scripts/test_pixel.php?transaction_id={$referer_details.clickid}&public_id={$profile_details.public_id}&OrderID={$profile_id}" width="0" height="0" border="0" style="display:none;" />

TRAFFICS
  Since august 2012 become ppc.php before was exp_cp.php.
  If URL contains a_aid                                         = it is CPA traffic,
  if URL contains a_aid and a_bid                               = it is INTERNAL traffic,
  If URL contains ext.php                                       = it is DD traffic,
  If URL contains ppc_cp                                        = it is PPC traffic (one in a BRAND traffics),
  /?utm_campaing=camp1&utm_source=source&track_referer=1        = SEO traff

translations
  # Make changes in needed *.po file an run:
  msgfmt file.po -o file.mo
  # and flush cache (if it neded)
  vim inc/models/Translations.php +178 code:$output = false;
  # and
  cd locale && make

countries ip
  $remaddrarr = array(
    "USA" => "69.73.178.240",
    "CAN" => "24.48.176.0",
    "NZL" => "58.84.224.3",
    "IND" => "58.146.96.3",
    "AUS" => "202.138.16.3",
    "AUT" => "62.47.255.255",
    "GBR" => "86.141.47.163",
    "ESP" => "62.93.160.3",
    "FRA" => "62.160.230.10",
    "TUR" => "94.54.0.3",
    "ITA" => "212.14.140.2",
    "DEU" => "77.185.208.234",
    "UKR" => "176.36.52.108",
  );
  if ($_SERVER['SCRIPT_NAME'] != '/base/login.php')  {
     $_SERVER['REMOTE_ADDR'] = $remaddrarr["ESP"];
  }

mysql.inc
  inc/mysql.inc.php 1857
  if ($_COOKIE['d']) define('nodbg',1);
  !defined('dbg') or defined('nodbg') or print('<span style="color:#A52A2A"><pre>'.str_ireplace(' from ', "<b style='color:#0000FF'> from </b>", $sql->show()).';<hr></pre></span>');

ee.url
  pr(
      $current_start_period.'('.date('Y-m-d', $current_start_period).') - '.$current_end_period.'('.date('Y-m-d', $current_end_period).'), action '.strtotime($params['action_date']).' ('.$params['action_date'].')',
      "entry_min_minus3($mktime_filter_entry_min_minus3):".date('Y-m-d', $mktime_filter_entry_min_minus3)." entry_min_minus30($mktime_filter_entry_min_minus30):".date('Y-m-d', $mktime_filter_entry_min_minus30)." entry_min_minus7($mktime_filter_entry_min_minus7):".date('Y-m-d', $mktime_filter_entry_min_minus7),
      "entry_max_minus3($mktime_filter_entry_max_minus3):".date('Y-m-d', $mktime_filter_entry_max_minus3)." entry_max_minus30($mktime_filter_entry_max_minus30):".date('Y-m-d', $mktime_filter_entry_max_minus30)." entry_max_minus7($mktime_filter_entry_max_minus7):".date('Y-m-d', $mktime_filter_entry_max_minus7)
  );
  if (isset($_GET['d'])) define('nodbg',1);
  $s = ppc_build_query('remarketing_ext', $queries['select_parts'], $params);
  pr($s);
  $s = $s->show();
  $p = strpos($s, ' FROM ');
  $s = substr($s, $p, strlen($s)-$p);
  $p = strpos($s, ' GROUP BY ');
  $s = substr($s, 0, $p);
  $s = "SELECT traf.pid, ers.site_name, o.created_at, o.amount, o.currency, o.status {$s} ";
  $d = $objDB->GetAll($s);
  if (!empty($d)) {
      array_walk($d, create_function('&$i, $k, $c', 'if (empty($c)) {$c=array_keys($i);} $i="<tr><td>".implode("</td><td>",$i)."</td></tr>";'), &$c);
      echo "<table border=1 cellspacing=0 cellpadding=3 bordercolor='#BFBFBF'><tr bgcolor='#ADD8E6' align=center><td>".implode("</td><td>",$c)."</td></tr>".implode("",$d)."</table>";
  }


  cron/external_remarketing_stat_collect.php
  api/remarketing_external.stat.php

  scp -P 10063 ppc/ppc.entryaction.url.casual.php                       multi-rel-work@lgw.am.hwtool.net:~/htdocs/ppc/ppc.entryaction.url.casual.php
  scp -P 10063 repository/admin/smarty/ppc.entryaction.url.casual.htm   multi-rel-work@lgw.am.hwtool.net:~/htdocs/repository/admin/smarty/ppc.entryaction.url.casual.htm
  scp -P 10063 ppc/ppc.entryaction.url.include.new.php                  multi-rel-work@lgw.am.hwtool.net:~/htdocs/ppc/ppc.entryaction.url.include.new.php
  scp -P 10063 ppc/ppc.entryaction.url.include.php                      multi-rel-work@lgw.am.hwtool.net:~/htdocs/ppc/ppc.entryaction.url.include.php
  scp -P 10063 ppc/ppc.entryaction.url.include.casual.php               multi-rel-work@lgw.am.hwtool.net:~/htdocs/ppc/ppc.entryaction.url.include.casual.php

ex rm
  inc/external_registration/ExternalRemarketingProfile.php
  cron/external_remarketing_stat_collect.php
  api/remarketing_external.stat.php

stub

  define('MOBILE_WEB_APP_JS_DEBUG', 1); - use not minified js file
  $user = new User($user_id);
  $user->GetFields(array('siteID', 'id', 'email', 'screenname', 'password', 'user_key', 'type_id'));
  // to acces on sandbox in base write in inc/config_am.php
  define('STAFF_PASSWORD_HASH_SAULT', 'trunk_password_sault');
  // and use 1111 pass





PHOENIX

_
  cd protected/tests && phpunit protected/tests/unit/affiliates/ && cd -
  tail -f /home/kovpak/logs/error.log

LIVE
  arm sync Kovpak
  arm workers
  arm unlock

old
  find -iname .git -type d
  ~/bin/phoenix /home/kovpak/htdocs/px update
  sh protected/tools/deploy

ssh
  platformphoenix.com
  fusermount -u /home/kovpak/web/kovpak/px

TODO:
  Pixels.
  RBAC.
  Fix Assets & client script.
  Global logger.
  Mailer.
  [low] Finalize CSS.
  [low] Просмотр на гостевой детальной информации по программам.
  [low] Admin registration

migrate
  php protected/yiic.php migrate
  php protected/yiic.php migrate create LastName_#_Desc
  php protected/yiic.php migrate redo 1
  php protected/yiic.php migrate down 1

live user

  playcougar       codenamek2010+961@gmail.com c961c961       https://www.playcougar.com/site/autologin?key=9657fab2d2ccb8cfacb2da6f2c8d1489&crmMessageId=c0df0506e3eb11e292b2d4bed9a94a8f&eml=1&uniqmessageId=92d20330d04a4d3ca60fa59268acf5ce&open=search

module
  $this->configure([
      'components' => [
            'foo' => [
                'class'  => 'application.modules.affiliates.components.Foo',
            ],
      ],
  ]);


  // private $companyName = 'AlcudaLimited';
  // return 'AlcudaLimited';
  // return 'EnedinaLtd';
  // return 'MassinteractiveServicesLimited';
  // return 'WoodrockMaltaLimited';

  Yii::app()->eTrack->getSources()





  login types :
  default
  autologinCrm
  autologinCookie

  url param `utm_source` contains source.

  /home/kovpak/web/kovpak/px/protected/components/Tracking.php
  /home/kovpak/web/kovpak/px/protected/extensions/track/ETrack.php



  Yii::app()->cache->set($key, array($value), $duration);

eQueueManager
  $data = ['200'];
  $queueName = 'DBG.PX.AFF.SAVETOSTACK.2';
  echo "\n".$queueName;
  echo "\ndeleteQueue";
  // echo Yii::app()->eQueueManager->deleteQueue($queueName);
  echo "\nCount=";
  echo Yii::app()->eQueueManager->getMessagesCount($queueName);
  echo "\nputMessage";
  Yii::app()->eQueueManager->putMessage($data, $queueName);
  echo "\nCount=";
  echo Yii::app()->eQueueManager->getMessagesCount($queueName);
  echo "\n getMessages";
  $m = Yii::app()->eQueueManager->getMessages($queueName, 1, true);
  echo "\nCount=";
  echo Yii::app()->eQueueManager->getMessagesCount($queueName);
  echo "\ngetMessageBody (true)";
  $b = json_decode(Yii::app()->eQueueManager->getMessageBody($m[0]), true);
  if ($b == $data) {
      echo "\nackMessage";
      Yii::app()->eQueueManager->ackMessage($m[0]);
  }
  echo "\nCount=";
  // echo Yii::app()->eQueueManager->getMessagesCount($queueName);
  echo "\nputMessage again";
  Yii::app()->eQueueManager->putMessage($data, $queueName);
  echo "\nCount=";
  // echo Yii::app()->eQueueManager->getMessagesCount($queueName);
  echo "\ngetMessageBody";
  $b = json_decode(Yii::app()->eQueueManager->getMessageBody($m[0]));
  echo "\nCount=";
  // echo Yii::app()->eQueueManager->getMessagesCount($queueName);
  echo "\n";

eDataCollector
  php protected/yiic.php syncdata status --consumer=eAffiliates
  php protected/yiic.php syncdata put --consumer=eAffiliates --limit=10

sort table
  $(document).ready(function(){
          // Write on keyup event of keyword input element
          $("#kwd_search").keyup(function(){
              // When value of the input is not blank
          var term=$(this).val()
              if( term != "")
              {
                  // Show only matching TR, hide rest of them
                  $("#my-table tbody>tr").hide();
              $("#my-table td").filter(function(){
                 return $(this).text().toLowerCase().indexOf(term ) >-1
              }).parent("tr").show();
              }
              else
              {
                  // When there is no input or clean again, show everything back
                  $("#my-table tbody>tr").show();
              }
          });
      });

graphs
  http://teethgrinder.co.uk/open-flash-chart/gallery-data.php
  http://www.jqplot.com/tests/cursor-highlighter.php

transaction
  CREATE TABLE IF NOT EXISTS `transaction` (
      `id` INT(1) UNSIGNED NOT NULL AUTO_INCREMENT,
      `date` TIMESTAMP NOT NULL,
      `source` CHAR(16) NOT NULL DEFAULT '',
      `aid` VARCHAR(8) NOT NULL,
      `platform` CHAR(8) NOT NULL,
      `site` CHAR(32) NOT NULL,
      `user` CHAR(32) NOT NULL,
      `action` CHAR(16) NOT NULL,
      `order` CHAR(32) NOT NULL DEFAULT 0,
      `amount` FLOAT NOT NULL DEFAULT 0,
      `currency` CHAR(3) NOT NULL DEFAULT '',
      `isRepeat` TINYINT(1) UNSIGNED NOT NULL DEFAULT 0,
      `url` VARCHAR(255) NOT NULL DEFAULT '',
      `ip` INT(1) UNSIGNED NOT NULL DEFAULT 0,
      KEY `id` (`id`)
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8
  ;
  DROP TABLE `transaction`;