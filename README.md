# BrowserBasedBash
Attempt to safely allow user based access to Bash scripting on a personal server.

### Description

Relatively simple base design for a browser based server access. Much still needs to be done. As it stands, the project
allows creation, reading, and updating of scripts to be run by the server under a hardcoded username. The browser's
user is treated as any regular user of the server who had physical access. 

### Notes

To run properly, add to the sudoers file as follows:
```
daemon ALL=(mrtodd) NOPASSWD: /bin/bash /opt/lampp/htdocs/script/exec.sh*
```
* where "daemon" is the user executing PHP on the the server
