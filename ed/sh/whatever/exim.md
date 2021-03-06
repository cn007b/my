Exim
-

Exim is a message transfer agent (MTA).

exim4.conf:
````sh
disable_ipv6 = true
deliver_drop_privilege = yes
message_logs = no
smtp_accept_max_per_connection = 0
smtp_accept_max = 500
queue_only = true
queue_run_max = 5
deliver_queue_load_max = 5.0
domainlist local_domains = @
domainlist relay_to_domains =
hostlist   relay_from_hosts = 127.0.0.1

acl_smtp_rcpt = acl_check_rcpt
acl_smtp_data = acl_check_data

never_users = root
rfc1413_query_timeout = 0s
ignore_bounce_errors_after = 1d
bounce_return_body = false
timeout_frozen_after = 2d
spool_directory = /var/spool/exim4
split_spool_directory = true
check_spool_space = 200M
check_spool_inodes = 100
local_interfaces = 0.0.0.0.25

log_selector = +all -subject -arguments -skip_delivery -retry_defer -delay_delivery
log_file_path = /var/log/exim4/%s/log

delay_warning =
smtp_connect_backlog = 50

# представляемся корректным интерфесом
# потому что можем быть гавнистыми или пушистыми
primary_hostname = kovpak
smtp_active_hostname = ${lookup dnsdb{ptr=$received_ip_address}{$value}{$primary_hostname}}
smtp_banner = $smtp_active_hostname ESMTP Exim \
  $version_number $tod_full

received_header_text = Received: \
  ${if def:received_ip_address \
  {from [$received_ip_address] \
  (helo=$primary_hostname)\n\t}} \
  by $primary_hostname \
  ${if def:received_protocol {with $received_protocol}} \
  ${if def:tls_cipher {($tls_cipher)\n\t}}\
  (Exim $version_number)\n\t\
  ${if def:sender_address \
  {(envelope-from <$sender_address>)\n\t}}\
  id $message_exim_id\
  ${if def:received_for {\n\tfor $received_for}}

local_from_check = false
local_sender_retain = true

######################################################################
#                       ACL CONFIGURATION                            #
#         Specifies access control lists for incoming SMTP mail      #
######################################################################
begin acl

acl_check_rcpt:
  require control = dkim_disable_verify

  accept
    control = submission/sender_retain

  accept

acl_check_data:
  warn
     condition = ${if def:h_U-Email-Id:}
     logwrite = u_email_id=$h_U-Email-Id
  warn
     condition = ${if def:h_X-US-Id:}
     logwrite = X-US-Id=$h_X-US-Id

  accept


######################################################################
#                      ROUTERS CONFIGURATION                         #
#               Specifies how addresses are handled                  #
######################################################################
begin routers

system_alias:
    driver = redirect
    condition = ${if !def:received_ip_address}
    condition = ${if eq{$domain}{$smtp_active_hostname}}
    allow_fail
    allow_defer
    one_time
    data = ${lookup{$local_part}lsearch*@{/etc/aliases}}

local_alias:
    driver = redirect
                domains = !dsttest.unisender.com : !defertest.unisender.com : !apitest.unisender.com :!test-mail.unisender.com
    allow_fail
    allow_defer
    data = ${lookup{$local_part@$domain}lsearch*@{/etc/exim4/aliases.conf}}

dnslookup:
  driver = dnslookup
  domains = ! +local_domains
  transport = remote_smtp
  headers_remove = "us-iface"
  ignore_target_hosts = 0.0.0.0 : 127.0.0.0/8
  pass_on_timeout
  more

fallback:
  driver = manualroute
  transport = fallback_smtp
  route_data = devenv::10028
  self = send
  no_more

######################################################################
#                      TRANSPORTS CONFIGURATION                      #
######################################################################
begin transports

DKIM_RECORD = ${lookup{${domain:${if def:h_sender:{$h_sender:}{$h_from:}} }}dbm*{/etc/exim4/dkims.db}}

remote_smtp:
  driver = smtp
  command_timeout = 1m
  connect_timeout = 30s
  data_timeout = 2m

fallback_smtp:
  driver = smtp
  allow_localhost = true
  helo_data = $smtp_active_hostname

######################################################################
#                      RETRY CONFIGURATION                           #
######################################################################
begin retry

# Address or Domain    Error       Retries
# если таймаут,refused,lost_connection - то попытки планируются в течение 13-и часов,
# со случайной паузой от 2-х до 4 часов, потом от 2-х до 8 часов, потом от 2 до 16 часов.
# т.е. минимальные паузы: 2 часа (6 попыток), максимальные: 2, 8, 16 (три попытки)
# см. http://exim.org/exim-html-4.69/doc/html/spec_html/ch32.html#SECID161
*                      timeout          G,13h,2h,2;
*                      refused          G,13h,2h,2;
*                      lost_connection  G,13h,2h,2;

# для всех остальных ретраев: случайные паузы от 10 минут в течение часа, от 2 часов в течение суток, от 6 часов в течение 36 часов
# попытки с минимальными паузами: 10,20,30,40,50,60 минут; 2,4,6,8,10,12,14,16,18,20,22,24 часа; 30,36,42 часа
# попытки с максимальными паузами: 30 минут, 2 часа, 6.5 часов, 20 часов, 44 часа
# попытка с максимальной длительностью: 48 часов если в 36h будет попытка максимальной длины в 12 часов
*                      *                H,1h,10m,3;H,12h,2h,3;H,36h,6h,3;

######################################################################
#                   AUTHENTICATION CONFIGURATION                     #
######################################################################
begin authenticators

CONFDIR=/etc/exim4

plain_server:
  driver = plaintext
  public_name = PLAIN
  server_condition = "${if crypteq{$auth3}{${extract{1}{:}{${lookup{$auth2}lsearch{CONFDIR/passwd}{$value}{*:*}}}}}{1}{0}}"
  server_set_id = $auth2
  server_prompts = :

login_server:
  driver = plaintext
  public_name = LOGIN
  server_prompts = "Username:: : Password::"
  server_condition = "${if crypteq{$auth2}{${extract{1}{:}{${lookup{$auth1}lsearch{CONFDIR/passwd}{$value}{*:*}}}}}{1}{0}}"
  server_set_id = $auth1
````
