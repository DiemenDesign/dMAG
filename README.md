# diemenMAG
Web based Magazine Indexing for localhost NAS Environments.

NOTE: This software has no Security Implementation. This software is meant to be used in a localhost situation and doesn't require logging in or User Accounts. If you want security and user accounts then feel free to add it and create a Pull Request.

This software was created to make searching for Projects in my catalog of Wood and Workshop magazines. This repository is mainly for backup for my own purposes.

### Install
1. Create an SQL Database.
2. Import 'magazines.sql' into the above Database.
3. Modify the 'db.php' in the includes folder to reflect your Database Name and Credentials.

### Some of the things you can do.
1. Add Category images, by naming an image the same as a category and placing it in the media folder will display that image for that Category on the start page.
2. Can add videos (so far I have only added a YouTube parser). You need to create an API Key via Google's API Console, which will than get the data for that video saving you having to add the content yourself.