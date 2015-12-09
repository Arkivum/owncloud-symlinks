#!/bin/bash

echo make directory in main astor share
curl -k -u "jeremy":"password" -X MKCOL "https://jeremythings.co.uk:444/owncloud/remote.php/webdav/Arkivum/project1"

echo upload some files
for i in {1..5}
do
        echo hello > /tmp/file$i.txt
        curl -k -u "jeremy":"password" -X PUT "https://jeremythings.co.uk:444/owncloud/remote.php/webdav/Arkivum/project1/" -T "/tmp/file$i.txt"
done

echo make a directory in the link share
curl -k -u "jeremy":"password" -X MKCOL "https://jeremythings.co.uk:444/owncloud/remote.php/webdav/Arkivum-links/project1-public"

echo make a link
curl -k -u "jeremy":"password" "https://jeremythings.co.uk:444/owncloud/ocs/v1.php/apps/files_sharing/api/v1/shares" -d path="/Arkivum-links/project1-public" -d shareType=3 -d publicUpload="false" -d permissions=1

echo create symlinks for the second file
curl -k -u jeremy:password -X POST https://jeremythings.co.uk:444/owncloud/index.php/apps/symlinks/api/0.1/symlinks -d source="/Arkivum/project1/file2.txt" -d link="/Arkivum-links/project1-public/file2.txt"
