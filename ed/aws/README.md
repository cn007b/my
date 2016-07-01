AWS
-

#### cli

````
# instances
aws ec2 describe-instances \
--output table \
--query 'Reservations[*].Instances[*].[Tags[0].Value,PublicDnsName,ImageId,State.Name]' \
--filter Name=tag:Name,Values=*prod*web*

# s3
aws s3 cp /home/kovpak/Downloads/images.jpg s3://w3.stage.ziipr.bucket/test/x.jpg
````