#!/bin/bash

# sudo chmod +x /home/kovpak/web/kovpak/gh/ed/bash/examples/describeAwsInstances.sh
# sudo ln -s /home/kovpak/web/kovpak/gh/ed/bash/examples/describeAwsInstances.sh /usr/bin/dai

# OSX
# sudo chmod +x /Users/kvol/web/kovpak/gh/ed/bash/examples/describeAwsInstances.sh
# sudo ln -s /Users/kvol/web/kovpak/gh/ed/bash/examples/describeAwsInstances.sh /usr/local/bin/dai

if [ -z "$1" ]; then
    echo 'Please specify name.'
    exit 1
fi
name=$1

aws ec2 describe-instances \
--output table \
--query 'Reservations[*].Instances[*].[Tags[0].Value,PublicDnsName,PrivateIpAddress,ImageId,LaunchTime,State.Name]' \
--filter Name=tag:Name,Values=$1
