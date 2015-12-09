#Symlinks Owncloud plugin

Just copy this into your apps folder and enable it

This is only an API and so there is no useful web interface.

It has basic capabilities to create, show and delete symlinks between Owncloud folders, my testing has only been between external sources.

There are examples below on how to use the API

If required it would be simple to add additional capabilities such as:

*   Provide a list of symlinks, perhaps in a file .links
*   Remove all symlinks in a folder
*   Make all symlinks other than those in a no link list perhaps in a file .nolinks
*   Create a web interface to manage links
*   Anything else?

##Examples

###Create a link
curl -k -u jeremy:password -X POST https://jeremythings.co.uk:444/owncloud/index.php/apps/symlinks/api/0.1/symlinks -d source="/Arkivum/project1/file3.txt" -d link="/Arkivum-links/project1-public/file3.txt"

###Show if a link exists
curl -k -u jeremy:password -X GET https://jeremythings.co.uk:444/owncloud/index.php/apps/symlinks/api/0.1/symlinks?link="/Arkivum-links/project1-public/file3.txt"

###Delete a Link
curl -k -u jeremy:password -X DELETE https://jeremythings.co.uk:444/owncloud/index.php/apps/symlinks/api/0.1/symlinks -d link="/Arkivum-links/project1-public/file3.txt"

###Do a complete test

First I enabled the External Storage app and created two directories, /mnt/astor and /mnt/astor-links.

I then created two external storage entries Arkivum and Arkivum-links

Create the following script, my server was configured for ssl on 444 and I had set up a user with correct access in my case 'jeremy'

```
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
```

##To do

*   Add better error checking
*   Add other features such as processing a list, removing all symlinks etc.

